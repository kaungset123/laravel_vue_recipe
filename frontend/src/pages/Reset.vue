<template>
    <div class="flex justify-center mt-[3rem] w-full">
        <form @submit.prevent="handleSubmit" class="shadow-xl mb-5 pt-8 pb-[25px] sm:px-[5rem] p-[2rem] rounded-md w-[80%] sm:w-[500px]">
            <h1 class="text-[23px] text-center">Password Reset</h1>
            <div class="mt-5">
                <label for="password">Password</label><br>
                <input type="password" id="password"
                    v-model="data.password"  
                    :class="{ 'border-red-500 border-1 animate-pulse': error.password }"              
                    class="input-style" >
                <font-awesome-icon v-if="error.password" icon="fa-solid fa-warning" class="text-red-600 animate-pulse text-sm" />
                <span v-if="error.password" class="text-red-500 text-sm ml-2 tracking-wider">{{ error.password }}</span>
            </div>
            <div class="mt-5">
                <label for="pass">Confirm Password</label><br>
                <input type="password" id="pass"
                    v-model="data.password_confirm"  
                    :class="{ 'border-red-500 border-1 animate-pulse': error.password_confirm }"              
                    class="input-style" >
                <font-awesome-icon v-if="error.password_confirm" icon="fa-solid fa-warning" class="text-red-600 animate-pulse text-sm" />
                <span v-if="error.password_confirm" class="text-red-500 text-sm ml-2 tracking-wider">{{ error.password_confirm }}</span>
            </div>
            <div class="flex justify-end mt-7">
               <button class="button-style px-3 py-2">submit</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            data: {
                password: '',
                password_confirm: '',
                token: null
            },
            error: {}
        }
    },
    methods: { 
        async handleSubmit(){
            try{
                this.data.token = this.$route.params.token;
                let res = await this.$axios.post('/api/reset', this.data )
                this.$store.dispatch('resetSuccess', true)   
                this.$router.push({ name: 'login'})   
            }catch(e){
                this.error = e.response.data.error
            }
        }
    }
}
</script>