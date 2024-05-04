import Home from '@/pages/Home.vue'
import Detail from '@/pages/Detail.vue'
import RecipeForm from '@/pages/RecipeForm.vue'
import Login from '@/pages/Login.vue'
import Register from '@/pages/Register.vue'
import Forgot from '@/pages/Forgot.vue'
import Reset from '@/pages/Reset.vue'

/** @ is define in vit.config.js */

const routes = [
   { path: '/', component: Home, name: 'home'},
   { path: '/recipe/:id', component: Detail, name: 'detail'},
   { path: '/recipeForm', component: RecipeForm, name: 'form',
      children: [
         {
            path: '/edit/:id',
            component: RecipeForm,
            name: 'editForm'
         }
      ] 
},
   { path: '/login', component: Login, name: 'login'},
   { path: '/register', component: Register, name: 'register'},
   { path: '/forgot', component: Forgot, name: 'forgot'},
   { path: '/reset/:token', component: Reset, name: 'reset'}
]

export default routes;
