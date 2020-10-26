<template>
    <div class="w-full h-full" style="min-width: 200px; min-height: 200px" :ref='mapRef'></div>
</template>

<script>
import {loadScript} from "../Utilities/ScriptLoader";

export default {
    props: {
        lat: {
            type: Number,
            required: true,
        },
        lng: {
            type: Number,
            required: true,
        },
        zoom: {
            type: Number,
            default: 15,
        }
    },

    data: () => ({
        mapRef: '',
    }),

    created() {
        this.mapRef = Math.random().toString(36).substring(2, 15);
    },

    mounted() {
        this.createMap();
    },

    methods: {
        createMap() {
            setTimeout(() => {
                const center = new google.maps.LatLng(this.lat, this.lng);

                const map = new google.maps.Map(this.$refs[this.mapRef], {
                    center: center,
                    zoom: this.zoom,
                    mapTypeControl: false,
                    streetViewControl: false,
                    rotateControl: false,
                    fullscreenControl: false
                });

                new google.maps.Marker({
                    position: center,
                    map: map,
                });
            }, 300);
        }
    },

    watch: {
        lat: function () {
            this.createMap();
        },

        lng: function () {
            this.createMap();
        }
    }
}
</script>
