<template>
  <div class="content-box">
    <div class="element-wrapper">
      <h6 class="element-header">
        {{ item ? 'Actualizar redactor':'Nueva redactor' }}
        <a-button class="btn btn-primary float-right" @click="handleGoBack">Volver</a-button>
      </h6>
      <div class="row justify-content-around">
        <div class="col-md-12">
          <a-card title="Detalles redactor">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for>Nombre</label>
                  <input type="text" v-model="news.name" class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for>Imagen</label>
                  <div>
                    <a-upload
                      :fileList="news.fileList"
                      :remove="handleRemove"
                      :beforeUpload="beforeUpload"
                    >
                      <a-button>
                        <a-icon type="upload" :disabled="news.fileList.length === 0" />Selecciona imagen principal
                      </a-button>
                    </a-upload>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for>Email</label>
                  <input type="text" v-model="news.email" class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for>Facebook</label>
                  <input type="text" v-model="news.facebook" class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for>Twitter</label>
                  <input type="text" v-model="news.twitter" class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for>Linkedin</label>
                  <input type="text" v-model="news.linkedin" class="form-control" />
                </div>
              </div>
            </div>

            <div class="py-3">
              <a-tabs>
                <a-tab-pane
                  style="height: auto !important;"
                  v-for="language in news.languages"
                  :tab="languageCodes[language.language_id-1]"
                  :key="language.language_id"
                >
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for>Descripción</label>
                        <textarea
                          v-model="language.description"
                          class="form-control"
                          cols="20"
                          rows="4"
                        ></textarea>
                      </div>
                    </div>
                  </div>
                </a-tab-pane>
              </a-tabs>
            </div>
            <div>
              <a-button type="primary" @click="handleSave">{{ this.item ? "Actualizar": "Guardar" }}</a-button>
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
        ? { ...this.item, fileList: [] }
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
      let headers = {
        "Content-Type": "multipart/form-data",
        enctype: "multipart/form-data"
      };
      let formData = new FormData();
      if (this.news.fileList.length > 0) {
        formData.append("image", this.news.fileList[0]);
      }
      formData.set("writer", JSON.stringify(this.news));
      if (this.item) {
        formData.append("_method", "PATCH");
        axios
          .post("news/writers/" + this.news.id, formData, {
            headers: headers
          })
          .then(r => {
            this.$message.success("Redactor creado correctamente");
            this.$router.go(-1);
          });
      } else {
        axios
          .post("news/writers", formData, {
            headers: headers
          })
          .then(r => {
            this.$message.success("Redactor creado correctamente");
            this.$router.go(-1);
          });
      }
    },
    handleGoBack() {
      this.$router.go(-1);
    },
    beforeUpload(file) {
      this.news.fileList = [...this.news.fileList, file];
      return false;
    },
    handleRemove(file) {
      const index = this.news.fileList.indexOf(file);
      const newFileList = this.news.fileList.slice();
      newFileList.splice(index, 1);
      this.news.fileList = newFileList;
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
          i.name !== undefined &&
            this.$set(i, "slug", this.string_to_slug(i.name));
        });
      },
      deep: true
    }
  }
};
</script>
