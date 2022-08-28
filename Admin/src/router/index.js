import { createRouter, createWebHistory } from 'vue-router';
import DashboardView from "../views/DashboardView.vue";
import LoginView from "../views/LoginView.vue";
import RegisterView from "../views/RegisterView.vue";
import AddCurrencyView from "../views/AddCurrencyView.vue";
import AddPairView from "../views/AddPairView.vue";
import UpdatePairView from "../views/UpdatePairView.vue";
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/admin',
      name: 'admin',
      component: DashboardView,
      meta: { authOnly: true }
    },
    {
      path: '/',
      name: 'login',
      component: LoginView
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView
    },
    {
      path: '/addCurrency',
      name: 'addCurrency',
      component: AddCurrencyView,
      meta: { authOnly: true }
    },
    {
      path: '/addPair',
      name: 'addPair',
      component: AddPairView,
      meta: { authOnly: true }
    },
    {
      path: '/updatePair/:id',
      name: 'updatePair',
      props: true,
      component: UpdatePairView,
      meta: { authOnly: true }
    }
  ]
});

function isLoggedIn() {
  return localStorage.getItem("token");
}

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.authOnly)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (!isLoggedIn()) {
      next({
        path: "/",
        query: { redirect: to.fullPath }
      });
    } else {
      next();
    }
  } else if (to.matched.some(record => record.meta.guestOnly)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (isLoggedIn()) {
      next({
        path: "/admin",
        query: { redirect: to.fullPath }
      });
    } else {
      next();
    }
  } else {
    next(); // make sure to always call next()!
  }
});


export default router
