<template>
  <div>
    <hr />
    <div class="row" v-for="(category, index) in categories" :key="'category' + index">
      <div class="col-12 mb-4">
        <div class="bg-light d-flex align-items-center p-3">
          <h4 class="title-sd text-primary mb-0">{{category.name}}</h4>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
          <div class="col-lg-4 col-md-6" v-for="product in category.products" :key="product.id">
            <div class="box-product">
              <figure :class="'border mb-0 square box-product__figure ' + product.class">
                <img
                  @click.stop="goTo(product)"
                  v-if="product.primary_image"
                  :src="`/storage/${product.primary_image.path}`"
                  :alt="product.primary_image.alt.length > 0 ? product.primary_image.alt : product.name"
                  class="box-product__img"
                />
                <span
                  :class="'add-product bg-light favorit ' + (favs.filter(f => f == product.id).length > 0 ? 'active' : '')"
                  @click.stop="favorite(product)"
                >
                  <i class="far fa-heart text-primary"></i>
                </span>

                <div class="info-eco--list" v-if="product.eco_logos.length > 0">
                  <a :href="eco_page">
                    <span
                      v-for="logo in product.eco_logos"
                      :key="logo.id"
                      class="info-eco__icon"
                      data-container="body"
                      data-toggle="popover"
                      data-placement="bottom"
                      :data-content="logo.name"
                    >
                      <img
                        :src="'/storage/'+logo.image"
                        :alt="logo.name"
                        class="img-fluid info-eco__img"
                      />
                    </span>
                  </a>
                </div>
              </figure>
              <a :id="`product_${product.id}`" :href="`${product.url}`">
                <div class="box-product-info">
                  <p class="text-primary">
                    <strong>{{product.name}}</strong>
                  </p>
                  <p
                    class="description text-muted"
                    v-html="product.description.substring(0,142).trim() + '...'"
                  ></p>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 text-center">
        <infinite-loading
          v-if="!disableAutoLoad"
          class="text-center"
          spinner="spiral"
          @infinite="loadData($event, category)"
        >
          <div slot="no-more"></div>
          <div slot="no-results"></div>
        </infinite-loading>
      </div>
    </div>
    <a @click="handleShowMoreInfo" href="#info-request" class="sticky-btn-info btn btn-primary">
      <i class="far fa-comment mr-3"></i>
      {{ infobtn }}
    </a>
  </div>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";

import { log } from "util";

export default {
  directives: { InfiniteLoading },

  data() {
    return {
      favs: Object.values(this.favorites),
      eco_page: undefined,
      noMoreData: false,
      filterResults: [],
      busy: false,
      lastElement: 0,
      query: "",
      searching: false,
      categories: [],
      disableAutoLoad: false
    };
  },
  props: ["loading", "locale", "infobtn", "category", "sup", "favorites"],
  methods: {
    loadData($state, category) {
      let url =
        category.products.length > 0
          ? category.next
          : "/products/lazy/" + category.id + "/" + this.locale;

      !this.disableAutoLoad &&
        axios.get(url).then(r => {
          category.products.push(...r.data.data);
          this.$set(category, "next", r.data.next_page_url);
          Vue.nextTick(function() {
            r.data.next_page_url ? $state.loaded() : $state.complete();
            $('[data-toggle="popover"]').popover({
              trigger: "hover"
            });
          });
        });
    },
    handleShowMoreInfo() {
      this.disableAutoLoad = true;
      let element = document.getElementById("nom_surname");
      element.focus({
        preventScroll: false
      });
      setTimeout(() => (this.disableAutoLoad = false), 5000);
    },
    favorite(p) {
      axios
        .post("/fav", {
          value: p.id
        })
        .then(r => {
          this.$set(p, "added", r.data.action == "added");
          $("#header-fav-count").html(`(${r.data.count})`);
          if (r.data.action == "added") {
            this.favs.push(p.id);
          } else {
            let newFav = this.favs.filter(f => f != p.id);
            this.favs = newFav;
          }
        })
        .catch(e => console.log(e.response, "favorite"));
    },
    goTo(p) {
      window.location = p.url;
    }
  },
  mounted() {
    !this.category
      ? axios
          .get("/categories/" + this.sup + "/" + this.locale)
          .then(r => {
            this.categories = r.data.map(d => ({
              ...d,
              products: []
            }));
          })
          .catch(e => console.log(e.response))
      : this.categories.push({ ...this.category, products: [] });

    axios.get("/eco-page-url/" + this.locale).then(r => {
      this.eco_page = r.data;
    });
  }
};
</script>
