<template>
    <div class="container-fluid pt-5">
        <div class="row">
            <div v-for="(weatherData, index) in weatherDatas" class="col position-relative">
                <div class="card">
                    <a class="del-button" @click="destroy(sampleCities[index])"><i class="fa-solid fa-trash"></i></a>
                    <div class="weather-condition"><img :src="`http://openweathermap.org/img/wn/${weatherData['weather'][0]['icon']}@2x.png`" alt="weatherCondition"/></div>
                    <img :src="`${imageDatas[index]}`" style="height: 200px; max-height: 200px;" class="card-img-top" alt="weatherImage">
                    <div class="card-body">
                        <h5 class="card-title">{{ weatherData['name'] }}</h5>
                        <p class="card-text">
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    {{ weatherData['main']['temp'] }} &#8457;
                                </div>
                                <div class="">
                                    {{ weatherData['weather'][0]['description'] }}
                                </div>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-2 row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <label class="form-label">City Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="UK region only..." id="new_city" v-model="form.new_city" />
                                <button class="btn btn-outline-secondary" type="submit">Add City</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <label class="form-label">Refresh Interval</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="" v-model="interval">
                            <button class="btn btn-outline-secondary" type="button" @click="startInterval">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { reactive } from 'vue'
    import { Inertia } from '@inertiajs/inertia'

    function poll() {
        Inertia.reload();
    }

    export default {
        setup () {
            const form = reactive({
                new_city: null,
            })
            const interval = 30000;
            var polling = false;

            function submit() {
                Inertia.post('/vue-update', form);
            }

            function destroy(id) {
                Inertia.post('/vue-destroy', {
                    id: id,
                });
            }

            return { form, submit, destroy, interval, polling }
        },
        methods: {
            startInterval: function () {
                if (this.polling != false) {
                    clearInterval(this.polling);
                }
                this.polling = setInterval(poll, this.interval);
            }
        },
        props: {
            sampleCities: Object,
            weatherDatas: Object,
            imageDatas: Object,
        },
    }
</script>

<style>
    .del-button {
        position: absolute;
        z-index: 10;
        top: 5px;
        right: 10px;
        display: none;
        color: red;
    }

    .weather-condition {
        position: absolute;
        z-index: 10;
        bottom: 70px;
        right: 0px;
    }

    .card:hover .del-button {
        display:block
    }
</style>
