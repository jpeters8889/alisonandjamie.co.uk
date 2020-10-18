import Vue from 'vue';

const ExampleComponent = () => import("./Components/ExampleComponent");

Vue.component('example-component', ExampleComponent);
