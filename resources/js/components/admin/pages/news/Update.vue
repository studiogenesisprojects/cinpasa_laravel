<template>
  <div class="content-box">
    <div class="element-wrapper">
      <h6 class="element-header">
        {{ this.item ? "Actualizar" : "Crear" }} noticia
        <a-button class="btn btn-primary float-right" @click="handleGoBack"
          >Volver</a-button
        >
      </h6>
      <div class="row justify-content-around">
        <div class="col-md-8">
          <a-card title="Información de la noticia">
            <div class="pb-3">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <a-upload
                      :fileList="news.fileList"
                      :remove="handleRemove"
                      :beforeUpload="beforeUpload"
                    >
                      <a-button>
                        <a-icon
                          type="upload"
                          :disabled="news.fileList.length === 0"
                        />Selecciona imagen principal
                      </a-button>
                    </a-upload>
                  </div>
                </div>
              </div>
            </div>
            <a-alert
              v-if="emptyTitleLanguages.length > 0"
              message="Cuidado!"
              :description="'Esta noticia no está traducida en todos los idiomas.'"
              type="error"
              style="margin-bottom: 10px;"
              show-icon
            />
            <a-tabs>
              <a-tab-pane
                style="height: auto !important"
                v-for="(language, i) in news.languages"
                :tab="languageCodes[language.language_id - 1]"
                :key="i"
              >
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for>Activa</label>
                      <div>
                        <a-switch v-model="language.active"></a-switch>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for>Título</label>
                      <input
                        class="form-control"
                        type="text"
                        v-model="language.title"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for>Slug</label>
                      <input
                        class="form-control"
                        type="text"
                        v-model="language.slug"
                        disabled
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for>Subtítulo</label>
                      <textarea
                        class="form-control"
                        name="description"
                        cols="30"
                        rows="2"
                        v-model="language.subtitle"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for>Descripción</label>
                      <textarea
                        class="form-control"
                        name="description"
                        cols="30"
                        rows="4"
                        v-model="language.description"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <rich-editor
                      :text="language.content"
                      @onContentChange="handleContentChange($event, language)"
                    ></rich-editor>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for>Título SEO</label>
                      <input
                        class="form-control"
                        type="text"
                        v-model="language.seo_title"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for>Descripción SEO</label>
                      <textarea
                        class="form-control"
                        name="description"
                        cols="30"
                        rows="4"
                        v-model="language.seo_description"
                      />
                    </div>
                  </div>
                </div>
              </a-tab-pane>
            </a-tabs>
            <a-divider></a-divider>
            <div class="pt-3">
              <div class="form-group">
                <strong>Noticias relacionadas</strong>
                <a-select
                  class="form-control"
                  v-model="news.relateds"
                  mode="multiple"
                  @select="handleSelectNews"
                  @deselect="handleDeselectNews"
                >
                  <a-select-option
                    v-for="n in allnews"
                    :key="'n' + n.id"
                    :value="n.id"
                    >{{ n.title }}</a-select-option
                  >
                </a-select>
              </div>
            </div>
          </a-card>
        </div>

        <div class="col-md-4">
          <a-card title="Características" class="control-card">
            <div class="row">
              <div class="col-md-12 pb-3">
                <label for>Estado:</label>
                <a-switch
                  v-model="news.active"
                  checkedChildren="Activada"
                  unCheckedChildren="Desactivada"
                  defaultChecked
                ></a-switch>
              </div>
              <div class="col-md-12 pb-3">
                <div class="form-group" v-if="!showBlockUi">
                  <label for>Redactor</label>
                  <a-select class="form-control" v-model="news.writer_id">
                    <a-select-option
                      :value="writer.id"
                      v-for="writer in writers"
                      :key="writer.id"
                      >{{ writer.name }}</a-select-option
                    >
                  </a-select>
                </div>
                <div class="form-group" v-if="!showBlockUi">
                  <label for>Categorías</label>
                  <a-select
                    class="form-control"
                    v-model="news.categories"
                    mode="multiple"
                  >
                    <a-select-option
                      v-for="category in categories"
                      :key="category.id"
                      :value="category.id"
                      >{{ category.title }}</a-select-option
                    >
                  </a-select>
                </div>
                <div class="form-group" v-if="!showBlockUi">
                  <label for>Etiquetas</label>
                  <a-select
                    class="form-control"
                    v-model="news.tags"
                    mode="multiple"
                  >
                    <a-select-option
                      v-for="tag in tags"
                      :key="tag.id"
                      :value="tag.id"
                      >{{ tag.title }}</a-select-option
                    >
                  </a-select>
                </div>
              </div>
            </div>
            <a-divider></a-divider>
            <a-button type="primary" @click="handleSave">Guardar</a-button>
          </a-card>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Axios from "axios";
