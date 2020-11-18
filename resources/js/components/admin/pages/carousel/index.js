import App from '../../../layout/App';
import List from './List';
import Update from './Update';
import axios from 'axios';
import BlockUI from 'vue-blockui';
import VueRouter from 'vue-router'
const Vue = window.Vue;

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const getUrl = window.location;
const baseUrl = getUrl.protocol + "//" + getUrl.host + "/";


var myApi = axios.create({
    baseURL: baseUrl,
});

const routes = [
    {
        path: '/',
        name: 'index',
        component: List,
        props: true
    },
    {
        path: '/update',
        name: 'update',
        component: Update,
        props: true
    },

];
const router = new VueRouter({
    routes,
    hash: false,
});

import { Table, Button, Card, Switch, message } from 'ant-design-vue';

Vue.component(Table.name, Table);
Vue.component(Button.name, Button);
Vue.component(Card.name, Card);
Vue.component(Switch.name, Switch);


new Vue({
    el: '#app',
    data() {
        return {
            myApi
        }
    },
    router,
    BlockUI,
    message,
    render: h => h(App),
})