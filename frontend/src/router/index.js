import { createRouter, createWebHistory } from 'vue-router'
import store from '../store/index.js';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Login',
      component: () => import('../views/Login/Login.vue'),
      meta: {
        title: '3C Plus'
      }
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/Login/Register.vue'),
      meta: {
        title: '3C Plus'
      }
    },
    {
      path: '/redefine',
      name: 'redefine',
      component: () => import('../views/Login/Redefine.vue'),
      meta: {
        title: '3C Plus'
      }
    },
    {
      path: '/reset-password/:token/:email',
      name: 'newpassword',
      component: () => import('../views/Login/NewPassword.vue'),
      meta: {
        title: '3C Plus'
      }
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: () => import('../views/DashBoard/DashBoard.vue'),
      meta: {
        title: '3C Plus'
      }
    },
    {
      path: '/UserProfile',
      name: 'UserProfile',
      component: () => import('../views/ExtraFeatures/UserProfile.vue'),
      meta: {
        title: '3C Plus'
      }
    },
    {
      path: '/teste',
      name: 'teste',
      component:() => import('../views/teste.vue'),
    },
    {
      path: '/Funil',
      name: 'Funil',
      component: () => import('../views/Funil/Funil.vue')
    },
    {
      path: '/Team',
      name: 'teams',
      component: () => import('../views/ExtraFeatures/Team.vue')
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
