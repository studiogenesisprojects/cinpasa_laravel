<template>
  <div class="content-box">
    <div class="element-wrapper">
      <h6 class="element-header">
        {{ this.item ? "Actualizar" : "Crear" }} carousel
        <a-button class="btn btn-primary float-right" @click="handleGoBack">Volver</a-button>
      </h6>
      <div class="row justify-content-around">
        <div class="col-md-12">
          <a-card title="Información de la carousel">
            <div class="pb-3">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for class="d-block">Activo</label>
                    <a-switch v-model="carousel.active"></a-switch>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for class="d-block">Principal</label>
                    <a-switch v-model="carousel.main"></a-switch>
                  </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for>Nombre:</label>
                    <a-input class="form-control" v-model="carousel.name"></a-input>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for>Sección del carousel:</label>
                    <a-select class="form-control" v-model="carousel.section_id" :items="sections">
                      <a-select-option
                        v-for="n in sections"
                        :key="'n'+n.id"
                        :value="n.id"
                      >{{ n.name }}</a-select-option>
                    </a-select>
                  </div>
                </div>
              </div>
            </div>
            <slide
              ref="slides"
              v-for="(slide, index) in carousel.slides"
              :key="index"
              :slide="slide"
              :index="index"
              @onRemoveSlide="handleRemoveSlide"
              @onBeforeUpload="handleBeforeUploadSlideImage"
              @onDeleteImage="handleRemoveSlideImage"
              @onSlideImageUpdate="handleUpdateImage"
            />

            <a-divider></a-divider>

            <div>
              <a-button :disabled="carousel.slides.length == 0" @click="handleSave">Guardar</a-button>
              <a-button @click="handleAddSlide">Añadir Slide</a-button>
            </div>
          </a-card>
        </div>
      </div>
    </div>
  </div>
</template>    
<script>
import Axios from "axios";
import Slide from "./Slide";
export default {
  props: ["item"],
  components: {
    Slide
  },
  data() {
    return {
      showBlockUi: false,
      sections: [],
      carousel: this.item
        ? {
            ...this.item,
            active: this.item.active == 1,
            main: this.item.main == 1
          }
        : {
            slides: [],
            section_id: undefined,
            active: false,
            main: false,
            active: true
          }
    };
  },

  methods: {
    handleAddSlide() {
      this.carousel.slides.push({
        name: "",
        url: "",
        image: [],
        languages: [1, 2, 3, 4, 5].map(id => ({
          order: this.carousel.slides.length,
          language_id: id,
          name: undefined,
          text: undefined,
          url: undefined,
          alt_image: undefined,
          active: true
        }))
      });
    },
    handleRemoveSlide(slide) {
      if (slide.id) {
        //remove the slide from d
        axios
          .delete("/admin/carousel/delete-slide/" + slide.id)
          .then(r => {
            this.$message.success("Slide eliminado correctamente");
            this.$delete(
              this.carousel.slides,
              this.carousel.slides.indexOf(slide)
            );
          })
          .catch(e => {
            console.log(e.response);
            this.$message.error("Error al eliminar slide");
          });
      } else {
        this.$delete(this.carousel.slides, this.carousel.slides.indexOf(slide));
      }
    },
    handleGoBack() {
      this.$router.go(-1);
    },
    handleSave() {
      const refs = this.$refs.slides;
      let valid = true;
      refs.forEach(s => {
        if (!s.validate()) {
          valid = false;
          s.hasErrors = true;
          this.$message.error("Comprueba los datos obligatorios");
        }
      });

      if (!this.carousel.section_id) {
        valid = false;
        this.$message.error("Selecciona una sección para el carousel");
      }

      if (!valid) return;

      const data = new FormData();
      this.carousel.slides.forEach(slide => {
        slide.image.length > 0 && data.append("slidesImages[]", slide.image[0]);
      });
      data.set("carousel", JSON.stringify(this.carousel));

      if (this.carousel.id) {
        data.append("_method", "PATCH");
        axios
          .post("/admin/carousel/" + this.carousel.id, data)
          .then(r => {
            this.$message.success("Carousel actualizado correctamente");
            this.$router.push({ name: "index" });
          })
          .catch(e => {
            this.$message.error("Error al actualizar el carousel..");
          });
      } else {
        axios
          .post("/admin/carousel", data)
          .then(r => {
            this.$message.success("Carousel creado correctamente");
            this.$router.push({ name: "index" });
          })
          .catch(e => {
            this.$message.error("Error al crear el carousel..");
          });
      }
    },
    handleBeforeUploadSlideImage(slide, file) {
      slide.image = [...slide.image, file];
      return false;
    },
    handleRemoveSlideImage(slide, file) {
      const index = slide.image.indexOf(file);
      const images = slide.image.slice();
      images.splice(index, 1);
      slide.image = images;
    },
    handleUpdateImage(slide, url) {
      this.$set(slide, "image", [
        {
          uid: slide.id,
          url: url,
          name: "image",
          status: "done"
        }
      ]);
      this.$message.success("Imagen actualizada correctamente");
    },
    async fetchSections() {
      return axios.get("/admin/carousel/fetch-sections").then(r => {
        console.log(r);
        this.sections = r.data;
      });
    }
  },
  async mounted() {
    console.log(this.item);
    this.showBlockUi = true;
    await this.fetchSections();
    this.showBlockUi = false;
  }
};
</script>