<template>
    <header>
      <nav class="flex  justify-between items-center h-[80px] border-b xl:px-[80px] md:px-[50px] px-[20px]">
        <div>
          <router-link :to="{name: 'home'}" class="text-3xl text-green-400 font-semibold">My Recipe</router-link>
        </div>
        <div>
          <router-link :to="{name : 'form'}" class="px-3 py-3 rounded-lg bg-red-400 hover:opacity-[0.85] transition-all duration-200 text-white flex items-center gap-2 hover:scale-105">
            <font-awesome-icon
            icon="fa-solid fa-add"
            class="text-white text-sm"
          />
            <div>Add Recipe</div>
          </router-link>
        </div>
      </nav>
    </header>
   
    <main v-if="!gettingDetail" class="flex gap-5 items-center md:flex-row flex-col xl:px-[80px] md:px-[50px] px-[20px] my-11">
      <div class="w-full">
        <img  class="w-full  object-cover rounded-md" :src="'http://localhost:8000' + recipe.image"  alt="product image" />
      </div>

        <div  class="space-y-5">
          <h5 class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">
            {{ recipe.title }}
          </h5>
          <p class="text-gray-500">
            {{ recipe.description }}
          </p>
          <div class="flex gap-4 border-t py-5 justify-end">
            <router-link :to="{ name: 'editForm', params: { id: recipe.id} }" class="bg-blue-400 text-white px-4 py-2 rounded-lg hover:scale-110 duration-200">Edit</router-link>
            <button @click="deleteRecipe(recipe.id)" class="bg-red-500 text-white px-3 py-2 rounded-lg hover:scale-110 duration-200">Delete</button>
          </div>
        </div>
    </main>

    <main v-else class="flex gap-5 items-center md:flex-row flex-col xl:px-[80px] md:px-[50px] px-[20px] my-11">
      <div  class="animate-pulse h-[400px] w-[400px] rounded-md bg-slate-700">
      </div>
      <div  class=" animate-pulse">
          <div class="w-[100px] h-[15px] bg-slate-700">
          </div>
          <div class="w-[300px] h-[10px] mt-10 bg-slate-700">
          </div>
          <div class="w-[300px] h-[10px] mt-6 bg-slate-700">
          </div>
          <div class="flex gap-4 border-t py-5 mt-10">
            <button class="w-[100px] h-[40px] rounded-md bg-slate-700"></button>
            <button class="w-[100px] h-[40px] rounded-md bg-slate-700"></button>
          </div>
        </div>
    </main>
  </template>

<script>
  export default{
    data() {
      return {
        recipe : {},
        gettingDetail: true
      }
    },
    methods: {
       async getSingleRecipe(){     
        try{
          let id = this.$route.params?.id;
          let {data} = await this.$axios.get(`/api/recipes/${id}`);
          if(data){
            this.recipe = data;
            this.gettingDetail = false;
          }
        }catch(e){
          console.log(e)
        }
      },
      async deleteRecipe(id){
        if(window.confirm('Are you sure to delete this recipe ')){
          let res = await this.$axios.delete('/api/recipes/' + id);
          if(res){
            console.log(res)
            if(res.status == 200){
              this.$store.commit('showDeleteMsg');
              this.$router.push({ name: 'home'});
            }
          }
        }
        }     
    },
    mounted(){
      this.getSingleRecipe();
    }
  }

</script>