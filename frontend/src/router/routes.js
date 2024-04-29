import Home from '@/pages/Home.vue'
import Detail from '@/pages/Detail.vue'
import RecipeForm from '@/pages/RecipeForm.vue'

/** @ is define in vit.config.js */

const routes = [
   { path: '/', component: Home, name: 'home'},
   { path: '/detail', component: Detail, name: 'detail'},
   { path: '/recipeForm', component: RecipeForm, name: 'form'},
]

export default routes;