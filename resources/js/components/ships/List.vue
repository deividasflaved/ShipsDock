<template>
    <div>
        <div class="btn-wrapper">
            <router-link to="/ships/new" class="btn btn-primary btn-sm">Naujas įrašas</router-link>
        </div>
        <table class="table">
            <thead>
                <th>Laivo pavadinimas</th>
                <th>Laivo tipas</th>
                <th>Savininko vardas</th>
                <th>Nuoroda</th>
            </thead>
            <tbody>
                <template v-if="!ships.length">
                    <tr>
                        <td colspan="4" class="text-center">Nėra laivų</td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="ship in ships" :key="ship.id">
                        <td>{{ ship.ship_name }}</td>
                        <td>{{ getShipType(ship) }}</td>
                        <td>{{ ship.owner_name }}</td>
                        <td>
                            <router-link :to="`/ships/${ship.id}`">Detaliau</router-link>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'list',
        created() {
                            if (this.shipTypes.length) {
                this.shipTypes=this.$store.getters.shipTypes;
                    this.shipTypeName = '';
            } else {
                axios.get(`/api/shipTypes`)
                    .then((response) => {
                        this.shipTypes = response.data.shipTypes
                    });
            }
            },
        mounted() {
            if (this.ships.length) {
                return;
            }            
            this.$store.dispatch('getShips');
            this.$store.dispatch('getShipTypes');
        },
        data() {
            return {
                shipTypes: {},
                shipTypeName: ''
            };
        },
        computed: {
            ships() {
                return this.$store.getters.ships;
            }
        },
        methods: {
            getShipType(ship){
                var find = this.shipTypes.find(function(e){
                    return e.id == ship.ship_type_id;
                })
                return find.type;
            }
        }
    }
</script>

<style scoped>
.btn-wrapper {
    text-align: right;
    margin-bottom: 20px;
}
</style>