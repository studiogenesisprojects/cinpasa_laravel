<template>
  <div class="content-box">
    <div class="element-wrapper">
      <h6 class="element-header">
        Carousels
        <a-button
          type="primary"
          class="btn btn-primary float-right"
          @click="handleCreate"
        >Nuevo carousel</a-button>
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
              <span slot="active" slot-scope="item">
                <a-switch :checked="item.active == 1" @change="handleToggleActive(item)"></a-switch>
              </span>
              <span slot="main" slot-scope="item">
                <a-switch :checked="item.main == 1" @change="handleToggleMain(item)"></a-switch>
              </span>
              <span slot="action" slot-scope="item">
                <a-button class="mb-2" size="small" type="primary" @click="handleEdit(item)">Editar</a-button>
                <a-popconfirm
                  title="Estás seguro de borrar?"
                  @confirm="handleDelete(item)"
                  okText="Si"
                  cancelText="No"
                >
                  <a-button size="small" type="danger">Borrar</a-button>
                </a-popconfirm>
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
          title: "Nombre",
          dataIndex: "name"
        },
        {
          title: "Activo",
          key: "active",
          scopedSlots: { customRender: "active" }
        },
        {
          title: "Principal",
          key: "main",
          scopedSlots: { customRender: "main" }
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
        name: "update"
      });
    },
    handleEdit(item) {
      this.$router.push({
        name: "update",
        params: { item: item }
      });
    },
    async fetch() {
      return axios
        .get("/admin/carousel")
        .then(r => {
          console.log(r.data);
          this.items = r.data;
        })
        .catch(e => {
          if (e.response.status === 403) {
            window.location.reload();
          }
          console.log(e.response);
        });
    },
    handleDelete(item) {
      axios
        .delete("/admin/carousel/" + item.id)
        .then(r => {
          this.$message.success("Carousel eliminado correctamente!");
          this.$delete(this.items, this.items.indexOf(item));
        })
        .catch(e => {
          this.$message.error("Error al eliminar el carousel");
        });
    },
    handleToggleActive(item) {
      axios.get("/admin/carousel/toggle-active/" + item.id).then(r => {
        item.active = !item.active;
      });
    },
    handleToggleMain(item) {
      axios.get("/admin/carousel/toggle-main/" + item.id).then(r => {
        item.main = !item.main;
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