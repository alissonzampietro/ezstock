import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import StockHistoryView from '../views/StockHistoryView.vue'
import StockSearchView from '../views/StockSearchView.vue'
import ChartView from '../views/ChartView.vue'
import NotFoundView from '../views/NotFoundView.vue'

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
      component: StockHistoryView,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/search',
      name: 'stock-search',
      component: StockSearchView,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/chart',
      name: 'chart',
      component: ChartView,
      meta: {
        requiresAuth: true
      }
    },
    { 
      path: "/:pathMatch(.*)*", 
      name: 'not-found',
      component: NotFoundView 
    }
  ]
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    const token = localStorage.getItem('token');
    if (token) {
      next();
    } else {
      next('/login');
    }
  } else {
    next();
  }
});

export default router
