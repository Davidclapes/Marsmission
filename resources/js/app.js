import './bootstrap';
import { createApp } from 'vue';
import FormMoviment from './components/FormMoviment.vue';

const app=createApp({});
app.component('form-moviment',FormMoviment);
app.mount('#app');

console.log("Vue s'ha montat correctament");