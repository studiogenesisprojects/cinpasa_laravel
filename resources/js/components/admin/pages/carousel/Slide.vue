<template>
  <a-card class="mb-3" :title="'Slide ' + (index+1)">
    <span slot="extra">
      <div class="col-md">
        <a-button
          @click="showPreview"
          cancelText="Ok"
          class="mr-3 btn-success"
          v-if="typeof slide.image == 'string'"
        >
          <a-icon type="eye" />Ver imagen
        </a-button>
        <a-modal v-model="visiblePreview">
          <img class="w-100" :src="'/storage/'+slide.image" />
          <template slot="footer">
            <a-button type="primary" @click="hidePreview">Ok</a-button>
          </template>
        </a-modal>
        <a-popconfirm
          title="Segúro que quieres eliminar este Slide?"
          okText="Si"
          cancelText="No"
          @confirm="handleRemoveSlide"
        >
          <a-button class="btn-danger" type="danger">Eliminar Slide</a-button>
        </a-popconfirm>
      </div>
    </span>
    <div class="row">
      <div class="col-md-12" v-if="hasErrors">
        <div class="alert alert-danger">La imagen del Slide es obligatoria</div>
      </div>
      <div class="col-md-2">
        <label for>Orden</label>
        <a-input-number class="form-control d-block" type="number" v-model="slide.order" />
      </div>
      <div class="col-md-4">
        <label>Imagen</label>
        <a-upload
          v-if="typeof slide.image == 'object'"
          class="d-block"
          :fileList="slide.image"
          :remove="handleDeleteImage"
          :beforeUpload="handleOnBeforeUpload"
        >
          <a-button block :disabled="slide.image.length > 0">
            <a-icon type="upload" />Seleccionar imagen
          </a-button>
        </a-upload>
        <a-upload class="d-block" v-else :customRequest="handleUpload">
          <a-button>
            <a-icon block type="upload" />Cambiar Imagen
          </a-button>
        </a-upload>
      </div>
      <div class="col-md-6">
        <label for>Url</label>
        <a-input v-model="slide.url" class="form-control" type="text" />
      </div>
      <div class="col-md-12 pt-4">
        <a-tabs>
          <a-tab-pane
            style="height: auto !important;"
            v-for="(language, i) in slide.languages"
            :tab="languageCodes[language.language_id-1]"
            :key="i+1"
          >
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for>Título</label>
                  <a-input class="form-control" type="text" v-model="language.title" />
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for>Descripción</label>
                  <textarea
                    class="form-control"
                    name="description"
                    cols="30"
                    rows="3"
                    v-model="language.text"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for>Etiqueta alt</label>
                  <a-input class="form-control" type="text" v-model="language.alt_img" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for>Título de url</label>
                  <a-input class="form-control" type="text" v-model="language.title_url" />
                  <small>Título del botón en caso de especificar una url</small>
                </div>
              </div>
            </div>
          </a-tab-pane>
        </a-tabs>
      </div>
    </div>
  </a-card>
</template>

<script>
export default {
  data() {
    return {
      hasErrors: false,
      languageCodes: ["ES", "CA", "EN", "FR", "IT"],
      visiblePreview: false
    };
  },
  name: "slide",
  props: ["slide", "index"],
  methods: {
    handleOnBeforeUpload(file) {
      this.$emit("onBeforeUpload", this.slide, file);
      return false;
    },
    handleDeleteImage(file) {
      this.$emit("onDeleteImage", this.slide, file);
    },
    handleRemoveSlide() {
      this.$emit("onRemoveSlide", this.slide);
    },
    handleUpload({ onSuccess, onError, file }) {
      const url = "/admin/carousel/slide-image/" + this.slide.id;
      const formData = new FormData();
      formData.append("image", file);
      axios
        .post(url, formData)
        .then(r => {
          console.log(r);
          this.$emit("onSlideImageUpdate", this.slide, r.data.image);
          onSuccess();
        })
        .catch(e => {
          onError();
          console.log(e.response);
        });
      return true;
    },
    validate() {
      return this.slide.image.length > 0;
    },
    showPreview() {
      this.visiblePreview = true;
    },
    hidePreview() {
      this.visiblePreview = false;
    }
  }
};
</script>