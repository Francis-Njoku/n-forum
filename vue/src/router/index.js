import { createWebHistory, createRouter } from "vue-router";
import Books from "../views/Books.vue";
import Login from "../views/Login.vue";
import BookView from "../views/BookView.vue";
import Register from "../views/Register.vue";
import DefaultLayout from "../components/DefaultLayout.vue";
import AuthLayout from "../components/AuthLayout.vue";
import store from "../store";

const routes = [
  {
    path: "/",
    redirect: "/books",
    name: "Books",
    component: DefaultLayout,
    meta: { requiresAuth: true },
    children: [{ path: "/books", name: "Books", component: Books }],
  },
  {
    path: "/book/:id",
    name: "BookView",
    component: BookView,
  },
  {
    path: "/auth",
    redirect: "/login",
    name: "Auth",
    component: AuthLayout,
    meta: { isGuest: true },
    children: [
      {
        path: "/register",
        name: "Register",
        component: Register,
      },
      {
        path: "/login",
        name: "Login",
        component: Login,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

/*router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({ name: "Login" });
  } else if (store.state.user.token && to.meta.isGuest) {
    next({ name: "Books" });
  } else {
    next();
  }
});*/
export default router;
