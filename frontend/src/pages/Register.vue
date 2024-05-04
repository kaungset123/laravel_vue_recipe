<template>
    <router-link :to="{ name: 'home'}" class="absolute top-5 left-5">
        <div class="group flex items-center justify-center hover:bg-sky-500 duration-300 border-2 w-[45px] h-[45px] rounded-full ">
            <font-awesome-icon
                  icon="fa-solid fa-home"
                  class="group-hover:text-white text-md"
                />
        </div>
    </router-link>
    <div class="flex justify-center mt-[3rem] w-full">
        <form @submit.prevent="handleSubmit" class="shadow-xl mb-5 pt-8 pb-[25px] sm:px-[5rem] p-[2rem] rounded-md w-[80%] sm:w-[500px]">
            <h1 class="text-[23px] text-center">Register</h1>
            <div class="mt-5">
                <label for="name">Name</label><br>
                <input v-model="data.name" type="text" id="name"
                :class="{ 'border-red-500 border-1 animate-pulse': error.name }"              
                 class="input-style" >
                <font-awesome-icon v-if="error.name" icon="fa-solid fa-warning" class="text-red-600 animate-pulse text-sm" />
               <span v-if="error"class="text-red-500 text-sm ml-2 tracking-wider">{{ error.name }}</span>
            </div>
            <div>
                <label for="email">Email</label><br>
                <input v-model="data.email" type="email" id="email"
                :class="{ 'border-red-500 border-1 animate-pulse': error.email }"                          
                class="input-style" >
                <font-awesome-icon v-if="error.email" icon="fa-solid fa-warning" class="text-red-600 animate-pulse text-sm" />
                <span v-if="error"class="text-red-500 text-sm ml-2 tracking-wider">{{ error.email }}</span>
            </div>
            <div>
                <label for="password">Password</label><br>
                <input v-model="data.password" type="password" id="password"
                :class="{ 'border-red-500 border-1 animate-pulse': error.password }"              
                class="input-style">
                <font-awesome-icon v-if="error.password" icon="fa-solid fa-warning" class="text-red-600 animate-pulse text-sm" />
                <span v-if="error"class="text-red-500 text-sm ml-2 tracking-wider">{{ error.password }}</span>
            </div>
            <div>
                <label for="confirm">Confirm Password</label><br>
                <input v-model="data.password_confirm" type="password" id="confirm" 
                :class="{ 'border-red-500 border-1 animate-pulse': error.password_confirm }"                              
                class="input-style">
                <font-awesome-icon v-if="error.password_confirm" icon="fa-solid fa-warning" class="text-red-600 animate-pulse text-sm" />
                <span v-if="error"class="text-red-500 text-sm ml-2 tracking-wider">{{ error.password_confirm }}</span>
            </div>
            <div>
               <input 
                  @change="getUserImage"
                  type="file"
                  class="block"
                  accept="image/png, image/jpeg"
                  required 
                  />
            </div>
            <div class="mt-5">
                <label for="check">admin</label>
                <input v-model="data.is_admin" type="checkbox" id="check" class="ms-3">
            </div>
            <div class="flex justify-between mt-7">
                <router-link :to="{ name: 'login' }" class="text-sm text-blue-400">already registered? please login</router-link>
               <button class="button-style px-3 py-2">submit</button>
            </div>
        </form>
        </div>
</template>

<script>
export default {
    data() {
        return {
            data : {
               name: '',
               email: '',
               password: '',
               password_confirm: '',
               image: null,
               is_admin: null
            },
            error: {}
        }
    },
    methods: {
         async handleSubmit(){
            try{
              
            //     let res = await this.$axios.post('/api/register', this.data)
            //    if(res.status == 201){
            //          this.$store.commit('showRegisterMsg');
            //          this.$router.push({ name: 'login'});
            //       }
              
               let formData = new FormData();
               formData.append('name', this.data.name);
               formData.append('email', this.data.email);
               formData.append('password', this.data.password);
               formData.append('password_confirm', this.data.password_confirm);
               formData.append('is_admin', this.data.is_admin);
               formData.append('image', this.data.image);

               console.log(formData);

               let res = await this.$axios.post('/api/register', formData);
               if (res.status == 201) {
                     this.$store.commit('showRegisterMsg');
                     this.$router.push({ name: 'login' });
               }
            }catch(e){
               this.error = e.response.data.error
            }
         },
         getUserImage(e){
            let file = e.target.files[0];
            this.data.image = file;
         }
    },
    mounted(){
      
    }
}
</script>