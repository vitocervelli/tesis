
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.use(require('vue-resource')); 

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('table-tema', require('./components/table-tema.vue'));
Vue.component('table-temas-enviados', require('./components/table-temas-enviados.vue'));
Vue.component('table-tutores', require('./components/table-tutores.vue'));
Vue.component('table-reporte-tutor', require('./components/table-reporte-tutor.vue'));
Vue.component('table-reporte-jurado', require('./components/table-reporte-jurado.vue'));
Vue.component('table-tesistas', require('./components/table-tesistas.vue'));
Vue.component('table-jurado', require('./components/table-jurado.vue'));
Vue.component('table-jurado-registro', require('./components/table-jurado-registro.vue'));
Vue.component('table-jurados', require('./components/table-jurados.vue'));
Vue.component('table-observacion', require('./components/table-observacion.vue'));
Vue.component('table-evaluacion', require('./components/table-evaluacion.vue'));
Vue.component('table-evaluaciones', require('./components/table-evaluaciones.vue'));
Vue.component('table-observaciones', require('./components/table-observaciones.vue'));
Vue.component('table-observaciones-estudiante', require('./components/table-observaciones-estudiante.vue'));
Vue.component('table-solicitudes-jurado', require('./components/table-solicitudes-jurado.vue'));
Vue.component('table-solicitudes', require('./components/table-solicitudes.vue'));
Vue.component('table-proyectos', require('./components/table-proyectos.vue'));
Vue.component('table-encuentros', require('./components/table-encuentros.vue'));
Vue.component('table-solicitudes-encuentros', require('./components/table-solicitudes-encuentros.vue'));
Vue.component('table-buzon', require('./components/table-buzon.vue'));
Vue.component('paginate', require('vuejs-paginate'));

const app = new Vue({
    el: '#app'
});
