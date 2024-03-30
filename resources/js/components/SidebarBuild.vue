<template>
    <div class="container-fluid">
        <div class="row">
            <router-link to="/dashboard" class="create-landing-link">
                Cancelar Proceso
            </router-link>

            <img src="./static/Logo.png" class="centered-image" alt="Logo" />

            <button type="submit" class="btn" @click="handleContinue">
                Continuar
            </button>
        </div>
        <!-- Contenedor de los tabs -->
        <div class="sidebar">
            <div class="tab-buttons">
                <!-- Botones para cambiar entre pestañas -->
                <button
                    v-for="(tab, index) in tabs"
                    :key="index"
                    @click="changeTab(tab.name)"
                    :class="{ active: activeTab === tab.name }"
                >
                    <span>{{ tab.label }}</span>
                </button>
            </div>
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
import LandignsBuild from "./FormLandings.vue";
import FormVehiculo from "./FormVehiculo.vue";
import PreVieew from "./PreVieew.vue";
import axios from "axios";

export default {
    components: {
        LandignsBuild,
        FormVehiculo,
        PreVieew
    },
    data() {
        return {
            tabs: [
                {
                    name: "LandignsBuild",
                    label: "Logo & Colors",
                    component: LandignsBuild
                },
                {
                    name: "FormVehiculo",
                    label: "Add Vehiculo",
                    component: FormVehiculo
                },
                {
                    name: "PreVieew",
                    label: "Review",
                    component: PreVieew
                }
            ],
            activeTab: "LandignsBuild" // Pestaña activa por defecto
        };
    },
    methods: {
        // Cambiar la pestaña activa
        changeTab(tabName) {
            this.activeTab = tabName;
        },
        handleContinue() {
            // Obtener referencia al formulario LandingsBuild
            const landingsBuildForm = this.$refs.landingsBuildForm;

            // Enviar el formulario LandingsBuild
            if (
                landingsBuildForm &&
                typeof landingsBuildForm.submit === "function"
            ) {
                landingsBuildForm.submit();
            } else {
                console.error("No se pudo enviar el formulario LandingsBuild.");
            }

            // Cambiar a la siguiente pestaña
            this.changeTab("FormVehiculo");
        }
    }
};
</script>

<style scoped>
.container-fluid {
    width: 100%;
    display: grid;
    place-content: center;
    grid-template-columns: 1fr; /* Columna única que ocupa todo el ancho disponible */
    grid-template-areas: "row" "sidebar" "content"; /* Posicionamiento de los elementos */
}

.sidebar {
    grid-area: sidebar;
    width: 100%;
    border-bottom: 1px solid #ddd; /* Línea inferior */
}

.tab-buttons {
    display: flex;
    width: 100%; /* Ajuste al 100% del ancho disponible */
}

.tab-buttons button {
    flex: 1;
    padding: 10px;
    border: none;
    background: none;
    cursor: pointer;
    text-align: center; /* Centrar el texto */
}

.tab-buttons button.active {
    font-weight: bold;
    color: #f16822;
    border-bottom: 4px solid #f16822; /* Línea inferior */
}

.content {
    grid-area: content;
    padding: 20px;
    width: 100%; /* Ajuste al 100% del ancho disponible */
}

.row {
    display: flex;
    flex-direction: row;
    justify-content: space-between; /* Distribuye los elementos al principio, al final y los restantes alrededor */
    align-items: center; /* Centra verticalmente los elementos */
    margin: 10px 0px 15px 0;
}

.row .create-landing-link {
    padding: 10px;
    border-radius: 5px;
    background-color: #f16822;
    color: #fff;
    font-size: 15px;
    border: none;
    cursor: pointer;
    text-decoration: none; /* Quita el subrayado del enlace */
}

.create-landing-link:hover {
    background-color: #ff7f50; /* Cambia el color al pasar el ratón */
}

.centered-image {
    margin-left: auto;
    margin-right: auto;
}
</style>
