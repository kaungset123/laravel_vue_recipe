<template>
  <h1 class="bg-sky-700">Hello</h1>
  <ul v-for="category in categories" :key="category.id">
    <li>{{ category.name }}</li>
  </ul>
</template>

<script>
  export default {
    data(){
      return {
        categories: []
      }
    },
    methods: {
      async getCategories(){
        let res = await this.$axios.get('/api/categories');
        this.categories = res.data
      }
    },
    mounted(){
      this.getCategories()
    }
  }
</script>
<style scoped>
</style>
