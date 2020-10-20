<template>
    <span class="transition-colour" :class="loaded ? '' : 'text-transparent'">
        {{ days }} days {{ hours }} hrs {{ minutes }} mins {{ seconds }} secs to go
    </span>
</template>

<script>
    import moment from 'moment';

    export default {
        data: () => ({
           date: moment('2021-09-11 12:00:00'),
            days: 0,
            hours: 0,
            minutes: 0,
            seconds: 0,

            loaded: false,
        }),

        mounted() {
            setInterval(() => {
                const duration = moment.duration(this.date.diff(moment()));

                this.days = Math.floor(duration.asDays());
                this.hours = duration.hours();
                this.minutes = duration.minutes();
                this.seconds = duration.seconds();

                this.loaded = true;
            }, 1000)
        }
    }
</script>
