<template>
  <div class="content-box">
    <div class="element-wrapper">
      <h6 class="element-header">
        Redactores de noticias
        <a-button
          type="primary"
          class="btn btn-primary float-right"
          @click="handleCreate"
        >Nuevo redactor</a-button>
      </h6>
      <a-card>
        <div class="row">
          <div class="col-md-12">
            <a-table :loading="showBlockUi" :dataSource="items" :columns="columns">
              <span slot="action" slot-scope="item">
                <a-button v-if="writePermission" type="primary" @click="handleEdit(item)">Editar</a-button>
                <a-divider type="vertical" />
                <a-popconfirm
                  title="Estás seguro de borrar esta etiqueta?"
                  @confirm="handleDelete(item)"
                  okText="Si"
                  cancelText="No"
                >
                  <a-button v-if="deletePermission" type="danger">Borrar</a-button>
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
          dataIndex: "name",
          key: "name"
        },

        {
          title: "Num. noticias",
          dataIndex: "id",
          key: "id"
        },

        {
          title: "Acciones",
          key: "action",
          scopedSlots: { customRender: "action" }
        }
      ],
      writePermission: false,
      deletePermission: false
    };
  },

  methods: {
    handleCreate() {
      this.$router.push({
        name: "writers-update"
      });
    },
    async fetch() {
      return axios
        .get("/admin/news/writers")
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
        name: "writers-update",
        params: { item: item }
      });
    },
    handleDelete(item) {
      return axios
        .delete("/admin/news/writers/" + item.id)
        .then(r => {
          console.log(r);
          const newItems = this.items.slice(this.items.indexOf(item), 1);
          this.items = newItems;
        })
        .catch(e => {
          console.log(e.response);
        });
    },
    handleDelete(item) {
      return axios
        .delete("/admin/news/writers/" + item.id)
        .then(r => {
          this.$delete(this.items, this.items.indexOf(item));
          this.$message.success("Etiqueta eliminada correctamente");
        })
        .catch(e => {
          console.log(e.response);
        });
    },
    async hasPermission(permision) {
      const { data } = await axios.get(`/admin/has-permission/${permision}/noticias`)
      return data;
    }
  },

  async mounted() {
    this.showBlockUi = true;
    this.writePermission = await this.hasPermission("write")
    this.deletePermission = await this.hasPermission("delete")
    await this.fetch();
    this.showBlockUi = false;
  }
};
</script>
