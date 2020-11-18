<template>
  <div>
    <div
      class="row"
      v-infinite-scroll="loadMore"
      infinite-scroll-disabled="busy"
      infinite-scroll-distance="10"
    >
      <div class="col-lg-4 col-md-6 my-4" v-for="(product, i) in products" :key="'product' + i">
        <div class="box-product">
          <figure
            :class="'border mb-0 square box-product__figure ' + product.class">
          <img @click.stop="goTo(product)" v-if="`${product.primaryImage}`" :src="`/storage/${product.primaryImage.path}`" :alt="`${product.name}`" class="box-product__img">
            <span
              :class="'add-product bg-light favorit ' + (product.added ? 'active' : '')"
              @click.stop="favorite(product)"
            >
              <i class="far fa-heart text-primary"></i>
            </span>
            <!-- <span class="add-product bg-light favorit {{session()->exists("product-".$product->id) ? "active" : ""}}"
            id="{{$product->id}}"><i class="far fa-heart text-primary"></i></span>-->
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
    <a @click="handleShowMoreInfo" href="#info-request" class="sticky-btn-info btn btn-primary">
      <i class="far fa-comment mr-3"></i>
      {{ infobtn }}
    </a>
  </div>
</template>

<script>
import infiniteScroll from "vue-infinite-scroll";
import { log } from "util";

export default {
  directives: { infiniteScroll },

  data() {
    return {
      products: [],
      noMoreData: false,
      filterResults: [],
      busy: false,
      lastElement: 0,
      query: "",
      searching: false
    };
  },
  props: ["loading", "locale", "category", "infobtn"],
  mounted: function() {
    this.loadMore();
  },
  methods: {
    goTo(p) {
      window.location = p.url;
    },
    handleShowMoreInfo() {
      this.noMoreData = true;
      let element = document.getElementById("petition-form");
      element.scrollIntoView();
      setTimeout(() => (this.noMoreData = false), 1000);
    },
    loadMore() {
      if (!this.noMoreData) {
        this.busy = true;
        axios
          .get(
            "/products/lazy/" +
              (this.lastElement + 1) +
              "/" +
              this.category +
              "/" +
              this.locale
          )
          .then(res => {
            for (let i = 0; i < res.data.length; i++) {
              axios
                .get("/getProductUrl/" + res.data[i].id + "/" + this.locale)
                .then(response => {
                  $("#product_" + res.data[i].id).attr("href", response.data);
                  res.data[i].url = response.data;
                });
              this.products.push(res.data[i]);
            }

            this.busy = res.data.length === 0;
            this.lastElement = res.data[res.data.length - 1]
              ? res.data[res.data.length - 1].order
              : null;
            if (res.data.length == 0) {
              this.noMoreData = true;
            }
          })
          .catch(e => console.log(e.response));
      }
    },
    favorite(p) {
      axios
        .post("/fav", {
          value: p.id
        })
        .then(r => {
          this.$set(p, "added", r.data.action == "added");
          $("#header-fav-count").html(`(${r.data.count})`);
        })
        .catch(e => console.log(e.response, "favorite"));
    }
  }
};
</script>
