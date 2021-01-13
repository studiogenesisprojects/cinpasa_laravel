<template>
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-12">
        <h3 v-if="items.length > 0">{{ title }}</h3>
        <div class="py-5" v-else-if="items.lenth == 0 && firstLoadDone">
          <h3>{{ nresults }}</h3>
        </div>
      </div>
    </div>
    <br>
    <div class="row" v-if="items.length>0">
      <div class="col-md-3" v-for="product in items" :key="product.id">
        <div class="box-product">
          <figure :class="'border mb-0 square box-product__figure ' + product.class">
            <img
              @click.stop="goTo(product)"
              v-if="product.primary_image"
              :src="`/storage/${product.primary_image.path.replace('public/', '')}`"
              :alt="product.primary_image.alt.length > 0 ? product.primary_image.alt : product.name"
              class="box-product__img"
            />
            <span
              :class="'add-product bg-light favorit ' + (product.added ? 'active' : '')"
              @click.stop="favorite(product)"
            >
              <i class="far fa-heart text-primary"></i>
            </span>
            <div class="info-eco--list" v-if="product.eco_logos && product.eco_logos.length > 0">
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
            <span
              :class="'add-product bg-light favorit ' + (favs.filter(f => f == product.id).length > 0 ? 'active' : '')"
              @click.stop="favorite(product)"
            >
              <i class="far fa-heart text-primary"></i>
            </span>
          </figure>
          <a :id="`product_${product.id}`" :href="`${product.url}`">
            <div class="box-product-info">
            <p class="small color-blue mt-3">{{ product.categories[0].name }}</p>
            <p class="font-bold color-black">{{ product.name }}</p>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-12 text-center">
        <infinite-loading v-if="nextUrl" class="text-center" spinner="spiral" @infinite="fetchNext">
          <div slot="no-more"></div>
          <div slot="no-results"></div>
        </infinite-loading>
      </div>
    </div>
  </div>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";

export default {
  components: {
    InfiniteLoading
  },
  props: ["locale", "favorites", "title", "nresults"],

  name: "search-result-component",
  data() {
    return {
      items: [],
      eco_page: undefined,
      favs: Object.values(this.favorites),
      currentPage: 1,
      nextUrl: null,
      firstLoadDone: false
    };
  },
  methods: {
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
    },
    goTo(p) {
      window.location = p.url;
    },
    async fetchNext($state) {
      const response = await axios.get(this.nextUrl.href);
      this.items.push(...response.data.results.data);
      if (response.data.results.next_page_url) {
        this.nextUrl = new URL(response.data.results.next_page_url);
        for (const append in response.data.appends) {
          this.nextUrl.searchParams.append(
            append,
            response.data.appends[append]
          );
        }
        $state.loaded();
      } else {
        $state.complete();
      }
    }
  },
  async mounted() {
    const query = window.location.search;
    const response = await axios.get(
      "/get-search-results/" + this.locale + "/" + query
    );
    this.items = response.data.results.data;
    if (response.data.results.next_page_url) {
      this.nextUrl = new URL(response.data.results.next_page_url);
      for (const append in response.data.appends) {
        this.nextUrl.searchParams.append(append, response.data.appends[append]);
      }
    }
    axios.get("/eco-page-url/" + this.locale).then(r => {
      this.eco_page = r.data;
    });
    this.firstLoadDone = true;
  }
};
</script>
