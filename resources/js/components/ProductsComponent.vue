<template>
    <div>
        <div class="row">
            <div
                class="col-md-4 col-sm-6 p-3 border-card"
                v-for="(product) in products"
                :key="product.id"
            >
                <div class="position-relative">
                    <a 
                        :href="`${path}/${product.categories[0].languages[0].slug}/${product.languages[0].slug}`"
                        title="Accede a la información"
                    >
                        <img
                            :src="getImage(product)"
                            :alt="`${product.languages[0].name}`"
                            class="w-100 border-img"
                        />
                    </a>
                    <div class="position-absolute transform-t-50 d-flex t-0 l-0 ml-3 mt-3">
                        <span v-for="logo in product.eco_logos" :key="logo.id" class="btn-icon" style="padding: 1px">
                            <img :src="`/storage/eco-logos/${logo.image}`" :alt="logo.name" :title="logo.name" class="w-auto h-100 mw-100 mh-100">
                        </span>
                    </div>
                    <div class="position-absolute transform-t-50 d-flex b-0 r-0 mr-3">
                        <a 
                            :href="`${path}/${product.categories[0].languages[0].slug}/${product.languages[0].slug}`" 
                            title="Obten información de este artículo" 
                            class="btn-icon"
                        >
                            <i class="fas fa-info-circle" title="icono información"></i>
                        </a>
                        <span
                            :id="product.id"
                            :class="
                                'btn-icon favorit ' + isFav(product)
                            "
                            @click.stop="favorite(product)"
                        >
                            <i class="far fa-heart"></i>
                        </span>
                    </div>
                </div>
                <a 
                    :href="`${path}/${product.categories[0].languages[0].slug}/${product.languages[0].slug}`" 
                    title="Accede a la información" 
                    class="d-flex flex-column"
                >
                    <p class="small color-blue mt-3">{{ product.categories[0].languages[0].name }}</p>
                    <p class="font-bold color-black">{{ product.languages[0].name }}</p>
                </a>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <infinite-loading class="text-center" spinner="spiral" v-if="!noMoreData" @infinite="loadMore(url)">
              <div slot="no-more"></div>
              <div slot="no-results"></div>
            </infinite-loading>
        </div>
    </div>
</template>

<script>
import infiniteScroll from "vue-infinite-scroll";

export default {
    directives: { infiniteScroll },
    props: ["products_info", "favorites"],
    data() {
        return {
            path: "",
            products: [],
            noMoreData: false,
            url: "",
            favs: Object.values(this.favorites),
        };
    },
    created() {
        this.products = this.products_info.data;
        this.url = this.products_info.next_page_url
        this.path = this.products_info.path;
    },
    methods: {
        favorite(p) {
            axios
                .post("/fav", {
                    value: p.id,
                })
                .then((r) => {
                    this.$set(p, "added", r.data.action == "added");
                    $("#header-fav-count").html(`(${r.data.count})`);
                })
                .catch((e) => console.log(e.response, "favorite"));
        },
        isFav(p) {
            if (p.added) return 'active'
            if (this.favs.filter(f => f == p.id).length > 0) return 'active'
            return '';
        },
        goTo(url) {
            window.location = url;
        },
        loadMore(url) {
            if (!this.noMoreData) {
                axios
                    .get(url)
                    .then((res) => {
                        console.log(res)
                        const data = res.data
                        data.data.forEach((element) => {
                            this.products.push(element)
                        })
                        if (data.next_page_url) {
                            this.url = data.next_page_url;
                            this.loadMore(this.url)
                        } else {
                            this.noMoreData = true
                        }
                    })
                    .catch((e) => console.log(e, "getProducts"));
            }
        },
        getImage(product) {
            if (product.primary_image && product.primary_image.path) {
                let path = /storage/ + product.primary_image.path.replace('public/', '');
                
                return path;
            }
            return `/front/img/no-foto.jpg`;
        }
    },
};
</script>

<style>
</style>