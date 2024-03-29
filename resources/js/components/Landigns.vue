<template>
    <div class="Wrapper">
        <div class="row">
            <h1 class="title">Tus Landings</h1>

            <div class="Actions-Sections">
                <input
                    type="search"
                    name=""
                    id=""
                    placeholder="Buscar un landings"
                />

                <button>+ Crear un nuevo landings</button>
            </div>
        </div>
        <div class="row-two">
            <select name="filterSelect" id="filterSelect" class="custom-select">
                <option value="ordenAlfabetico"
                    >filtrar por:ORDEN ALFABÉTICO</option
                >
            </select>
        </div>

        <div v-if="landings.length > 0" class="row">
            <div v-for="item in landings" :key="item.id" class="card">
                <h3>{{ landing.nombre }}</h3>
                <p>Logo: {{ landing.logo }}</p>
                <p>Color primario: {{ landing.primary_color }}</p>
                <p>Color secundario: {{ landing.secondary_color }}</p>
            </div>
        </div>
        <div v-else class="no-landings">
            <h3>No hay landings creadas</h3>
        </div>
    </div>
</template>
<script>
import Axios from "axios";
export default {
    data() {
        return {
            landings: []
        };
    },

    methods: {
        GetLandings() {
            Axios.get("http://localhost:8000/api/landings").then(response => {
                this.landings = response.data;
                console.log(response.data);
            });
        }
    },
    mounted() {
        this.GetLandings();
    }
};
</script>
<style scoped>
.Wrapper {
    padding: 20px;
}

.row {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

.row h1 {
    font-weight: 700;
    font-size: clamp(10px, 32px, 20px);
    margin-bottom: 10px; /* Añadido para separar el título del contenido */
}

.Actions-Sections {
    display: flex;
    flex-direction: row;
}

.row input[type="search"] {
    outline: none;
    width: 100%; /* Modificado para que ocupe todo el ancho en pantallas pequeñas */
    padding: 5px;
    margin-bottom: 10px; /* Añadido margen inferior */
    border-radius: 5px;
    border: 1px solid #e0e0e0;
    box-sizing: border-box;
}

.row input[type="search"]::placeholder {
    font-size: 12px;
}

.row button {
    width: 100%; /* Modificado para que ocupe todo el ancho en pantallas pequeñas */
    padding: 10px; /* Aumentado el padding para una mejor experiencia táctil */
    border-radius: 5px;
    background-color: #f16822;
    color: #fff;
    font-size: 15px;
    border: none;
    cursor: pointer;
}
.row-two {
    display: flex;
    justify-content: end;
    margin: 20px 0 20px 0;
}
.custom-select {
    appearance: none; /* Oculta el estilo predeterminado del select */
    padding: 10px 20px; /* Ajusta el relleno según sea necesario */
    border: 1px solid #f16822; /* Añade un borde */
    border-radius: 5px; /* Agrega bordes redondeados */
    background-color: #fff; /* Fondo blanco */
    color: #f16822; /* Color del texto */

    cursor: pointer; /* Cambia el cursor al pasar por encima */
    border-radius: 20px;
    font-size: clamp(0.8rem, 13px, 18px);
}

.custom-select:focus {
    outline: none; /* Elimina el contorno al enfocar */
    border-color: #f16822; /* Cambia el color del borde al enfocar */
}

/* Media query para pantallas pequeñas */
@media screen and (min-width: 768px) {
    .row {
        flex-direction: row;
        align-items: center; /* Alineación de los elementos en el centro */
    }

    .row input[type="search"] {
        width: auto; /* Revertido al ancho automático */
        margin-right: 10px; /* Separación entre el input y el botón */
        margin-bottom: 0; /* Eliminado el margen inferior */
    }

    .row button {
        width: auto; /* Revertido al ancho automático */
    }
}
</style>