import RichEditor from "./RichEditor";
import Application from "../../Application";
export default {
  components: {
    RichEditor,
    Application,
  },
  props: ["item", "allnews"],
  data() {
    return {
      showBlockUi: false,
      languageCodes: ["ES", "CA", "EN", "FR", "IT"],
      writers: [],
      tags: [],
      categories: [],
      news: this.item
        ? {
            ...this.item,
            relateds: this.item.related_news.map((r) => r.id),
            fileList: [],
            active: this.item.active == 1,
            categories: this.item.categories.map((c) => c.id),
            tags: this.item.tags.map((c) => c.id),
            languages: this.item.languages
              .map((l) => {
                return { ...l, active: l.active == 1 };
              })
              .sort((a, b) => {
                return a.language_id > b.language_id ? 1 : -1;
              }),
          }
        : {
            related: [],
            active: true,
            fileList: [],
            tags: [],
            categories: [],
            languages: [
              {
                language_id: 1,
                active: true,
              },
              {
                language_id: 2,
                active: true,
              },
              {
                language_id: 3,
                active: true,
              },
              {
                language_id: 5,
                active: true,
              },
              {
                language_id: 4,
                active: true,
              },
            ],
          },
    };
  },

  methods: {
    handleGoBack() {
      this.$router.go(-1);
    },
    handleSave() {
      const formData = new FormData();
      this.news.fileList.length > 0 &&
        formData.append("image", this.news.fileList[0]);
      formData.set("news", JSON.stringify(this.news));
      this.saving = true;
      let url = undefined;
      if (this.item) {
        formData.append("_method", "PATCH");
        url = "news/" + this.news.id;
      } else {
        url = "news";
      }
      axios
        .post(url, formData)
        .then((r) => {
          this.$message.success("Noticia guardada correctamente");
          this.$router.push({ name: "index" });
        })
        .catch((e) => {
          this.$message.error("Error al guardar la noticia");
        })
        .finally(() => {
          this.saving = false;
        });
    },
    async fetchWriters() {
      return axios.get("news/writers").then((r) => {
        this.writers = r.data;
      });
    },
    async fetchTags() {
      return axios.get("news/tags").then((r) => {
        this.tags = r.data;
      });
    },
    async fetchCategories() {
      return axios.get("news/categories").then((r) => {
        this.categories = r.data;
      });
    },
    handleContentChange(newContent, language) {
      this.$set(language, "content", newContent);
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
    },

    handleSelectNews(news) {
      if (this.news.id) {
        axios
          .post("news/relateds", {
            related_news_id: news,
            news_id: this.news.id,
          })
          .catch((e) =>
            this.$message.error("Error al añadir noticia relacionada")
          );
      }
    },
    handleDeselectNews(news) {
      if (this.news.id) {
        axios
          .delete("news/relateds/" + this.news.id + "/" + news)
          .catch((e) =>
            this.$message.error("Error al eliminar noticia relacionada")
          );
      }
    },
  },

  watch: {
    news: {
      handler: function (newNews) {
        newNews.languages.forEach((i, index) => {
          i.title &&
            i.title !== undefined &&
            this.$set(i, "slug", this.string_to_slug(i.title));
        });
      },
      deep: true,
    },
  },
    computed: {
    // Return languages without title
    emptyTitleLanguages () {
      let emptyLanguages = [];
      this.news.languages.forEach((language) => {
        if (language.title == null || language.title.trim() == null) {
          // If is empty add to the array of empty languages
          emptyLanguages.push(this.languageCodes[language.language_id - 1]);
        }
      });
      // `this` points to the vm instance
      return emptyLanguages;
    },
  },
  async mounted() {
    if (!this.allnews) {
      this.$router.push({
        name: "index",
      });
    }
    this.showBlockUi = true;
    await this.fetchWriters();
    await this.fetchTags();
    await this.fetchCategories();
    this.showBlockUi = false;
  },
};

const columns = [
  { title: "title", dataIndex: "title", key: "title" },
  { title: "Fecha de creación", dataIndex: "created_at", key: "created_at" },
];
</script>
