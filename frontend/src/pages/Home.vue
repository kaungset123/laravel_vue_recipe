<template>
  <div class="">
    <div class="absolute">
      <p
        v-if="editshow"
        class="text-center text-white bg-green-400 py-3 px-5 rounded-md fixed right-5 bottom-7"
        x-data="{show: true}"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
      >
        <font-awesome-icon
          icon="fa-solid fa-check-circle"
          class="text-white text-sm"
        />
        <span class="ms-4">A Recipe Edited successfully</span>
      </p>
    </div>
    <div v-if="createshow" class="absolute">
      <p
        class="text-center text-white bg-green-400 py-3 px-5 rounded-md fixed right-5 bottom-7"
        x-data="{show: true}"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
      >
        <font-awesome-icon
          icon="fa-solid fa-check-circle"
          class="text-white text-sm"
        />
        <span class="ms-4">A Recipe Created successfully</span>
      </p>
    </div>
    <div v-if="deleteshow" class="absolute z-10">
      <p
        class="text-center text-white bg-green-400 py-3 px-5 rounded-md fixed right-5 bottom-7"
        x-data="{show: true}"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
      >
        <font-awesome-icon
          icon="fa-solid fa-check-circle"
          class="text-white text-sm"
        />
        <span class="ms-4">A Recipe Deleted successfully</span>
      </p>
    </div>
    <header>
      <nav
        class="flex justify-between items-center h-[80px] border-b xl:px-[80px] md:px-[50px] px-[20px]"
      >
        <div class="relative sm:block hidden ms-2">
          <router-link :to="{ name: 'home' }" class="text-3xl">
            <img :src="imgUrl" alt="logoImg" class="w-[100px] h-[100px]" />
            <div class="absolute top-9 left-[-20px] w-full font-bold">
              <span class="text-[26px]">Burmese</span>
              <span class="text-[18px] ms-2 text-green-500">Cousine</span>
            </div>
          </router-link>
        </div>
        <div class="block sm:hidden">
          <router-link :to="{ name: 'home' }" class="text-3xl">
            <div class="top-9 w-full font-bold">
              <span class="text-[26px]">Burmese</span>
              <p class="text-[18px] ms-6 text-green-500">Cousine</p>
            </div>
          </router-link>
        </div>
        <div v-if="user" class="flex gap-3">
          <div
            class="group-hover:text-blue-500 text-sm flex flex-col justify-center text-right"
          >
            <a href="javascript:void(0)" @click="handleLogout" class="font-semibold hover:scale-110 duration-300 hover:text-red-400">Logout</a>
          </div>
          <div class="group">
            <img
              :src="'http://localhost:8000' + user?.image"
              alt="image"
              class="group w-[60px] h-[60px] rounded-full"
            />
          </div>
        </div>
        <div v-if="!user" class="flex justify-center items-center gap-6 ">
            <router-link :to="{ name: 'register'}" class="hover:text-blue-500 hover:scale-105 duration-300">Register</router-link>
            <router-link :to="{ name: 'login'}" class="hover:text-blue-500 hover:scale-105 duration-300">Login</router-link>
        </div>
      </nav>
    </header>
    <main class="xl:px-[80px] md:px-[50px] px-[20px]">
      <!-- Welcome Message Start -->
      <div v-if="welcomeshow" class=" z-10 mt-3 absolute">
        <p
          class=" text-center text-white bg-green-400 py-3 px-5 rounded-md right-5 bottom-7"
          x-data="{show: true}"
          x-init="setTimeout(() => show = false, 3000)"
          x-show="show"        
        >
          Hello Welcome! Let's Create Awesome Burmese Recipe!
        </p>
      </div>
      <!-- Welcome Message End -->

      <!-- Logout Message Start -->
      <div v-if="logoutMsg" class=" z-10 mt-3 absolute">
        <p
          class=" text-center text-white bg-green-400 py-3 px-5 rounded-md right-5 bottom-7"
          x-data="{show: true}"
          x-init="setTimeout(() => show = false, 3000)"
          x-show="show"        
        >
          You're Logout out! See you
        </p>
      </div>
      <!-- Logout Message End -->

      <!-- Buttons Start -->
      <div v-if="user" class="flex justify-end gap-3 mt-4">
        <router-link
          :to="{ name: 'form' }"
          class="px-3 py-3 rounded-lg bg-red-400 hover:opacity-[0.85] transition-all duration-300 text-white flex items-center gap-2 hover:scale-105"
        >
          <font-awesome-icon
            icon="fa-solid fa-add"
            class="text-white text-sm"
          />
          <div class="text-sm">Add Recipe</div>
        </router-link>

        <router-link
          :to="{ name: 'form' }"
          class="px-3 py-3 text-sm rounded-lg bg-red-400 hover:opacity-[0.85] transition-all duration-300 text-white flex items-center gap-2 hover:scale-105"
        >
          <font-awesome-icon
            icon="fa-solid fa-add"
            class="text-white text-sm"
          />
          <div>Add Category</div>
        </router-link>
      </div>
      <!-- Buttons Start -->

      <h1
        class="text-center mt-11 text-5xl font-bold text-gray-800 leading-tight"
      >
        All your favorite <span class="font-bold text-red-400">recipes,</span
        ><br />
        <span class="font-bold text-red-400 ">in one place</span>
      </h1>

      <div class="justify-center md:flex hidden">
        <nav
          class="bg-red-400 text-white grid grid-flow-col text-center mt-14 rounded-md"
        >
          <div
            @click="filterRecipesByCategory('')"
            class="cursor-pointer hover:bg-white hover:text-red-400 hover:rounded-md transition-all duration-500 w-[120px] p-3 active"
          >
            All recipes
          </div>
          <template v-for="category in categories" :key="category.id">
            <div
              @click="filterRecipesByCategory(category.name)"
              class="cursor-pointer hover:bg-white hover:text-red-400 hover:rounded-md transition-all duration-500 w-[120px] p-3 active"
            >
              {{ category.name }}
            </div>
          </template>
        </nav>
      </div>

      <div class="justify-center mt-11 block md:hidden">
        <select
          class="appearance-none bg-red-400 text-white outline-none border-none p-3 w-[300px] text-center"
          name=""
          id=""
        >
          <option @click="filterRecipesByCategory" value="all">All</option>
          <template v-for="category in categories" :key="category.id">
            <option @click="filterRecipesByCategory" :value="category.name">
              {{ category.name }}
            </option>
          </template>
        </select>
      </div>

      <!-- recipe -->
      <div class="my-20 grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-12">
        <template
          v-if="!gettingRecipe"
          v-for="recipe in recipes"
          :key="recipe.id"
        >
          <router-link :to="{ name: 'detail', params: { id: recipe.id } }">
            <div
              class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg active:shadow-none transition-all duration-500 max-h-[500px]"
            >
              <img
                class="h-[300px] mb-4 rounded-t-lg w-full object-cover"
                :src="'http://localhost:8000' + recipe?.image"
                alt="product image"
              />
              <div class="px-5 pb-5">
                <div class="">
                  <h5
                    class="w-[70%] inline-block text-md font-semibold tracking-tight text-gray-900 dark:text-white"
                  >
                    {{ recipe.title }}
                  </h5>
                  <h5
                    class="float-right text-sm bg-red-400 px-[10px] py-[5px] rounded-md text-white"
                  >
                    {{ recipe.category.name }}
                  </h5>
                </div>

                <p class="line-clamp-2 mt-2 text-gray-500">
                  {{ recipe.description }}
                </p>
              </div>
            </div>
          </router-link>
        </template>
        <div v-else v-for="(_, index) in new Array(6)" :key="index">
          <div
            class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg active:shadow-none transition-all duration-500 max-h-[500px] animate-pulse"
          >
            <div
              class="h-[300px] mb-4 rounded-t-lg w-full object-cover bg-slate-700"
            ></div>
            <div class="px-5 pb-5">
              <div class="h-[5px] bg-slate-700 rounded-md"></div>
              <div class="h-[5px] mt-2 bg-slate-700 rounded-md"></div>
              <div class="h-[5px] w-[80%] mt-2 bg-slate-700 rounded-md"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- no recipe -->
      <div
        v-if="recipes.length == 0 && !gettingRecipe"
        class="flex justify-center text-white mb-10"
      >
        <router-link
          :to="{ name: 'form' }"
          class="bg-red-500 py-4 px-10 animate-pulse rounded-sm text-center cursor-pointer"
        >
          There is no recipes yet
          <p>Add recipe?</p>
        </router-link>
      </div>

      <div v-if="recipes.length > 0" class="flex gap-4 justify-center">
        <button
          :class="
            link.label === currentPage
              ? 'bg-red-500 text-white px-[10px] py-[5px] rounded-sm'
              : 'px-[10px] py-[5px] rounded-sm'
          "
          @click="getPaginatedRecipes(link.url)"
          v-for="link in links"
          :key="link.label"
          v-html="link.label"
        ></button>
      </div>
    </main>
  </div>
