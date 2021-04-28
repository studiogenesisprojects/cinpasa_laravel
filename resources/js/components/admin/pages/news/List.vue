<template>
  <div class="content-box">
    <div class="element-wrapper">
      <h6 class="element-header">
        Noticias
        <a-button
          type="primary"
          class="btn btn-primary float-right"
          @click="handleCreate"
        >Nueva noticia</a-button>
      </h6>
      <div class="element-box element-box-usuarios">
        <div class="row">
          <div class="col-md-12">
            <a-table
              class="table-responsive"
              :loading="showBlockUi"
              :dataSource="items"
              :columns="columns"
            >
              <span slot="action" slot-scope="item">
                <a-button class="mb-2" size="small" type="primary" @click="handleEdit(item)">Editar</a-button>
                <a-popconfirm
                  title="Estás seguro de borrar esta noticia?"
                  @confirm="handleDelete(item)"
                  okText="Si"
                  cancelText="No"
                >
                  <a-button size="small" type="danger">Borrar</a-button>
                </a-popconfirm>
              </span>

              <span slot="codes_lang" slot-scope="codes_lang">
                  <small>{{ codes_lang.join(", ") }}</small>
              </span>

              <span slot="tags" slot-scope="tags">
                <div color="gray" v-if="tags.length === 0">
                  <small>Sin etiquetas</small>
                </div>
                <div v-for="tag in tags" :key="tag.id">
                  <small>{{tag.title}}</small>
                </div>
              </span>
              <span slot="categories" slot-scope="categories">
                <div color="gray" v-if="categories.length === 0">
                  <small>Sin categorías</small>
                </div>
                <div v-for="cat in categories" :key="cat.id">
                  <small>{{cat.title}}</small>
                </div>
              </span>
            </a-table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: function() {
    return {
      items: [],
      columns: [
        {
          title: "Título",
          dataIndex: "title",
          scopedSlots: { customRender: "title" }
        },
        {
          title: "Idioma",
          dataIndex: "codes_lang",
          key: "codes_lang",
          scopedSlots: { customRender: "codes_lang" }
        },
        {
          title: "Redactor",
          dataIndex: "writer.name",
          key: "writer.name"
        },
        {
          title: "Etiquetas",
          dataIndex: "tags",
          key: "tags",
          scopedSlots: { customRender: "tags" }
        },
        {
          title: "Categorías",
          dataIndex: "categories",
          key: "categories",
          scopedSlots: { customRender: "categories" }
        },
        {
          title: "Acciones",
          key: "action",
          scopedSlots: { customRender: "action" }
        }
      ],
      showBlockUi: false
    };
  },

  methods: {
    handleCreate() {
      this.$router.push({
        name: "update",
        params: { allnews: this.items }
      });
    },
    handleEdit(item) {
      this.$router.push({
        name: "update",
        params: { item: item, allnews: this.items }
      });
    },
    async fetch() {
      return axios
        .get("/admin/news/fetch")
        .then(r => {
          console.log(r.data);
          this.items = r.data;
        })
        .catch(e => {
          console.log(e.response);
        });
    },
    handleDelete(item) {
      axios
        .delete("news/" + item.id)
        .then(r => {
          this.$message.success("Noticia eliminada correctamente!");
          this.$delete(this.items, this.items.indexOf(item));
        })
        .catch(e => {
          this.$message.error("Error al eliminar la noticia");
        });
    }
  },

  async mounted() {
    this.showBlockUi = true;
    await this.fetch();
    this.showBlockUi = false;
  }
};
</script>


<style>
.ant-tag {
  height: auto !important;
  padding: 6px !important;
  font-size: 12px !important;
  margin: 0 !important;
}
</style>
