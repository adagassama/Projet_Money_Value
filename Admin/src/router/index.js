import { createRouter, createWebHistory } from 'vue-router';
import DashboardView from "../views/DashboardView.vue";
import LoginView from "../views/LoginView.vue";
import RegisterView from "../views/RegisterView.vue";
import AddCurrencyView from "../views/AddCurrencyView.vue";
import AddPairView from "../views/AddPairView.vue";
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/admin',
      name: 'admin',
      component: DashboardView
    },
    {
      path: '/login',
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
      component: AddCurrencyView
    },
    {
      path: '/addPair',
      name: 'addPair',
      component: AddPairView
    }
  ]
})

export default router
