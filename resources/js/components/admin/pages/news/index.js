import App from '../../../layout/App';
import List from './List';
import Update from './Update';
import CategoryList from './categories/CategoryList';
import CategoryUpdate from './categories/CategoryUpdate';
import TagList from './tags/TagList';
import TagUpdate from './tags/TagUpdate';
import WriterList from './writers/WriterList';
import WriterUpdate from './writers/WriterUpdate';
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
    {
        path: '/categories',
        name: 'categories-index',
        component: CategoryList,
        props: true
    },
    {
        path: '/categories/update',
        name: 'categories-update',
        component: CategoryUpdate,
        props: true
    },

    {
        path: '/tags',
        name: 'tags-index',
        component: TagList,
        props: true
    },
    {
        path: '/tags/update',
        name: 'tags-update',
        component: TagUpdate,
        props: true
    },

    {
        path: '/writers',
        name: 'writers-index',
        component: WriterList,
        props: true
    },
    {
        path: '/writers/update',
        name: 'writers-update',
        component: WriterUpdate,
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