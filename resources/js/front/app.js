window.$ = require("jquery");
var AOS = require("aos");
import "slick-carousel";
import "./bootstrap";
import Axios from "axios";
window.moment = require('moment');
window.Vue = require("vue");
window.axios = Axios;

$(document).ready(function () {
    $("section")
        .attr("data-aos", "fade-up")
        .attr("data-aos-duration", 1000);
    AOS.init({
        once: true
    });
    $(".add-product").click(function (e) {
        e.preventDefault();
        $(this).toggleClass("active");
    });

    $(document).on("click", 'a[href^="#"]', function (event) {
        event.preventDefault();

        $("html, body").animate({
            scrollTop: $($.attr(this, "href")).offset().top
        },
            800
        );
    });
});

Vue.component(
    "endings-index-component",
    require("../components/EndingsIndexComponent.vue").default
);

Vue.component(
    "news-index-component",
    require("../components/NewsIndexComponent.vue").default
);

Vue.component(
    "materials-index-component",
    require("../components/MaterialsIndexComponent.vue").default
);

Vue.component(
    "products-component",
    require("../components/ProductsComponent.vue").default
);

Vue.component(
    "products-index-component",
    require("../components/ProductsIndexComponent.vue").default
);

Vue.component(
    "product-categories",
    require("../components/ProductCategories.vue").default
);

Vue.component(
    "search-results-component",
    require("../components/SearchResultsComponent.vue").default
);

const app = new Vue({
    el: "#app"
});
