<template>
  <div class="searcher-menu">
    <form action method="post">
      <div class="bg-primary p-4">
        <div class="row searcher-menu__row">
          <div class="col-12">
            <div class="d-flex align-items-center mb-3 searcher-menu__trigger">
              <p class="text-white title-sm m-0">{{this.title}}</p>
              <div class="ml-auto">
                <span
                  class="text-white w-light underline"
                  data-toggle="collapse"
                  data-target="#searcher-collapse"
                  aria-expanded="false"
                  aria-controls="searcher-collapse"
                >
                  Más opciones de búsqueda
                  <i class="fas fa-angle-down"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-xl-11 col-md-10">
            <div class="row align-items-end">
              <div class="col-lg-3 col-md-6">
                <div class="form-group mb-0">
                  <a-auto-complete
                    class="form-control"
                    size="large"
                    style="width: 100%"
                    @select="handleSelectProduct"
                    @search="handleSearch"
                    :placeholder="this.pname"
                    :dataSource="results"
                    optionLabelProp="text"
                  >
                    <template slot="dataSource">
                      <a-select-option
                        v-for="result in results"
                        :key="result.id"
                        :value="result.url"
                        :text="result.name"
                      >{{ result.name }}</a-select-option>
                    </template>
                    <a-input></a-input>
                  </a-auto-complete>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="form-group mb-0">
                  <template>
                    <a-select
                      v-if="restOfMaterials[0]"
                      showSearch
                      :placeholder="this.pmaterials"
                      optionFilterProp="children"
                      :filterOption="filterMaterialOptions"
                    >
                      <a-select-option
                        v-for="material in restOfMaterials"
                        :key="material.id"
                        :value="material.id"
                      >{{ material.name }}</a-select-option>
                    </a-select>
                    <a-select
                      v-else
                      showSearch
                      :placeholder="this.pmaterials"
                      optionFilterProp="children"
                      :filterOption="filterMaterialOptions"
                    >
                      <a-select-option
                        v-for="material in materials"
                        :key="material.id"
                        :value="material.id"
                      >{{ material.name }}</a-select-option>
                    </a-select>
                  </template>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="form-group mb-0">
                  <template>
                    <a-select
                      showSearch
                      :placeholder="this.pcolors"
                      optionFilterProp="children"
                      @change="handleColorChange"
                      :filterOption="filterColorOptions"
                    >
                      <a-select-option
                        v-for="(color , index) in restOfColors.length>0 ? restOfColors : colors"
                        :key="index"
                        :value="color.id"
                      >{{ color.name }}</a-select-option>
                    </a-select>
                  </template>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="form-group mb-0">
                  <template>
                    <a-select
                      v-if="restOfApplications[0]"
                      showSearch
                      :placeholder="this.papplications"
                      optionFilterProp="children"
                      @change="handleApplicationChange"
                      :filterOption="filterColorOptions"
                    >
                      <a-select-option
                        v-for="application in restOfApplications"
                        :key="application.id"
                        :value="application.id"
                      >{{ application.name }}</a-select-option>
                    </a-select>

                    <a-select
                      v-else
                      showSearch
                      :placeholder="this.papplications"
                      optionFilterProp="children"
                      @change="handleApplicationChange"
                      :filterOption="filterColorOptions"
                    >
                      <a-select-option
                        v-for="application in applications"
                        :key="application.id"
                        :value="application.id"
                      >{{ application.name }}</a-select-option>
                    </a-select>
                  </template>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-1 col-md-2 mt-2 text-right">
            <!-- :loading="searching" -->
            <a-button type="primary" :disabled="disabledSearch" @click="handleSearchClick">
              {{
              Object.keys(productResults).length == 0
              ? this.button
              : this.button2
              }}
            </a-button>
          </div>
          <div class="col-12">
            <span class="searcher-menu__message" v-if="Object.keys(productResults).length > 0">
              {{this.busqueda}}
              {{
              Object.keys(productResults).length
              }}
              {{this.busqueda2}}
            </span>
          </div>
        </div>
      </div>

      <div class="searcher-menu__collapse collapse" id="searcher-collapse">
        <div class="row">
          <div class="col-md-7">
            <div class="form-group">
              <select class="form-control" id="product-type">
                <option value="1">Tipo de producto</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <select class="form-control" id="diameter">
                <option value="1">Diámetro</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <select class="form-control" id="plotted">
                <option value="1">Trazado</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <select class="form-control" id="shape">
                <option value="1">Forma</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <select class="form-control" id="finished">
                <option value="1">Acabado</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      results: [],
      selectedMaterial: null,
      selectedColor: null,
      selectedApplication: null,
      disabledSearch: true,
      searching: false,
      searchResultsModal: false,
      productResults: [],
      restOfColors: [],
      restOfApplications: [],
      restOfMaterials: [],
      filteredByColors: {},
      filteredByApplications: {},
      filteredByMaterials: {},
      lastChange: null
    };
  },
  props: [
    "products",
    "materials",
    "colors",
    "applications",
    "title",
    "subtitle",
    "pname",
    "pmaterials",
    "pcolors",
    "papplications",
    "button",
    "button2",
    "busqueda",
    "busqueda2"
  ],
  //   mounted: function() {
  //     console.log(this.pApplications);
  //   },
  methods: {
    handleSearch(value) {
      this.searchResult(value);
    },
    searchResult(query) {
      this.results = this.products.filter((item, index) => {
        return item.name.toLowerCase().includes(query);
      });
    },
    filterMaterialOptions(input, option) {
      return (
        option.componentOptions.children[0].text
          .toLowerCase()
          .indexOf(input.toLowerCase()) >= 0
      );
    },
    filterColorOptions(input, option) {
      return (
        option.componentOptions.children[0].text
          .toLowerCase()
          .indexOf(input.toLowerCase()) >= 0
      );
    },
    filterApplication(input, option) {
      return (
        option.componentOptions.children[0].text
          .toLowerCase()
          .indexOf(input.toLowerCase()) >= 0
      );
    },
    handleMaterialChange(value) {
      this.selectedMaterial = value;
      this.searching = true;
      this.disabledSearch = false;

      if (this.lastChange == "materials") {
        this.productResults = [];
      } else if (this.lastChange == "colors") {
        this.productResults = Object.assign({}, this.filteredByColors);
      } else if (this.lastChange == "applications") {
        this.productResults = Object.assign({}, this.filteredByApplications);
      }

      axios
        .post("/search/materials", {
          id: this.selectedMaterial,
          products: Object.values(this.productResults).map(p => p.id)
        })
        .then(res => {
          this.productResults = res.data;
          this.searching = false;

          if (this.lastChange == null) {
            this.lastChange = "materials";
            this.filteredByMaterials = Object.assign({}, this.productResults);
          }

          Object.keys(this.productResults).forEach(index => {
            this.productResults[index].colors &&
              this.productResults[index].colors.forEach(color => {
                this.restOfColors.push(
                  ...this.colors.filter(c => {
                    if (!this.restOfColors.some(e => e.id === c.id)) {
                      return c.id === color.id;
                    } else {
                      return false;
                    }
                  })
                );
              });
          });

          Object.keys(this.productResults).forEach(index => {
            this.productResults[index].applications.forEach(appli => {
              this.restOfApplications.push(
                ...this.applications.filter(c => {
                  if (!this.restOfApplications.some(e => e.id === c.id)) {
                    return c.id === appli.id;
                  } else {
                    return false;
                  }
                })
              );
            });
          });
        })
        .catch(e => {
          this.searching = false;
          console.log(e.response);
        });
    },
    handleColorChange(value) {
      this.selectedColor = value;
      this.searching = true;
      this.disabledSearch = false;

      if (this.lastChange == "colors") {
        this.productResults = [];
      } else if (this.lastChange == "materials") {
        this.productResults = Object.assign({}, this.filteredByMaterials);
      } else if (this.lastChange == "applications") {
        this.productResults = Object.assign({}, this.filteredByApplications);
      }

      axios
        .post("/search/colors2()", {
          id: this.selectedColor,
          products: Object.values(this.productResults).map(p => p.id)
        })
        .then(res => {
          this.productResults = res.data;
          this.searching = false;

          if (this.lastChange == null || this.lastChange == "colors") {
            this.lastChange = "colors";
            this.filteredByColors = Object.assign({}, this.productResults);
          }

          Object.keys(this.productResults).forEach(index => {
            this.productResults[index].materials.forEach(mat => {
              this.restOfMaterials.push(
                ...this.materials.filter(c => {
                  if (!this.restOfMaterials.some(e => e.id === c.id)) {
                    return c.id === mat.id;
                  } else {
                    return false;
                  }
                })
              );
            });
          });

          Object.keys(this.productResults).forEach(index => {
            this.productResults[index].applications.forEach(appli => {
              this.restOfApplications.push(
                ...this.applications.filter(c => {
                  if (!this.restOfApplications.some(e => e.id === c.id)) {
                    return c.id === appli.id;
                  } else {
                    return false;
                  }
                })
              );
            });
          });
        })
        .catch(err => {
          this.searching = false;
          console.log(err.response);
        });
    },
    handleApplicationChange(value) {
      this.selectedApplication = value;
      this.disabledSearch = false;
      this.searching = true;

      if (this.lastChange == "applications") {
        this.productResults = [];
      } else if (this.lastChange == "materials") {
        this.productResults = Object.assign({}, this.filteredByMaterials);
      } else if (this.lastChange == "colors") {
        this.productResults = Object.assign({}, this.filteredByColors);
      }

      axios
        .post("/search/applications", {
          id: this.selectedApplication,
          products: Object.values(this.productResults).map(p => p.id)
        })
        .then(res => {
          this.searching = false;
          this.productResults = res.data;

          if (this.lastChange == null || this.lastChange == "applications") {
            this.lastChange = "applications";
            this.filteredByApplications = Object.assign(
              {},
              this.productResults
            );
          }

          Object.keys(this.productResults).forEach(index => {
            this.productResults[index].materials.forEach(mat => {
              this.restOfMaterials.push(
                ...this.materials.filter(c => {
                  if (!this.restOfMaterials.some(e => e.id === c.id)) {
                    return c.id === mat.id;
                  } else {
                    return false;
                  }
                })
              );
            });
          });

          Object.keys(this.productResults).forEach(index => {
            this.productResults[index].colors &&
              this.productResults[index].colors.forEach(color => {
                this.restOfColors.push(
                  ...this.colors.filter(c => {
                    if (!this.restOfColors.some(e => e.id === c.id)) {
                      return c.id === color.id;
                    } else {
                      return false;
                    }
                  })
                );
              });
          });
        })
        .catch(err => {
          this.searching = false;
          console.log(err.response);
        });
    },
    handleSearchClick(e) {
      const productIds = Object.values(this.productResults).map(p => p.id);
      window.location.href = `/searcher/` + productIds.map(id => id + "-");
    },
    handleSelectProduct: function(e) {
      window.location.href = e;
    }
  }
};
</script>
