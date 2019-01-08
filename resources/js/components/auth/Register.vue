<template>
	<div class="login row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Registruotis</div>
                <div class="card-body">
                    <form @submit.prevent="register">
                    	<div class="form-group row">
                            <label for="email">Vardas:</label>
                            <input type="text" v-model="form.name" class="form-control" placeholder="Jūsų vardas">
                        </div>
                        <div class="form-group row">
                            <label for="email">El. pašto adresas:</label>
                            <input type="email" v-model="form.email" class="form-control" placeholder="El. pašto adresas">
                        </div>
                        <div class="form-group row">
                            <label for="password">Slaptažodis:</label>
                            <input type="password" v-model="form.password" class="form-control" placeholder="Slaptažodis">
                        </div>
                        <div class="form-group row">
                            <label for="password">Pakartokite slaptažodį:</label>
                            <input type="password" v-model="form.password_confirmation" class="form-control" placeholder="Įvesti iš naujo slaptažodį">
                        </div>
                        <div class="form-group row">
                            <input type="submit" value="Registruotis">
                        </div>
                        <div class="form-group row" v-if="authError">
                            <p class="error">
                                {{ authError }}
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	import {register} from '../../helpers/auth';
	export default {
        name: "register",
        data() {
            return {
                form: {
                	name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                error: null
            };
        },
        methods: {
            register() {
                register(this.$data.form)
                    .then((res) => {
                        this.$router.push({path: '/'});
                        this.$store.commit("registerSuccess");
                    })
                    .catch((error) => {
                        this.$store.commit("registerFailed", {error});
                    });
            }
        },
        computed: {
            authError() {
                return this.$store.getters.authError;
            }
        }
        
    }
</script>
<style scoped>
.error {
    text-align: center;
    color: red;
}
</style>