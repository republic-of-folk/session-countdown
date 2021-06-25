Promise.all([
    import('axios'),
    import('vue'),
    import('bootstrap'),
]).then(
    ([
         {default: axios},
         {default: Vue},
         {...Bootstrap},
     ]) => {
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        // @ts-ignore
        axios.defaults.headers.common['Authorization'] = `Bearer ${window.Laravel.token}`;

        Vue.component('game-session-list', require('./components/GameSessionList.vue').default);
        Vue.component('game-session-list-item', require('./components/GameSessionListItem.vue').default);
        Vue.component('game-session-modal', require('./components/GameSessionModal.vue').default);

        Vue.prototype.$axios = axios;
        Vue.prototype.$bootstrap = Bootstrap;

        new Vue({
            el: '#app',
        });
    });
