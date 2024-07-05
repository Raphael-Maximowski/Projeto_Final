import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Login',
      component: () => import('../views/Login.vue'),
      meta: {
        title: '3C Plus'
      }
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/Register.vue'),
      meta: {
        title: '3C Plus'
      }
    },
    {
      path: '/email',
      name: 'email',
      component: () => import('../views/ConfirmEmail.vue'),
      meta: {
        title: '3C Plus'
      }
    },
    {
      path: '/redefine',
      name: 'redefine',
      component: () => import('../views/Redefine.vue'),
      meta: {
        title: '3C Plus'
      }
    },
    {
      path: '/newpassword',
      name: 'newpassword',
      component: () => import('../views/NewPassword.vue'),
      meta: {
        title: '3C Plus'
      }
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component:()=>import('../views/DashBoard.vue'),
      meta: {
        title: '3C Plus'
      }
    }
  ]
})



router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

export default router
