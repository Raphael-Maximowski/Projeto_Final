import { createRouter, createWebHistory } from 'vue-router'
import store from '../store/index.js';

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
      path: '/reset-password/:token/:email',
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
  const user = store.getters.user_token;
  const rotasIndependentes = ['Login', 'register','redefine', 'newpassword'];
  if (rotasIndependentes.includes(to.name)) {
    next();
  } else {
    if (user == "") {
      next({
        path: '/',
        query: { redirect: to.fullPath }
      });
    } else {
      next();
    }
  }
});

export default router
