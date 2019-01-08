<template>

    <div class="ship-view" v-if="ship">
        <h2><center>Laivo peržiūra</center></h2>
        <div class="user-img">
            <center><img src="https://thedockdoctors.com/images/slideshows/boatlifts/Boatlift-Ultimate-5.jpg" alt=""></center>
        </div>
        <div class="user-info">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ ship.id }}</td>
                </tr>
                <tr>
                    <th>Pavadinimas</th>
                    <td>{{ ship.ship_name }}</td>
                </tr>
                <tr>
                    <th>Tipas</th>
                    <td>{{ getShipType(ship) }}</td>
                </tr>
                <tr>
                    <th>Parkavimo numeris</th>
                    <td>{{ ship.docking_slot_id }}</td>
                </tr>
                <tr>
                    <th>Savininkas</th>
                    <td>{{ ship.owner_name }}</td>
                </tr>
                <tr>
                    <th>Savininko kontaktai</th>
                    <td>{{ ship.owner_contacts}}</td>
                </tr>
                <tr>
                    <th>Atvykimo data</th>
                    <td>{{ ship.ship_arrival_date }}</td>
                </tr>
            </table>
            <router-link tag="button" class="buttonDefault" to="/ships">Grįžti į visus laivus</router-link>
            <!-- Button trigger modal -->
        <button type="button" class="buttonDel" data-toggle="modal" data-target="#deleteModal" style="float: right">
          IŠTRINTI
        </button>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">AR TIKRAI NORITE IŠTRINTI ĮRAŠĄ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-footer">
                <button type="button" class="buttonBack" data-dismiss="modal">UŽDARYTI</button>
                <button class="buttonDel" v-on:click="deleteShip()" data-dismiss="modal" style="float: right">PATVIRTINTI</button>
              </div>
            </div>
          </div>
        </div>
                <router-link tag="button" class="buttonDefault" style="float: right" :to="`/ships/edit/${ship.id}`" >REDAGUOTI</router-link>
                
                
        </div>
    </div>
</template>

<script>
    export default {
        name: 'view',
        created() {
            if (this.ships.length) {
                this.ship = this.ships.find((ship) => ship.id == this.$route.params.id);
            } else {
                axios.get(`/api/ships/${this.$route.params.id}`)
                    .then((response) => {
                        this.ship = response.data.ship
                    });
            }
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
        
        data() {
            return {
                ship: null,
                shipTypes: {},
                shipTypeName: ''
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
            ships() {
                return this.$store.getters.ships;
            }
        },
        methods: {
            deleteShip() {
                axios.delete(`/api/ships/${this.ship.id}`,)
                    .then((response) => {
                        this.$store.dispatch('getShips');
                        this.$router.push('/ships');
                    });
            },
            getShipType(ship){
                let find = this.shipTypes.find(o => o.id == ship.ship_type_id);
                return find.type;
            }
        }
    }
</script>

<style scoped>
.ship-view {
    align-items: center;
}
.user-img {
    flex: 1;
}
.user-img img {
    max-width: 500px;
    align-items: center;
    width: 100%;
    height: auto;
}
.user-info {
    flex: 3;
}
.buttonDel{
    color: white;
    border-radius: 4px;
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
    background: rgb(202, 60, 60);
}
.buttonBack{
    color: white;
    border-radius: 4px;
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
    background: rgb(147,112,219);
}
.buttonDefault{
    color: black;
    border-radius: 4px;
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
    background: rgb(220,220,220);
}
</style>