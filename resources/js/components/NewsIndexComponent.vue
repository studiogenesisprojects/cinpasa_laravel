<template>
  <section class="intro-text py-5">
    <div>
      <div class="box-list pb-5 pt-0">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-12 my-3 d-flex" v-for="item in items" :key="item.id">
            <a :href="`${item.url}`" class="in h-100 bg-light">
              <figure
                class="bg-md bg-cover mb-0 box-list__figure">
                <img :src="`/storage/noticias/${item.image}`" :alt="`${item.title}`" class="box-list__img">
                </figure>
              <div class="info p-3 bg-white">
                <span class="category">
                  <strong>
                    <span v-for="cat in item.categories" :key="cat.id">
                      {{cat.title.substr()}}
                      <span v-if="index != item.categories.length - 1">/</span>
                    </span>
                  </strong>
                  · {{format(item.created_at).format('DD/MM/YYYY')}}
                </span>
                <h4 class="title-md text-primary">{{ item.title }}</h4>
                <p class="text-sm text-primary">{{ item.description }}</p>
                <span
                  class="badge badge-light"
                  v-for="(etiquetas, index) in item.noticiaEtiquetas"
                  :key="'batch-' + index"
                >
                  {{etiquetas.title}}
                  <span v-if="index != item.noticiaEtiquetas.length - 1">/</span>
                </span>
                <button class="btn btn-outline-primary mt-3">{{button}}</button>
              </div>
            </a>
          </div>
          <div class="col-md-12 text-center">
            <infinite-loading class="text-center" spinner="spiral" @infinite="loadMore">
              <div slot="no-more"></div>
              <div slot="no-results"></div>
            </infinite-loading>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";
import moment from "moment";

export default {
  directives: { InfiniteLoading, moment },

  data() {
    return {
      noMoreData: false,
      busy: false,
      searching: false,
      next: null,
      items: []
    };
  },
  props: ["button", "loading", "locale"],
  methods: {
    format(date) {
      return moment(date);
    },
    loadMore($state) {
      let url = this.items.length > 0 ? this.next : "/news/lazy/" + this.locale;
      axios
        .get(url)
        .then(res => {
          console.log(res, $state);
          this.next = res.data.next_page_url;
          this.items.push(...res.data.data);
          Vue.nextTick(function() {
            res.data.next_page_url ? $state.loaded() : $state.complete();
          });
        })
        .catch(e => console.log(e.response));
    }
  }
};
</script>
