<template>
    <div class="flex flex-col">
        <h2 class="text-center font-headline text-xl mb-2 lg:text-2xl" v-html="welcomeText"></h2>

        <div class="flex flex-col lg:flex-row ">
            <div class="lg:w-1/2 lg:pr-2 lg:border-r lg:border-gray-300">
                <p v-html="invitedToText"></p>

                <div class="flex flex-col space-y-3">

                    <div v-for="option in options" class="flex border border-gray-300"
                         v-if="invitation[option.variable]" @click.prevent="selectOption(option.variable)">
                        <div class="flex border-r border-gray-300 p-3 items-center justify-center">
                            <div
                                class="p-2 text-white rounded w-8 h-8 text-lg flex justify-center items-center border border-gray-200 transition-bg"
                                :class="optionSelected(option.variable) ? 'bg-green-500' : 'bg-gray-200'">
                                <font-awesome-icon :icon="['fas', 'check']"></font-awesome-icon>
                            </div>
                        </div>

                        <div class="flex flex-col flex-1 justify-center p-3">
                            <h2 class="font-headline text-lg text-left">{{ option.title }}</h2>
                            <p class="text-sm mb-0">{{ option.address }}</p>
                        </div>
                    </div>

                    <div class="flex border border-gray-300" @click.prevent="iCantMakeIt()" ref="cantMakeIt">
                        <div class="flex border-r border-gray-300 p-3 items-center justify-center">
                            <div
                                class="p-2 text-white rounded w-8 h-8 text-lg flex justify-center items-center border border-gray-200 transition-bg"
                                :class="cantMakeIt ? 'bg-red-500' : 'bg-gray-200'">
                                <font-awesome-icon :icon="['fas', 'check']"></font-awesome-icon>
                            </div>
                        </div>

                        <div class="flex flex-col flex-1 justify-center p-3">
                            <h2 class="font-headline text-lg text-left">Sorry, I can't make it 😢</h2>
                        </div>
                    </div>

                </div>
            </div>

            <div class="lg:w-1/2 lg:pl-2">
                <h3 class="font-headline text-lg mt-2 lg:mt-0">
                    Attendees
                </h3>

                <p>Your invite allows to bring yourself and {{ invitation.limit > 2 ? 'up to' : '' }}
                    {{ invitation.limit - 1 }} {{ invitation.limit === 2 ? 'guest' : 'guests' }}.</p>

                <div class="flex flex-col space-y-3">


                    <div class="flex space-x-2" v-for="(guest, index) in guests">
                        <input type="text" class="rounded border border-gray-200 p-1 flex-1"
                               v-model="guest.name"
                               placeholder="Name..."
                               :disabled="index === 0 || cantMakeIt"/>

                        <select class="rounded border border-gray-200 p-1" v-model="guest.ageRange"
                                :disabled="cantMakeIt">
                            <option disabled value="">Age Range</option>
                            <option value="0-4">0 - 4</option>
                            <option value="5-12">5 - 12</option>
                            <option value="13-18">13 - 18</option>
                            <option value="18+">18+</option>
                        </select>

                        <button :class="!cantMakeIt && index > 0 ? 'bg-red-500' : 'bg-gray-200'"
                                class="rounded p-2 text-center text-white"
                                :disabled="index === 0"
                                v-tooltip="'Delete Guest'"
                                @click.prevent="deleteGuest(index)">
                            <font-awesome-icon :icon="['fas', 'times']"></font-awesome-icon>
                        </button>
                    </div>

                    <button
                        class="transition-bg py-2 px-8 text-white font-headline text-xl rounded"
                        :class="guests.length < invitation.limit && !cantMakeIt ? 'bg-green-600 hover:bg-green-500' : 'bg-green-200 cursor-disabled'"
                        :disabled="guests.length >= invitation.limit || cantMakeIt" @click.prevent="addGuest()">
                        Add Another Guest
                    </button>

                </div>

                <p class="mt-2">
                    Between the bands sets there'll be around an hour of music being played through the PA system, is
                    there any songs you'd love to hear?
                </p>

                <textarea class="w-full border border-gray-200 p-2 rounded" rows="4" v-model="songSuggestions"
                          :disabled="cantMakeIt"></textarea>
            </div>

        </div>

        <div class="w-full text-center">
            <button
                class="transition-bg py-2 px-8 text-white font-headline text-xl rounded mt-2 w-full lg:w-auto lg:mt-4"
                :class="loading ? 'bg-green-300' : 'bg-green-600 hover:bg-green-500'" :disabled="loading"
                @click.prevent="submitBooking">
                <template v-if="!loading">Send My RSVP</template>
                <template v-else>
                    <font-awesome-icon :icon="['fas', 'circle-notch']" spin></font-awesome-icon>
                </template>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        invitation: {
            type: Object,
            required: true,
        }
    },

    data: () => ({
        ceremony: null,
        afternoon: null,
        evening: null,
        cantMakeIt: false,
        guests: [],
        songSuggestions: '',
        loading: false,

        options: [
            {
                variable: 'ceremony',
                title: 'Wedding Ceremony',
                address: 'Crewe Municipal Buildings, Earle St, Crewe CW1 2BJ',
            },

            {
                variable: 'afternoon',
                title: 'Afternoon Reception',
                address: 'Cheshire Cat, 26 Welsh Row, Nantwich CW5 5ED',
            },

            {
                variable: 'evening',
                title: 'Evening Reception',
                address: 'Nantwich Town FC, The Weaver Stadium, Water-Lode, Nantwich CW5 5BS',
            },
        ]
    }),

    mounted() {
        if (this.invitation.ceremony) {
            this.ceremony = this.invitation.booking?.ceremony || false;
        }

        if (this.invitation.afternoon) {
            this.afternoon = this.invitation.booking?.afternoon || false;
        }

        if (this.invitation.evening) {
            this.evening = this.invitation.booking?.evening || false;
        }

        if (this.invitation.booking) {
            this.cantMakeIt = this.invitation.booking.cant_make_it;

            this.invitation.booking.guests.forEach((guest) => {
                this.guests.push({
                    name: guest.name,
                    ageRange: guest.age_range,
                });
            });
        }

        if (!this.guests.length) {
            this.invitation.preset_names.forEach((name) => {
                this.guests.push({
                    name: name,
                    ageRange: '',
                });
            });
        }
    },

    methods: {
        optionSelected(option) {
            return this[option];
        },

        selectOption(option) {
            if (this.cantMakeIt) {
                this.$refs['cantMakeIt'].classList.add('animate-shake');

                setTimeout(() => {
                    this.$refs['cantMakeIt'].classList.remove('animate-shake');
                }, 500)

                return;
            }

            this[option] = !this[option]
        },

        iCantMakeIt() {
            if (this.ceremony === true) {
                this.ceremony = false;
            }

            if (this.afternoon === true) {
                this.afternoon = false;
            }

            if (this.evening === true) {
                this.evening = false;
            }

            this.guests = [{
                name: this.invitation.name,
                ageRange: '18+',
            }];

            this.songSuggestions = '';
            this.cantMakeIt = !this.cantMakeIt;
        },

        addGuest() {
            if (this.guests.length >= this.invitation.limit || this.cantMakeIt) {
                return;
            }

            this.guests.push({
                name: '',
                ageRange: '',
            })
        },

        deleteGuest(index) {
            if (index === 0 || this.cantMakeIt) {
                return;
            }

            this.guests.splice(index, 1);
        },

        submitBooking() {
            if (!this.validate()) {
                return;
            }

            this.loading = true;

            app().request().post('/api/bookings', {
                'invitation_id': this.invitation.id,
                'cant_make_it': this.cantMakeIt,
                ceremony: this.ceremony,
                afternoon: this.afternoon,
                evening: this.evening,
                guests: this.guests,
                'song_suggestions': this.songSuggestions,
            }).then(() => {
                window.location.href = '/rsvp/thanks';
            }).catch(() => {
                app().error('Sorry, there was an error submitting your RSVP');
                this.validate();
            }).finally(() => {
                this.loading = false;
            });
        },

        validate() {
            if (!this.cantMakeIt) {
                if (![this.ceremony, this.afternoon, this.evening].includes(true)) {
                    app().error('Please choose at least one option to RSVP too!')
                    return false;
                }

                if (this.guests.length === 0) {
                    app().error('Please enter your guests names.')
                    return false;
                }

                let guestError = false;
                this.guests.forEach((guest) => {
                    if (guest.name === '' || guest.ageRange === '') {
                        guestError = true;
                    }
                });

                if (guestError) {
                    app().error('Please make sure all guest details are completed');
                    return false;
                }
            }

            return true;
        }
    },

    computed: {
        welcomeText: function () {
            if (this.invitation.booking) {
                return `Hi ${this.invitation.name}, you've already completed your RSVP!`;
            }

            return `Hi ${this.invitation.name}, please complete your RSVP below!`;
        },

        invitedToText: function () {
            let invitedTo = [];
            let text = '';

            if (this.invitation.ceremony) {
                invitedTo.push('Wedding Ceremony');
            }

            if (this.invitation.afternoon) {
                invitedTo.push('Afternoon Reception');
            }

            if (this.invitation.evening) {
                invitedTo.push('Evening Reception');
            }

            if (invitedTo.length === 1) {
                return `You're invited to our ${invitedTo[0]}! If you can make it please check the box below and add the names of any attendees!`;
            }

            if (invitedTo.length === 2) {
                text = `You're invited to our ${invitedTo[0]} and our ${invitedTo[1]}!`
            }

            if (invitedTo.length === 3) {
                text = `You're invited to our ${invitedTo[0]}, ${invitedTo[1]} and our ${invitedTo[2]}!`
            }

            return text + `<br/><br/>Please check the boxes below for the event(s) you plan to attend and add the names of any attendees!`
        },
    },
}
</script>
