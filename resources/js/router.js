import { createRouter, createWebHistory } from "vue-router";
// import HomeView from "./view/home.vue";
import Dashboard from "./view/Dashboard.vue";
// import AboutView from "./view/about.vue";
import BuildLandings from "./view/BuildLandings.vue";
import Landings from "./view/Landings.vue";
import login from "./view/Login.vue";

const routes = [
    { path: "/", redirect: "/dashboard" },
    { path: "/dashboard", component: Dashboard, meta: { requiresAuth: true } }, // Ruta protegida

    { path: "/contructor", component: BuildLandings },
    { path: "/landings", component: Landings },
    { path: "/login", component: login }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    // Verifica si la ruta requiere autenticación
    if (to.meta.requiresAuth) {
        // Verifica si el usuario tiene un token válido
        const token = localStorage.getItem("token"); // Obtén el token del almacenamiento local (localStorage) o donde lo hayas almacenado

        if (token) {
            // El usuario tiene un token válido, permite el acceso a la ruta
            next();
        } else {
            // El usuario no tiene un token válido, redirige a la página de inicio de sesión
            next("/login");
        }
    } else {
        // La ruta no requiere autenticación, permite el acceso
        next();
    }
});

export default router;
