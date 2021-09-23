/* eslint-disable no-unused-expressions */
import { createRouter, createWebHistory } from 'vue-router';
import store from '../store';
import Home from '../views/Home.vue';

const ifNotAuthenticated = (_to, _from, next) => {
  if (!store.getters['auth/isAuthenticated']) {
    store.dispatch('auth/getUser').then(() => {
      store.getters['auth/isAuthenticated'] ? next('/') : next();
    });
  }
};

const ifAuthenticated = (_to, _from, next) => {
  if (store.getters['auth/isAuthenticated']) {
    next();
    return;
  }
  store.dispatch('auth/getUser').then(() => {
    store.getters['auth/isAuthenticated'] ? next() : next('/login');
  });
};

const routes = [
  {
    path: '/',
    name: 'Home',
    beforeEnter: ifAuthenticated,
    component: Home,
  },
  {
    path: '/login',
    name: 'Login',
    beforeEnter: ifNotAuthenticated,
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "login" */ '../views/auth/Login'),
  },
  {
    path: '/register',
    name: 'Register',
    beforeEnter: ifNotAuthenticated,
    component: () => import('../views/auth/Register'),
  },
];

const router = createRouter({
  history: createWebHistory('/'),
  // eslint-disable-next-line no-unused-vars
  scrollBehavior(to, _from, _savedPosition) {
    if (to.hash) {
      return { selector: to.hash };
    }
    return { x: 0, y: 0 };
  },
  routes,
});

export default router;
