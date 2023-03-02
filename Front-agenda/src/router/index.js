import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Edit from '../views/Edit.vue'
import Create from '../views/Create.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/contatos',
    redirect: '/'
  },
  {
    path: '/editar/:selectedContact',
    name: 'Edit',
    component: Edit,
    props: true
  },
  {
    path: '/adicionar',
    name: 'Create',
    component: Create
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
