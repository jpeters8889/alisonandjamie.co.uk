import Vue from 'vue';

const Navigation = () => import("./Components/Navigation");
const Countdown = () => import("./Components/Countdown");
const OurStory = () => import("./Components/OurStory");
const GoogleMap = () => import("./Components/GoogleMap");
const Travel = () => import('./Components/Travel')
const Rsvp = () => import('./Components/Rsvp')

Vue.component('navigation', Navigation);
Vue.component('countdown', Countdown);
Vue.component('our-story', OurStory);
Vue.component('google-map', GoogleMap);
Vue.component('travel', Travel);
Vue.component('rsvp', Rsvp);
