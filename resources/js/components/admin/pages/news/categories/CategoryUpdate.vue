<template>
  <div class="content-box">
    <div class="element-wrapper">
      <h6 class="element-header">
        {{ item ? 'Actualizar categoría':'Nueva categoría' }}
        <a-button class="btn btn-primary float-right" @click="handleGoBack">Volver</a-button>
      </h6>
      <div class="row justify-content-around">
        <div class="col-md-12">
          <a-card title="Detalles categoría">
            <a-tabs>
              <a-tab-pane
                style="height: auto !important;"
                v-for="language in news.languages"
                :tab="languageCodes[language.language_id-1]"
                :key="language.language_id"
              >
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for>Título</label>
                      <input class="form-control" type="text" v-model="language.title" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for>Slug</label>
                      <input class="form-control" type="text" v-model="language.slug" disabled />
                    </div>
                  </div>
                </div>
              </a-tab-pane>
            </a-tabs>
            <div>
              <a-button type="primary" @click="handleSave">Guardar</a-button>
            </div>
          </a-card>
        </div>
      </div>
    </div>
  </div>
</template>    
<script>
import Axios from "axios";
export default {
  props: ["item"],
  data() {
    return {
      showBlockUi: false,
      languageCodes: ["ES", "CA", "EN", "FR", "IT"],
      news: this.item
        ? { ...this.item }
        : {
            fileList: [],

            languages: [
              {
                language_id: 1
              },
              {
                language_id: 2
              },
              {
                language_id: 3
              },
              {
                language_id: 5
              },
              {
                language_id: 4
              }
            ]
          }
    };
  },

  methods: {
    handleSave() {
      this.item
        ? axios
            .patch("news/categories/" + this.news.id, this.news)
            .then(r => {
              console.log("ac", r);
              this.$message.success("Categoría actualizada correctamente");
              this.$router.go(-1);
            })
            .catch(e => {
              console.log(e.response);
            })
        : axios
            .post("news/categories", this.news)
            .then(r => {
              this.$message.success("Categoría creada correctamente");
              this.$router.go(-1);
            })
            .catch(e => {
              console.log(e.response);
            });
    },
    handleGoBack() {
      this.$router.go(-1);
    },
    string_to_slug(str) {
      str = str.replace(/^\s+|\s+$/g, ""); // trim
      str = str.toLowerCase();

      // remove accents, swap ñ for n, etc
      var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
      var to = "aaaaeeeeiiiioooouuuunc------";
      for (var i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
      }

      str = str
        .replace(/[^a-z0-9 -]/g, "") // remove invalid chars
        .replace(/\s+/g, "-") // collapse whitespace and replace by -
        .replace(/-+/g, "-"); // collapse dashes

      return str;
    }
  },

  watch: {
    news: {
      handler: function(newNews) {
        newNews.languages.forEach((i, index) => {
          i.title !== undefined &&
            this.$set(i, "slug", this.string_to_slug(i.title));
        });
      },
      deep: true
    }
  }
};

const columns = [
  { title: "title", dataIndex: "title", key: "title" },
  { title: "Fecha de creación", dataIndex: "created_at", key: "created_at" }
];
</script>
