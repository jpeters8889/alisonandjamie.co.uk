<template>
    <div class="w-full flex flex-col items-center leading-none space-y-4">
        <h2 class="font-headline text-xl text-center">
            Enter the RSVP code on your invitation below.
        </h2>

        <input type="text"
               class="w-4/5 p-2 text-lg font-headline text-center bg-gray-100 border border-gray-400 rounded-xl focus:border-gray-600 focus:outline-none"
               v-model="invitationCode" :disabled="loading" @keyup.enter="submit"/>

        <button class="transition-bg py-2 px-8 text-white font-headline text-xl rounded"
                :class="loading ? 'bg-green-300' : 'bg-green-600 hover:bg-green-500'" :disabled="loading"
                @click.prevent="submit">
            <template v-if="!loading">RSVP</template>
            <template v-else>
                <font-awesome-icon :icon="['fas', 'circle-notch']" spin></font-awesome-icon>
            </template>
        </button>
    </div>
</template>

<script>
export default {
    data: () => ({
        invitationCode: '',
        loading: false,
    }),

    methods: {
        submit() {
            if (!this.invitationCode) {
                app().error('Please enter your invitation code!');
                return;
            }

            this.loading = true;

            app().request().post('/api/invitation', {
                invitation: this.invitationCode,
            }).then((response) => {
                this.$root.$emit('invitation-lookup', {invitation: response.data});
            }).catch(() => {
                app().error('Sorry, there was an error looking up your invitation...');
            }).finally(() => {
                this.loading = false;
            })
        }
    }
}
</script>
