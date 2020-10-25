<template>
    <lookup-invitation v-if="!invitation"></lookup-invitation>
    <rsvp-form :invitation="invitation" v-else></rsvp-form>
</template>

<script>
import LookupInvitation from "./LookupInvitation";
import RsvpForm from "./RsvpForm";

export default {
    components: {
        'lookup-invitation': LookupInvitation,
        'rsvp-form': RsvpForm,
    },

    data: () => ({
        invitation: null
    }),

    mounted() {
        this.$root.$on('invitation-lookup', (event) => {
            this.invitation = event.invitation;
        });
    }
}
</script>
