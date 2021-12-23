<template>
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-12">
        <h3 v-if="items.length > 0">{{ title }}</h3>
        <div v-else-if="items.length == 0 && firstLoadDone">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <h3>{{ noresult_title }}</h3>
                            <p class="mt-3">{{ noresult_subtitle }}</p>
                            <p class="mt-2">{{ noresult_sugg }}</p>
                            <ul class="ml-3 mt-3">
                                <li class="mt-2">{{ noresult_sugg1 }}</li>
                                <li class="mt-2">{{ noresult_sugg2 }}</li>
                            </ul>
                            <p class="color-primary"><strong>{{ noresult_nofound }}</strong></p>
                            <a :href="link" title="¿No encuentras lo que buscas? Contacta con nosotros y te ayudaremos" class="btn btn-third mt-4 px-3">{{noresult_contact}}</a>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-5 col-8 offset-lg-1 d-md-flex d-none align-items-center">
                            <img class="w-100" :src="img" alt="">
                        </div>
                    </div>
                </div>
            </section>
        </div>
      </div>
    </div>
    <br>
    <div class="row" v-if="items.length>0">
      <div class="col-md-3 col-sm-6 p-3" v-for="product in items" :key="product.id">
            <div class="position-relative">
                <img
                @click.stop="goTo(product)"
                v-if="product.primary_image"
                :src="`/storage/${product.primary_image.path.replace('public/', '')}`"
                :alt="product.primary_image.alt.length > 0 ? product.primary_image.alt : product.name"
                class="w-100 border-img"
                />
                <div class="position-absolute transform-t-50 d-flex b-0 r-0 mr-3">
                    <span
                        :id="product.id"
                    :class="'btn-icon favorit ' + (product.added ? 'active' : '') + setActive(product.id)"
                    @click.stop="favorite(product)"
                    >
                    <i class="far fa-heart"></i>
                    </span>
                </div>
                <a :id="`product_${product.id}`" :href="`${product.url}`" class="d-flex flex-column">
                    <p class="small color-blue mt-3">{{ product.categories[0].name }}</p>
                    <p class="font-bold color-black">{{ product.name }}</p>
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
  props: ["locale", "img", "title", "nresults", 'noresult_title', 'noresult_subtitle', 'noresult_sugg1', 'noresult_sugg2', 'noresult_nofound', 'noresult_contact', 'link', 'favorites'],

  name: "search-result-component",
  data() {
    return {
      items: [],
      favorites: [],
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
          this.$set(p, "added", (r.data.action)?' active':'');
          $('.num-fav').html(r.data.count);
          $('#favorites_count').html(r.data.count);
        })
        .catch(e => console.log(e.response, "favorite"));
    },
    setActive(id){
        var CSSActive = ""
        $.each(this.favorites, function(key, value) {
            if ((key == 'product-'+id) && (value == id)){
                console.log(id);
                CSSActive = " active";
                return;
            }
        });
        return CSSActive;
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
    this.firstLoadDone = true;
  }
};
</script>
