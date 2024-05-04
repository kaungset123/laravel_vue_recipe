<template>
    <div v-if="registerShow" class="sm:absolute sm:right-5 sm:bottom-10 flex justify-center mt-3">
      <p  class=" text-center text-sm text-white bg-green-400 py-3 px-5 rounded-md"  x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
         Registation successful ! please login.
      </p>
    </div>

    <div v-if="invalidMsg" class="sm:absolute sm:right-5 sm:bottom-10 flex justify-center mt-3">
      <p  class=" text-center text-sm text-white bg-red-400 py-3 px-5 rounded-md"  x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
         Invalid User ! Check your mail or password
      </p>
    </div>

    <div v-if="resetSuccess" class="sm:absolute sm:right-5 sm:bottom-10 flex justify-center mt-3">
      <p  class=" text-center text-sm text-white bg-green-400 py-3 px-5 rounded-md"  x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
         Your email reset successfully! please login
      </p>
    </div>

    <router-link :to="{ name: 'home'}">
        <div class="group flex items-center justify-center hover:bg-sky-500 duration-300 m-7 border-2 w-[45px] h-[45px] rounded-full ">
            <font-awesome-icon
                  icon="fa-solid fa-home"
                  class="group-hover:text-white text-md"
                />
        </div>
    </router-link>
    <div class="flex justify-center sm:mt-[4rem] mt-[4rem]">
        <form @submit.prevent="handleSubmit" class="shadow-md pt-8 pb-[3rem] sm:px-20 px-[20px] rounded-md w-[80%] sm:w-[500px]">
            <h1 class="text-[23px] text-center">Login</h1>
            <div class="mt-5">
                <label for="email">Email</label><br>
                <input v-model="data.email" type="email" id="email" 
                :class="{ 'border-red-500 border-1 animate-pulse': error.email }"              
                class="input-style" >
                <font-awesome-icon v-if="error.email" icon="fa-solid fa-warning" class="text-red-600 animate-pulse text-sm" />
                <span v-if="error" class="text-red-500 text-sm ml-2 tracking-wider">{{ error.email }}</span>
            </div>
            <div>
                <label for="password">Password</label><br>
                <input v-model="data.password" type="password" id="password" 
                :class="{ 'border-red-500 border-1 animate-pulse': error.password }"
                class="input-style">
                <font-awesome-icon v-if="error.password" icon="fa-solid fa-warning" class="text-red-600 animate-pulse text-sm" />
                <span v-if="error" class="text-red-500 text-sm ml-2 tracking-wider">{{ error.password }}</span>
            </div>
            <div class="flex justify-between">
               <router-link :to="{ name: 'forgot' }" class="text-sm text-blue-400">forgot password?</router-link>
               <button class="button-style px-6 py-2">login</button>
            </div>
        </form>
    </div>
</template>

<script>
import { mapGetters } from "vuex/dist/vuex.cjs.js";
import store from '../store';

export default {
    data() {
        return {
         registerShow : this.$store.state.registerMsg,
         data : {
            'email': '',
            'password': ''
         },
         error: {},
        }
    },
    methods: {
      async handleSubmit(){
         try{
            let res = await this.$axios.post('/api/login', this.data);    
            localStorage.setItem('token', res.data.token); 
            this.$store.dispatch('user', res.data.user);

            if(res.status == 200){
                this.$store.commit('showWelcomeMsg')
                this.$router.push({ name: 'home' });

            }   

         }catch(e){
            this.error = e.response.data.error
            this.$store.dispatch('invalidMsg', true);
         }
      }
    },
    mounted(){
    },
    computed: {
        ...mapGetters(['invalidMsg']),
        ...mapGetters(['resetSuccess'])
    }
}
</script>
