<template>
  <div class="row">
    <div class="col-12">
      <a-select
        size="large"
        showSearch
        placeholder="Click para ver la lista"
        optionFilterProp="children"
        @focus="handleFocus"
        @blur="handleBlur"
        @change="handleChange"
        :filterOption="filterOption"
      >
        <a-select-option
          v-for="app in apps"
          :key="app.id"
          :value="app.id"
          :pantone="name == 'colors[]' ? app.pantone : ''"
        >{{ app.name }}</a-select-option>
      </a-select>
    </div>
    <div class="col-12 py-3">
      <draggable v-model="selectedApps">
        <a-tag
          closable
          v-for="selectedApp in selectedApps"
          @close="(e) => handleRemoveApp(selectedApp)"
          :key="selectedApp.id"
        >
          {{ selectedApp.name }}
          <input type="hidden" :value="selectedApp.id" :name="name" />
        </a-tag>
      </draggable>
      <div></div>
    </div>
  </div>
</template>
<script>
import draggable from "vuedraggable";
export default {
  components: {
    draggable
  },
  data() {
    return {
      options: [],
      selectedApps: this.sitems ? Object.values(this.sitems) : [],
      apps: this.items
    };
  },
  props: ["items", "sitems", "name", "placeholder"],
  methods: {
    handleChange(value) {
      const app = this.items.filter(a => a.id === value)[0];
      this.selectedApps.push(app);
      const restOfapps = this.apps.filter(a => a !== app);
      this.apps = restOfapps;
    },
    handleRemoveApp(app) {
      const removedApp = this.selectedApps.filter(a => a === app);
      const apps = this.selectedApps.filter(a => a !== app);
      this.selectedApps = apps;
    },
    handleBlur() {
      console.log("blur");
    },
    handleFocus() {
      console.log("focus");
    },
    filterOption(input, option) {
      if (this.name == "colors[]") {
        return (
          option.data.attrs.pantone
            .toLowerCase()
            .indexOf(input.toLowerCase()) >= 0 ||
          option.componentOptions.children[0].text
            .toLowerCase()
            .indexOf(input.toLowerCase()) >= 0
        );
      } else {
        return (
          option.componentOptions.children[0].text
            .toLowerCase()
            .indexOf(input.toLowerCase()) >= 0
        );
      }
    }
  },
  mounted() {
    this.selectedApps = this.selectedApps.sort(
      (a, b) => a.pivot.order - b.pivot.order
    );
  }
};
</script>

<style>
.ant-tag {
  height: auto !important;
  padding: 12px !important;
  font-size: 16px;
  margin-bottom: 8px;
}
:root .ant-tag .anticon-close {
  font-size: 16px;
}
</style>
