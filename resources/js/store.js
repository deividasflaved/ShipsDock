import { getLocalUser } from "./helpers/auth";

const user = getLocalUser();

export default {
    state: {
        currentUser: user,
        isLoggedIn: !!user,
        loading: false,
        auth_error: null,
        ships: [],
        shipTypes: []
    },
    getters: {
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        ships(state) {
            return state.ships;
        },
        shipTypes(state) {
            return state.shipTypes;
        }
    },
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {token: payload.token});
            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        registerSuccess(state) {
            state.auth_error = null;
        },
        registerFailed(state, payload) {
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.currentUser = null;
        },
        updateShips(state, payload) {
            state.ships = payload;
        },
        updateShipTypes(state, payload) {
            state.shipTypes = payload;
        }
    },
    actions: {
        login(context) {
            context.commit("login");
        },
        getShips(context) {
            axios.get('/api/ships')
            .then((response) => {
                context.commit('updateShips', response.data.ships);
            })
        },
        getShipTypes(context) {
            axios.get('/api/shipTypes')
            .then((response) => {
                context.commit('updateShipTypes', response.data.shipTypes);
            })
        }
    }
};