</template>

<script>
import { mapGetters } from "vuex/dist/vuex.cjs.js";
import image from "../logo/logo.png";

export default {
  data() {
    return {
      imgUrl: image,
      recipes: [],
      categories: [],
      gettingRecipe: true,
      links: [],
      currentPage: 1,
      editshow: this.$store.state.editMsg,
      createshow: this.$store.state.createMsg,
      deleteshow: this.$store.state.deleteMsg,
      welcomeshow: this.$store.state.welcomeMsg,
    };
  },
  methods: {
    async getRecipes() {
      try {
        let res = await this.$axios.get("/api/recipes");
        if (res) {
          this.recipes = res.data.data;
          this.gettingRecipe = false;
          this.links = res.data.links;
        }
      } catch (e) {
        console.log(e);
      }
    },
    async getCategories() {
      try {
        let res = await this.$axios.get("/api/categories");
        if (res) {
          this.categories = res.data;
        }
      } catch (e) {
        console.log(e);
      }
    },
    async filterRecipesByCategory(category) {
      try {
        let { data: recipe } = await this.$axios.get(
          `/api/recipes?category=${category}`
        );

        if (recipe) {
          this.recipes = recipe.data;
        }
      } catch (e) {
        console.log(e);
      }
    },
    async getPaginatedRecipes(url) {
      try {
        let pageNumber = url.split("page=")[1];
        let { data: recipes } = await this.$axios.get(
          `/api/recipes?page=${pageNumber}`
        );
        this.recipes = recipes.data;
        this.currentPage = pageNumber;
      } catch (e) {
        console.log(e);
      }
    },
    handleLogout() {
      localStorage.removeItem("token");
      this.$store.dispatch('user', null);
      this.$store.dispatch('logoutMsg', true);
    },
  },
  mounted() {
    this.getRecipes();
    this.getCategories();
  },
  computed: {
    ...mapGetters(['user']),
    ...mapGetters(['logoutMsg'])
  }
};
</script>
