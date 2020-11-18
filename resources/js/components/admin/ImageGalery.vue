<template>
  <div class="clearfix">
    <input type="hidden" name="galery_id" :value="galery_id" />
    <a-upload
      :customRequest="handleUpload"
      listType="picture-card"
      :fileList="fileList"
      :remove="handleRemove"
      @preview="handlePreview"
      @change="handleChange"
    >
      <div>
        <a-icon type="plus" />
        <div class="ant-upload-text">Subir imagen</div>
      </div>
    </a-upload>
    <a-modal @ok="handleOk" title="Etiquetas ALT" :visible="previewVisible" @cancel="handleCancel">
      <div>
        <a-tabs>
          <a-tab-pane
            style="height: auto !important;"
            v-for="(language, i) in previewImage.languages"
            :tab="languages[i].code"
            :key="i"
          >
            <input class="form-control" type="text" v-model="language.alt" />
          </a-tab-pane>
        </a-tabs>
      </div>
    </a-modal>
  </div>
</template>
<script>
export default {
  data() {
    return {
      previewVisible: false,
      previewImage: "",
      fileList: this.galery
        ? this.galery.images.map(image => ({
            uid: image.id,
            name: "imagen",
            status: "done",
            url: "/storage/" + image.image,
            languages: this.languages.map(language => {
              const ml = image.languages.filter(
                l => l.language_id === language.id
              );
              return ml.length > 0
                ? ml[0]
                : {
                    language_id: language.id,
                    alt: ""
                  };
            })
          }))
        : [],
      galery_id: this.galery ? this.galery.id : null
    };
  },
  props: ["galery", "languages"],
  methods: {
    handleCancel() {
      this.previewVisible = false;
    },
    handlePreview(file) {
      this.previewImage = file;
      this.previewVisible = true;
    },
    handleChange({ fileList }) {
      this.fileList = fileList;
    },
    handleUpload({ onSuccess, onError, file }) {
      const url = "/admin/acabados/galery";
      const formData = new FormData();
      formData.set("galery_id", this.galery_id);
      formData.append("image", file);
      axios
        .post(url, formData)
        .then(r => {
          this.$set(this.fileList, this.fileList.length - 1, {
            uid: r.data.id,
            url: "/storage/" + r.data.image,
            name: "image",
            status: "done",
            languages: this.languages.map(language => ({
              language_id: language.id,
              alt: ""
            }))
          });
          this.galery_id = r.data.galery_id;
          onSuccess();
        })
        .catch(e => {
          onError();
          console.log(e.response);
        });
      return true;
    },
    handleRemove(file) {
      const url = "/admin/acabados/galery/";
      axios
        .delete(url + file.uid)
        .then(r => conole.log(r))
        .catch(e => console.log(e.response));
    },
    handleOk() {
      const url = "/admin/acabados/galery";

      const data = {
        finished_galery_image_id: this.previewImage.uid,
        languages: this.previewImage.languages
      };
      axios
        .post(url, data)
        .then(res => console.log(res))
        .catch(e => console.log(e.response));
    }
  },
  mounted() {
    $(".select2").select2();
  }
};
</script>
<style>
/* you can make up upload button and sample style by using stylesheets */
.ant-upload-select-picture-card i {
  font-size: 32px;
  color: #999;
}

.ant-upload-select-picture-card .ant-upload-text {
  margin-top: 8px;
  color: #666;
}

.ant-tabs-nav .ant-tabs-tab {
  height: auto !important;
}
</style>