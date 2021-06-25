// noinspection ES6UnusedImports
import Vue from 'vue';
import {AxiosStatic} from "axios";
// @ts-ignore
import Bootstrap from 'bootstrap';

declare module 'vue/types/vue' {
    // noinspection JSUnusedGlobalSymbols
    interface Vue {
        $axios: AxiosStatic,
        $bootstrap: Bootstrap,
    }
}
