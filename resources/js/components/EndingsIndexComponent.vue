<template>
  <section class="intro-text py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-12">
          <img src="/storage/img/bar.svg" alt="bar" class="img-fluid my-4" />
          <h2 class="title-xl text-primary">{{this.title}}</h2>
          <p class="text text-default">{{this.text}}</p>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6 col-md-8 col-12">
          <div class="input-group filter mb-3">
            <label for="filter" class="d-none">filtrar</label>
            <input
              @keyup="handleSearch"
              type="text"
              class="form-control"
              id="filter"
              :placeholder="this.psearch"
              :aria-label="this.psearch"
              aria-describedby="basic-addon2"
            />
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon2">
                <i class="fas fa-search text-primary"></i>
              </span>
            </div>
          </div>
        </div>
        <div class="col-12">
          <hr />
        </div>
        <div class="col-12" v-if="filterResults.length === 0 && query.length > 0 && !searching">
          <div class="d-flex align-items-center justify-content-center">
            <span class="text-danger text-default text-center d-inline-block ml-4">{{this.noresult}}</span>
          </div>
        </div>
      </div>

      <div class="box-list pb-5 pt-0">
        <div
          v-if="filterResults.length === 0 && query.length === 0"
          v-infinite-scroll="loadMore"
          infinite-scroll-disabled="busy"
          infinite-scroll-distance="10"
        >
          <div class="row" v-for="(endingsBatch, index) in endingsBatches" :key="'batch-' + index">
            <div
              class="col-lg-4 col-md-6 col-12 my-3 d-flex"
              v-for="ending in endingsBatch"
              :key="ending.id"
            >
              <a :href="`${ending.url}`" class="in h-100 bg-light">
                <figure class="bg-md bg-cover mb-0 box-list__figure">
                  <img
                    :src="`${ending.image}`"
                    :alt="`${ending.alt ? ending.alt : ending.name}`"
                    class="box-list__img"
                  />
                </figure>
                <div class="info p-3">
                  <h4 class="title-md text-primary">{{ ending.name }}</h4>
                  <p class="text-sm text-primary"></p>
                  <button class="btn btn-outline-primary mt-4">{{ button }}</button>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="row" v-if="filterResults.length > 0">
        <div class="col-md-4 mb-3" v-for="ending in filterResults" :key="ending.id">
          <div class="in h-100 bg-light">
            <figure
              class="bg-md bg-cover mb-0"
              :style="`background-image: url('${ending.image}');`"
            ></figure>
            <div class="info p-3">
              <h4 class="title-md text-primary">{{ ending.name }}</h4>
              <p class="text-sm text-primary">{{ ending.text }}</p>
              <a :href="`${ending.url}`" class="btn btn-outline-primary mt-4">{{ button }}</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row" v-if="searching && query.length > 0">
        <div class="col-12">
          <div class="d-flex align-items-center justify-content-center">
            <div class="loader"></div>
            <span class="text-sm text-default text-center d-inline-block ml-4">{{this.buscando}}</span>
          </div>
        </div>
      </div>
      <!-- <div class="row" v-if="!noMoreData">
        <div class="col-12">
          <div class="d-flex align-items-center justify-content-center">
            <div class="loader"></div>
            <span class="text-sm text-default text-center d-inline-block ml-4">{{this.loading}}</span>
          </div>
        </div>
      </div>-->
    </div>
  </section>
</template>

<script>
import infiniteScroll from "vue-infinite-scroll";

export default {
  directives: { infiniteScroll },

  data() {
    return {
      endingsBatches: [],
      noMoreData: false,
      filterResults: [],
      busy: false,
      lastElement: 0,
      query: "",
      searching: false
    };
  },
  props: [
    "title",
    "text",
    "psearch",
    "noresult",
    "buscando",
    "button",
    "loading",
    "locale"
  ],
  mounted: function() {
    this.loadMore();
  },
  methods: {
    loadMore() {
      if (!this.noMoreData) {
        this.busy = true;
        axios
          .get("/endings/lazy/" + (this.lastElement + 1) + "/" + this.locale)
          .then(res => {
            console.log(res);
            this.endingsBatches.push(res.data);
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
    handleSearch(e) {
      this.query = e.target.value;
      this.searching = true;
      if (this.query.length > 0) {
        axios
          .post("endings/search", {
            query: this.query
          })
          .then(res => {
            this.searching = false;
            this.filterResults = res.data;
          });
      }
    }
  }
};
</script>
