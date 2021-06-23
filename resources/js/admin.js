import Vue from "vue";

require('./bootstrap');

Vue.component('game-session-list', require('./components/GameSessionList.vue').default);
Vue.component('game-session-list-item', require('./components/GameSessionListItem.vue').default);

// noinspection JSUnusedLocalSymbols
const app = new Vue({
    el: '#app',
});
