<template>
    <div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th class="header-bg">Nombre</th>
                        <th class="header-bg">Precio por día</th>
                        <th class="header-bg">Tipo de carro</th>
                        <th class="header-bg">Equipaje</th>
                        <th class="header-bg">Personas</th>
                        <th class="header-bg">Transmisión</th>
                        <th class="header-bg">Acomodaciones</th>
                        <th class="header-bg">Comisión</th>
                        <th class="header-bg">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="vehiculo in vehiculos" :key="vehiculo.id">
                        <td>{{ vehiculo.name }}</td>
                        <td>{{ vehiculo.precio }}</td>
                        <td>{{ vehiculo.tipo }}</td>
                        <td>{{ vehiculo.equipaje }}</td>
                        <td>{{ vehiculo.personas }}</td>
                        <td>{{ vehiculo.transmision }}</td>
                        <td>{{ vehiculo.acomodaciones }}</td>
                        <td>{{ vehiculo.comision }}</td>
                        <td>
                            <div class="controller">
                                <button @click="DeleteVehiculo(vehiculo.id)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <button @click="editarVehiculo(vehiculo.id)">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import Axios from "axios";
export default {
    props: {
        vehiculos: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {};
    },
    methods: {
        DeleteVehiculo(id) {
            Axios.delete(`http://localhost:8000/vehiculo/${id}`).then(
                response => {
                    console.log(response.data);
                }
            );
        }
    }
};
</script>

<style>
.table-container {
    width: 900px;
    margin: 0 auto; /* Centro horizontalmente */
}

table {
    border-collapse: collapse;
    width: 100%;
    text-align: center;
}

th,
td {
    text-align: center; /* Centro el contenido horizontalmente */
    padding: 10px;
}

th.header-bg {
    background-color: #f267220d;
    border-top: 1px solid #f16822;
    border-bottom: 1px solid #f16822;
    color: #222;
    text-align: center;
    font-weight: 300;
}

thead {
    border-radius: 20px;
    border: 1px solid #f16822;
}

tbody {
    border: 1px solid #bdbdbd;
}
.controller {
    display: flex;
    justify-content: space-around;
    opacity: 0;
    transition: opacity 0.3s ease; /* transición de opacidad de 0.3 segundos con función de temporización ease */
}
.controller:hover {
    opacity: 1;
}
</style>
