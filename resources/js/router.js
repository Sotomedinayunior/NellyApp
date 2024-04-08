import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "./view/Dashboard.vue";
import BuildLandings from "./view/BuildLandings.vue";
import Landings from "./view/Landings.vue";
import Login from "./view/Login.vue";

const routes = [
    { path: "/", redirect: "/dashboard", name: "Home" },
    {
        path: "/dashboard",
        component: Dashboard,
        meta: { requiresAuth: true },
        name: "Dashboard"
    },
    {
        path: "/contructor",
        component: BuildLandings,
        meta: { requiresAuth: true },
        name: "BuildLandings"
    },
    {
        path: "/View",
        component: Landings,
        meta: { requiresAuth: true },
        name: "Landings"
    },
    { path: "/login", component: Login, name: "Login" }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem("token");

    // Verifica si la ruta requiere autenticación
    if (to.meta.requiresAuth) {
        if (isAuthenticated) {
            // El usuario tiene un token válido, permite el acceso a la ruta
            document.title = `${to.name}`;
            next();
        } else {
            // El usuario no tiene un token válido, redirige a la página de inicio de sesión
            next("/login");
        }
    } else {
        // La ruta no requiere autenticación, permite el acceso
        document.title = `${to.name}`;
        next();
    }
});

export default router;
