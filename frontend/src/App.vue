<template>
  <router-view v-slot="{ Component }">
    <component :is="Component" />
  </router-view>
</template>

<script>
  export default {
    async created() {
    let res = await this.$axios.get('/api/user');
    this.$store.dispatch('user', res.data)
  }
}
</script>
<style scoped>
</style>
