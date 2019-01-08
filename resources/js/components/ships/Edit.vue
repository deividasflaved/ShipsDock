<template>
    <div class="ship-edit">
        <h2><center>Laivo redagavimas</center></h2>
        <form @submit.prevent="edit">         
            <table class="table">
                <tr>
                    <th>Laivo pavadinimas</th>
                    <td>
                        <input type="text" class="form-control" v-model="ship.ship_name" placeholder="Laivo pavadinimas"/>
                    </td>
                </tr>
                <tr>
                    <th>Tipas</th>
                    <td>
                        <select class="form-control"  v-model="ship.ship_type_id">
                              <option disabled value="">Pasirinkti viena</option>
                                <option v-for="ship_type in shipTypes" v-bind:value="ship_type.id">{{ship_type.type}}</option> 
                            </select>
                    </td>
                </tr>
                <tr>
                    <th>Parkavimo numeris</th>
                    <td>
                        <input type="text" class="form-control" v-model="ship.docking_slot_id" placeholder="12"/>
                    </td>
                </tr>
                <tr>
                    <th>Savininko vardas</th>
                    <td>
                        <input type="text" class="form-control" v-model="ship.owner_name" placeholder="Jonas"/>
                    </td>
                </tr>
                <tr>
                    <th>Savininko kontaktai</th>
                    <td>
                        <input type="text" class="form-control" v-model="ship.owner_contacts" placeholder="Numeris arba El. paštas"/>
                    </td>
                </tr>
                <tr>
                    <th>Atvykimo data</th>
                    <td>
                        <input type="date" class="form-control" v-model="ship.ship_arrival_date" placeholder="2018-10-10"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <router-link to="/ships" class="btn">Atšaukti</router-link>
                    </td>
                    <td class="text-right">
                        <input type="submit" value="Patvirtinti" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <div class="errors" v-if="errors">
            <ul>
                <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                    <strong>{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import validate from 'validate.js';
    export default {
        name: 'new',
        mounted() {
            this.$store.dispatch('getShipTypes');
        },
        created() {
            if (this.ships.length) {
                this.ship = this.ships.find((ship) => ship.id == this.$route.params.id);
            } else {
                axios.get(`/api/ships/${this.$route.params.id}`)
                    .then((response) => {
                        this.ship = response.data.ship
                    });
            }
        },
        data() {
            return {
                ship: {
                    ship_name: '',
                    ship_type_id: '',
                    docking_slot_id: '',
                    owner_name: '',
                    owner_contacts: '',
                    ship_arrival_date: ''
                },
                errors: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
            ships() {
                return this.$store.getters.ships;
            },
            shipTypes(){
                return this.$store.getters.shipTypes;
            }
        },
        methods: {
            edit() {
                this.errors = null;
                const constraints = this.getConstraints();
                const errors = validate(this.$data.ship, constraints,{fullMessages: false});
                if(errors) {
                    this.errors = errors;
                    //this.$router.push('/ships');
                    return;
                }
                axios.put(`/api/ships/${this.ship.id}`, this.$data.ship)
                    .then((response) => {
                        this.$store.dispatch('getShips');
                        this.$router.push('/ships');
                    });
            },
            getConstraints() {
                return {
                    ship_name: {
                        presence: {
                            allowEmpty: false,
                            message: "Laivo pavadinimo laukelis negali būti tuščias"
                        },
                        length: {
                            minimum: 3,
                            message: 'Laivo pavadiniams turi būti bent 3 raidžių'
                        }
                    },
                    ship_type_id: {
                        presence: {
                            allowEmpty: false,
                            message: "Laivo tipas yra privalomas"
                        }
                    },
                    docking_slot_id: {
                        presence: {
                            allowEmpty: false,
                            message: "Laivo parkavimo numerio laukelis negali būti tuščias arba ne numeris"
                        }
                    },
                    owner_name: {
                        presence: {
                            allowEmpty: false,
                            message: "Laivo savininko laukelis negali būti tuščias"
                        }
                    },
                    owner_contacts: {
                        presence: {
                            allowEmpty: false,
                            message: "Laivo savininko kontaktų laukelis negali būti tuščias"
                        }
                    },
                    ship_arrival_date: {
                        presence: {
                            allowEmpty: false,
                            message: "Datos laukelis negali būti tuščias"
                        }
                    }
                };
            }
        }
    }
</script>

<style>
.errors {
    background: lightcoral;
    border-radius:5px;
    padding: 21px 0 2px 0;
}
</style>
