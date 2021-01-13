
require('./bootstrap');


window.Vue = require("vue");

import {
    Upload,
    Icon,
    Modal,
    Tabs,
    Select,
    Tag
} from "ant-design-vue";
import "ant-design-vue/dist/antd.css";

//componentes de ant design
Vue.component(Upload.name, Upload);
Vue.component(Icon.name, Icon);
Vue.component(Modal.name, Modal);
Vue.component(Tabs.name, Tabs);
Vue.component(Tabs.TabPane.name, Tabs.TabPane);
Vue.component(Select.name, Select);
Vue.component(Select.Option.name, Select.Option);
Vue.component(Tag.name, Tag);


Vue.component(
    "galery",
    require("./components/admin/ImageGalery.vue").default
);

Vue.component(
    "product-galery",
    require("./components/admin/ProductImages.vue").default
);

Vue.component(
    "applications",
    require("./components/admin/Application.vue").default
);

Vue.component(
    "search-results-component",
    require("./components/SearchResultsComponent.vue").default
);

const app = new Vue({
    el: "#app"
})

