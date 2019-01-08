import Home from './components/Home.vue';
import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import ShipsMain from './components/ships/Main.vue';
import ShipsList from './components/ships/List.vue';
import NewShip from './components/ships/New.vue';
import Ship from './components/ships/View.vue';
import EditShip from './components/ships/Edit.vue';

export const routes = [
    {
        path: '/',
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        component: Register
    },
    {
        path: '/ships',
        component: ShipsMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: ShipsList
            },
            {
                path: 'new',
                component: NewShip
            },
            {
                path: ':id',
                component: Ship
            },
            {
                path: 'edit/:id',
                component: EditShip
            }
        ]
    }
];