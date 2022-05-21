<template>
    <main>

        <section class="py-lg-5 text-center container">
            <h1 class="py-5 fw-light" style="white-space: nowrap">Available properties</h1>
        </section>

        <div class="album py-5 bg-light">
            <div class="container" v-if="rooms && rooms.length > 0">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <div class="col" v-for="room in rooms">
                        <div class="card shadow-sm">
                            <img :src="room.photo" class="img-fluid" />

                            <div class="card-body">
                                <p class="card-text">{{ room.name }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#room-modal" @click="loadSingleRoom(room.id)">View</button>
                                    </div>
                                    <small class="text-muted">Seats: {{ room.size }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="text-center container" v-else>
                <p class="lead text-muted">No records found.</p>
            </div>
        </div>

    </main>

    <!--  Modal displaying individual room details  -->
    <div class="modal fade" id="room-modal" tabindex="-1" role="dialog" aria-labelledby="modalRoomDescription" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img :src="currentRoom.photo" class="img-fluid p-2" :alt="currentRoom.name" />

                    <div class="p-2">
                        <h4>{{ currentRoom.name }}</h4>
                        <p>Seats: {{ currentRoom.size }}</p>
                        <p>Amenities: </p>
                        <ul display="block">
                            <li v-for="item in currentRoom.amenities">{{ item }}</li>
                        </ul>
                        <p>Hourly rate: {{ currentRoom.hourlyRate }}</p>
                        <p>Daily Rate: {{ currentRoom.dailyRate }}</p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Book this place</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                rooms: [],
                currentRoom: []
            }
        },

        mounted() {
            this.loadRoomList();
        },

        methods: {
            loadRoomList: function () {
                axios.get('/api/v1/rooms')
                    .then((response) => {
                        this.rooms = response.data.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            loadSingleRoom(roomId) {
                axios.get('/api/v1/rooms/' + roomId)
                    .then((response) => {
                        this.currentRoom = response.data;
                        console.log(this.currentRoom);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
