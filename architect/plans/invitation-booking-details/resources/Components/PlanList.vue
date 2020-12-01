<template>
    <div class="italic" v-if="!hasBooking">No RSVP</div>
    <div class="font-semibold text-red-500 text-center leading-none" v-else-if="cantMakeIt">
        Can't make it
    </div>
    <div v-else>
        <a class="bg-blue-500 text-sm rounded py-1 px-2 leading-none font-semibold text-white block text-center cursor-pointer slider-bg"
           @click="viewModal = true">
            View Booking
        </a>

        <modal v-if="viewModal" title="Booking Details" closable>
            <table class="border-4 border-blue-500 font-semibold text-lg w-full">
                <tr v-if="booking.ceremony">
                    <td class="border-4 border-blue-500 p-2">Ceremony</td>
                    <td class="border-4 border-blue-500 p-2 text-right"
                        :class="booking.booking.ceremony ? 'text-green-500' : 'text-red-500'">
                        {{ booking.booking.ceremony ? 'Yes' : 'No' }}
                    </td>
                </tr>
                <tr v-if="booking.afternoon">
                    <td class="border-4 border-blue-500 p-2">Afternoon</td>
                    <td class="border-4 border-blue-500 p-2 text-right"
                        :class="booking.booking.afternoon ? 'text-green-500' : 'text-red-500'">
                        {{ booking.booking.afternoon ? 'Yes' : 'No' }}
                    </td>
                </tr>
                <tr v-if="booking.evening">
                    <td class="border-4 border-blue-500 p-2">Evening</td>
                    <td class="border-4 border-blue-500 p-2 text-right"
                        :class="booking.booking.evening ? 'text-green-500' : 'text-red-500'">
                        {{ booking.booking.evening ? 'Yes' : 'No' }}
                    </td>
                </tr>
            </table>

            <table class="border-4 border-blue-500 font-semibold text-lg mt-4 w-full">
                <tr>
                    <th class="border-4 border-blue-500 p-2 bg-blue-100 text-left">Guest</th>
                    <th class="border-4 border-blue-500 p-2 bg-blue-100 text-right">Age Range</th>
                </tr>
                <tr v-for="guest in booking.booking.guests">
                    <td class="border-4 border-blue-500 p-2">{{ guest.name }}</td>
                    <td class="border-4 border-blue-500 p-2 text-right">{{ guest.age_range }}</td>
                </tr>
            </table>

            <p class="font-semibold">Song Suggestions</p>
            <p>{{ booking.booking.song_suggestions || 'None' }}</p>
        </modal>
    </div>
</template>

<script>
export default {
    props: ['id'],

    data: () => ({
        hasBooking: false,
        cantMakeIt: false,
        booking: null,
        viewModal: false,
    }),

    mounted() {
        this.getData();

        Architect.$on('modal-close', () => {
            this.viewModal = false;
        })
    },

    methods: {
        getData() {
            this.hasBooking = false;

            Architect.request().get(`/external/invitation/booking/${this.id}`).then((request) => {
                if (!request.data.booking) {
                    return;
                }

                if (request.data.booking.cant_make_it) {
                    this.hasBooking = true;
                    this.cantMakeIt = true;
                    return;
                }

                this.booking = request.data;
                this.hasBooking = true;
            });
        }
    },

    watch: {
        id: function () {
            this.getData();
        }
    }
}
</script>
