import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import StockHistoryView from '../views/StockHistoryView.vue'
import StockSearchView from '../views/StockSearchView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: StockSearchView
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView
    },
    {
      path: '/history',
      name: 'stock-history',
      component: StockHistoryView
    },
    {
      path: '/search',
      name: 'stock-search',
      component: StockSearchView
    }
  ]
})

export default router
