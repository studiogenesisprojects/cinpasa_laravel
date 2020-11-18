<template>
  <div class="content-box">
    <div class="element-wrapper">
      <h6 class="element-header">
        Categorías de noticias
        <a-button
          type="primary"
          class="btn btn-primary float-right"
          @click="handleCreate"
        >Nueva categoría</a-button>
      </h6>
      <a-card>
        <div class="row">
          <div class="col-md-12">
            <a-table :loading="showBlockUi" :dataSource="items" :columns="columns">
              <span slot="action" slot-scope="item">
                <a-button type="primary" @click="handleEdit(item)">Editar</a-button>
                <a-divider type="vertical" />
                <a-popconfirm
                  title="Estás seguro de borrar esta categoría"
                  @confirm="handleDelete(item)"
                  okText="Si"
                  cancelText="No"
                >
                  <a-button type="danger">Borrar</a-button>
                </a-popconfirm>
              </span>
            </a-table>
          </div>
        </div>
      </a-card>
    </div>
  </div>
</template>    
<script>
export default {
  data: function() {
    return {
      items: [],
      showBlockUi: false,
      columns: [
        {
          title: "Nombre",
          dataIndex: "title",
          key: "title"
        },

        {
          title: "Num. noticias",
          dataIndex: "news",
          key: "news",
          customRender: c => c.length
        },

        {
          title: "Acciones",
          key: "action",
          scopedSlots: { customRender: "action" }
        }
      ]
    };
  },

  methods: {
    handleCreate() {
      this.$router.push({
        name: "categories-update"
      });
    },
    async fetch() {
      return axios
        .get("/admin/news/categories")
        .then(r => {
          console.log(r);
          this.items = r.data;
        })
        .catch(e => {
          console.log(e.response);
        });
    },
    handleEdit(item) {
      this.$router.push({
        name: "categories-update",
        params: { item: item }
      });
    },
    handleDelete(item) {
      return axios
        .delete("/admin/news/categories/" + item.id)
        .then(r => {
          this.$delete(this.items, this.items.indexOf(item));
          this.$message.success("Categoría eliminada correctamente");
        })
        .catch(e => {
          console.log(e.response);
        });
    }
  },

  async mounted() {
    this.showBlockUi = true;
    await this.fetch();
    this.showBlockUi = false;
  }
};

const columns = [
  { title: "title", dataIndex: "title", key: "title" },
  { title: "Fecha de creación", dataIndex: "created_at", key: "created_at" }
];
</script>
