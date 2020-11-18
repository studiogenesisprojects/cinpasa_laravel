<template>
    <div>
        <router-view v-cloak>
        </router-view>
        <BlockUI v-if="this.$root.showBlockUI" :html="template"></BlockUI>
    </div>
</template>
<script>
export default {
     data () {
        return {
            template: `<div class="loading-message"><div class="spinner-cube"><div></div><div></div><div></div><div></div></div><small>SINCRONIZANDO INFORMACIÓN DE LA PLATAFORMA</small></div>`,
        }
     }
}
</script>
