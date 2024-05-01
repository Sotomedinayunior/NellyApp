<template>
    <div class="container">
        <!-- Contenedor de los tabs -->
        <div class="sidebar">
            <img
                src="./static/Logo_dashboard.png"
                alt=""
                width="40"
                height="40"
                class="img"
            />
            <div class="tab-buttons">
                <!-- Botones para cambiar entre pestañas -->
                <button
                    v-for="(tab, index) in tabs"
                    :key="index"
                    @click="changeTab(tab.name)"
                    :class="{ active: activeTab === tab.name }"
                >
                    <img :src="tab.icon" alt="Icono" />
                    <span>{{ tab.label }}</span>
                </button>
            </div>
            <form class="logout-form" @submit.prevent="submitForm">
                <button type="submit">Cerrar Sesión</button>
            </form>
        </div>
        <!-- Contenedor del contenido de los tabs -->
        <div class="content">
            <!-- Contenido de las pestañas -->
            <div class="tab-content">
                <component :is="activeTab"></component>
            </div>
        </div>
    </div>
</template>

<script>
import Reserva from "./Reserva.vue";
import Landigns from "./LandignsComponents.vue";
import Help from "./Help.vue";
import Axios from "axios";

import reservas from "./static/reservas.svg";
import landing from "./static/Landings.svg";
import ayuda from "./static/ayuda.svg";

export default {
    components: {
        Reserva,
        Landigns,
        Help
    },
    data() {
        return {
            tabs: [
                {
                    name: "Landigns",
                    label: "Landigns",
                    component: Landigns,
                    icon: landing
                },
                {
                    name: "Reserva",
                    label: "Reserva",
                    component: Reserva,
                    icon: reservas
                },
                {
                    name: "Help",
                    label: "Help",
                    component: Help,
                    icon: ayuda
                }
            ],
            activeTab: "Landigns" // Pestaña activa por defecto
        };
    },
    methods: {
        // Cambiar la pestaña activa
        changeTab(tabName) {
            this.activeTab = tabName;
        },
        // Método para enviar el formulario
        submitForm() {
            Axios.post("http://localhost:8000/logout").then(response => {
                localStorage.clear(); //limpio la cahe para no almacenar datos de otras sessiones
                this.$router.push("/login");
            });
        }
    }
};
</script>

<style scoped>
.img {
    margin: 25px 0 25px 10px;
}
.container {
    display: grid;
    grid-template-columns: 25% 75%;
}

.sidebar {
    grid-area: 1 / 1 / 2 / 2;
    background-color: white;
    height: 100vh;
    font-size: clamp(8px, 11px, 13px);
    display: flex;
    border-right: 2px solid #ff7f50;
    flex-direction: column; /* Para colocar el formulario al final */
}

.tab-buttons {
    margin: 10px;
}

.tab-buttons button {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
}

.tab-buttons span {
    margin-left: 10px;
}

.tab-buttons button.active {
    font-weight: bold;
    color: #f16822;
    width: 100%;
    border-bottom-style: solid; /* Estilo del borde inferior */
    border-bottom-width: 2px; /* Grosor del borde inferior */
    border-bottom-color: #f16822;
}

.logout-form {
    margin-top: auto; /* Para que el formulario esté al final */
    padding: 10px;
}

.logout-form button {
    background-color: #fff; /* Fondo blanco para el botón */
    color: #f16822; /* Color del texto */
    border: 2px solid #f16822; /* Borde del botón */
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
}

.logout-form button:hover {
    background-color: #f16822; /* Cambia el fondo al color principal al pasar el ratón */
    color: #fff; /* Cambia el color del texto al blanco */
}
</style>
