<template>
     <div v-if="resetFail" class="sm:absolute sm:right-5 sm:bottom-10 flex justify-center mt-3">
      <p class=" text-center text-sm text-white bg-red-400 py-3 px-5 rounded-md"  x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
         Invalid Email !
      </p>
    </div>
    <div v-if="checkMail" class="sm:absolute sm:right-5 sm:bottom-10 flex justify-center mt-3">
      <p class=" text-center text-sm text-white bg-green-400 py-3 px-5 rounded-md"  x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
         We sent a message. Check your mail !
      </p>
    </div>
    <div v-if="resetTwice" class="sm:absolute sm:right-5 sm:bottom-10 flex justify-center mt-3">
      <p class=" text-center text-sm text-white bg-red-400 py-3 px-5 rounded-md"  x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
         Sorry! you can only reset password once
      </p>
    </div>
    <!-- Home Icon -->
        <router-link :to="{ name: 'home'}" class="absolute top-5 left-5">
            <div class="group flex items-center justify-center hover:bg-sky-500 duration-300 border-2 w-[45px] h-[45px] rounded-full ">
                <font-awesome-icon
                    icon="fa-solid fa-home"
                    class="group-hover:text-white text-md"
                    />
            </div>
        </router-link>
    <!-- Home Icon -->
     <div class="flex justify-center  sm:mt-[6rem] mt-[4rem] ">
        <form @submit.prevent="handleSubmit" class="shadow-md pt-8 pb-[3rem] sm:px-20 px-[20px] rounded-md w-[80%] sm:w-[500px]">
            <h1 class="text-[23px] text-center">Password Reset</h1>
            <div class="mt-5">
                <label for="email">Email</label><br>
                <input type="email" id="email" 
                v-model="email"
                :class="{ 'border-red-500 border-1 animate-pulse': error.email }"              
                class="input-style" >
                <font-awesome-icon v-if="error.email" icon="fa-solid fa-warning" class="text-red-600 animate-pulse text-sm" />
                <span v-if="error" class="text-red-500 text-sm ml-2 tracking-wider">{{ error.email }}</span>
            </div>
            <div class="flex justify-end mt-3">
               <button class="button-style px-6 py-2">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>
import { mapGetters } from "vuex/dist/vuex.cjs.js";

export default {
    data() {
        return {
            email: '',
            error: {}
        }
    },
    methods: {
        async handleSubmit(){
            try{
                let res = await this.$axios.post('/api/forgot',{
                email: this.email
                })
    
                let message = res.data.message;
                if(message.length > 50){
                    this.$store.dispatch('resetTwice', true)
                }else{
                    this.$store.dispatch('checkMail', true)
                }
            }catch(e){
                console.log(e.response.data.message)
                if(e.response.data.message){
                    this.$store.dispatch('resetFail', true)
                }else {
                    this.error = e.response.data.error
                }
            }
        }
    },
    computed: {
        ...mapGetters(['resetFail']),
        ...mapGetters(['checkMail']),
        ...mapGetters(['resetTwice']),
    }
}
</script>