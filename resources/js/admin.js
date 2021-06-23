Promise.all([
    import('axios'),
    import('vue'),
]).then(
    ([
         {default: axios},
         {default: Vue},
     ]) => {
        window.axios = axios;
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${window.Laravel.token}`;

        Vue.component('game-session-list', require('./components/GameSessionList.vue').default);
        Vue.component('game-session-list-item', require('./components/GameSessionListItem.vue').default);

        // noinspection JSUnusedLocalSymbols
        const app = new Vue({
            el: '#app',
        });
    });
