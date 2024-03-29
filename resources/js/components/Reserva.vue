<template>
    <div class="Wrapper">
        <div class="row">
            <h1 class="title">Reservas</h1>

            <div class="Actions-Sections">
                <input
                    type="search"
                    name=""
                    id=""
                    placeholder="Buscar tu reserva"
                />
            </div>
        </div>
        <div class="row-two">
            <select name="filterSelect" id="filterSelect" class="custom-select">
                <option value="ordenAlfabetico"
                    >filtrar por: ORDEN ALFABÉTICO</option
                >
            </select>
        </div>
        <div v-if="reservas && reservas.length > 0" class="container">
            <!-- Tabla para mostrar las reservas -->
            <table class="reservas-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nombre del carro</th>
                        <th>$ Monto total</th>
                        <th>Hotel</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo electrónico</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Renderizamos las reservas dentro del bucle v-for -->
                    <tr v-for="(reserva, index) in reservas" :key="reserva.id">
                        <td>{{ index + 1 }}</td>
                        <td>
                            <img
                                :src="reserva.foto"
                                alt="Foto"
                                style="width: 50px; height: auto;"
                            />
                        </td>
                        <td>{{ reserva.nombre_carro }}</td>
                        <td>{{ reserva.monto_total }}</td>
                        <td>{{ reserva.hotel }}</td>
                        <td>{{ reserva.nombre }}</td>
                        <td>{{ reserva.apellido }}</td>
                        <td>{{ reserva.correo_electronico }}</td>
                        <td>{{ reserva.telefono }}</td>
                        <td>
                            <!-- Aquí puedes agregar los botones de acciones -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Si no hay reservas, mostramos un mensaje -->
        <div v-else class="container">
            <p class="no-reservas">No hay reservas disponibles</p>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            reserva: null
        };
    },
    methods: {
        GetReservas() {
            axios.get("http://localhost:8000/api/reserva").then(response => {
                this.reserva = response.data;
            });
        }
    },
    mounted() {
        this.GetReservas();
    }
};
</script>
<style>
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
    padding: 10px;
    margin-bottom: 10px; /* Añadido margen inferior */
    border-radius: 5px;
    border: 1px solid #e0e0e0;
    box-sizing: border-box;
}

.row input[type="search"]::placeholder {
    font-size: 12px;
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

.reservas-table {
    width: 100%;
    border-collapse: collapse;
}

.reservas-table th,
.reservas-table td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.no-reservas {
    text-align: center;
    padding: 10px;
    font-style: italic;
    color: #999;
}

/* Estilos para la imagen */
.reservas-table img {
    display: block;
    margin: 0 auto;
}
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
