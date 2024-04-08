<template>
    <div>
        <div class="Modal" :class="{ 'is-active': ShowModal }">
            <div class="Modal-content">
                <button class="close-btn" @click="hideModal">×</button>
                <div class="Header-Modal">
                    <h1>Agregar Vehiculo</h1>
                </div>
                <div class="Modal-body">
                    <form @submit.prevent="submitForm">
                        <div class="slider">
                            <div class="logo-container">
                                <input
                                    type="file"
                                    name="image"
                                    class="Logo-upload"
                                    ref="fileInput"
                                    @change="handleFileChange"
                                    required
                                />
                                <img
                                    v-if="image"
                                    :src="image"
                                    alt="Uploaded Image"
                                    class="uploaded-image"
                                />
                                <span v-else>Select an image</span>
                            </div>
                        </div>
                        <div class="max-images-message">
                            agrega tu foto
                        </div>
                        <div class="Row-Modal">
                            <h1>Detalla los datos del vehículo</h1>
                            <input
                                type="text"
                                name="name"
                                v-model="name"
                                placeholder="nombre del vehiculo"
                                id=""
                            />
                            <textarea
                                name="descripcion"
                                id=""
                                v-model="descripcion"
                                cols="30"
                                rows="10"
                                placeholder="descripcion del Vehiculo"
                            ></textarea>
                        </div>
                        <div class="Row-Modal">
                            <div class="precio">
                                <input
                                    type="text"
                                    name="precio"
                                    v-model="precio"
                                    placeholder="$ precio "
                                    id=""
                                />
                                <label for="">Por dia</label>
                            </div>
                            <p>
                                &#128161; Estamos estimando cuanto ganarias por
                                reserva
                            </p>
                        </div>
                        <div class="Container-Select">
                            <h1>Select Feature</h1>
                            <div class="Select-feature">
                                <select name="equipaje" v-model="equipaje">
                                    <option value="null" disabled
                                        >Selecciona tus equipajes</option
                                    >

                                    <option value="250">10</option>
                                    <option value="5">5</option>
                                </select>

                                <select
                                    name="capacidad"
                                    v-model="capacidad"
                                    id=""
                                >
                                    <option selected value="null"
                                        >Selecciona la capacidad</option
                                    >
                                    <option value="2">2</option>
                                </select>
                                <select name="tipo" v-model="tipo" id="">
                                    <option value="null" selected disabled>
                                        tipo</option
                                    >
                                    <option value="8">8</option>
                                </select>
                                <select v-model="transmision" id="">
                                    <option value="null" selected disabled>
                                        Selecciona la transmicion</option
                                    >
                                    <option value="sedan">Sedan</option>
                                </select>
                            </div>
                        </div>
                        <div class="Container-Select-Add">
                            <h1>Select Additional Features</h1>
                            <div class="Select-Add">
                                <label for="">
                                    <input
                                        type="checkbox"
                                        name="Bluetooth"
                                        id=""
                                        v-model="Bluetooth"
                                    />
                                    Bluetooth
                                </label>
                                <label for="">
                                    <input
                                        type="checkbox"
                                        v-model="SiriusXM"
                                        name="SiriusXM"
                                        id=""
                                    />
                                    SiriusXM
                                </label>
                                <label for="">
                                    <input
                                        type="checkbox"
                                        name="GPS"
                                        v-model="GPS"
                                        id=""
                                    />
                                    GPS
                                </label>
                                <label for="">
                                    <input
                                        type="checkbox"
                                        name="Apple Car"
                                        v-model="AppleCar"
                                        id=""
                                    />
                                    Apple Car
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="Btn-Submit">
                            Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="Vehiculo-add">
            <div class="row-vehiculo">
                <img src="./static/vehiculo.png" alt="Logo vehiculo" />
                <h1>Vehículos</h1>
                <span class="count">{{ cantidadActiva.length }}</span>
            </div>
            <button class="btn" type="button" @click="ShowModal = true">
                Agregar vehiculo
            </button>
        </div>
        <div v-if="cantidadActiva.length > 0">
            <TableVehiculo :vehiculos="cantidadActiva" />
        </div>
        <div class="no-hay" v-else>
            <h3>No hay vehiculos registrados</h3>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import TableVehiculo from "./TableVehiculo.vue";
import "@fortawesome/fontawesome-free/css/all.css";

export default {
    components: {
        TableVehiculo
    },
    data() {
        return {
            cantidadActiva: [],
            name: "",
            descripcion: "",
            precio: "",
            equipaje: null,
            capacidad: null,
            tipo: null,
            transmision: null,
            Bluetooth: false,
            SiriusXM: false,
            GPS: false,
            AppleCar: false,
            ShowModal: false,
            image: null
        };
    },
    mounted() {
        axios.post("http://localhost:8000/vehiculo").then(response => {
            this.cantidadActiva = response.data;
        });
    },
    methods: {
        hideModal() {
            this.ShowModal = false;
        },

        submitForm() {
            const formData = new FormData();

            // Agregar imágenes al FormData
            formData.append("image", this.$refs.fileInput.files[0]);

            formData.append("name", this.name); // Corregir aquí
            formData.append("descripcion", this.descripcion); // Corregir aquí
            formData.append("precio", this.precio);

            // Agregar datos de los select al FormData
            formData.append("equipaje", this.equipaje);
            formData.append("capacidad", this.capacidad);
            formData.append("tipo", this.tipo);
            formData.append("transmision", this.transmision);

            // Agregar datos de los checkboxes al FormData si están marcados
            if (this.Bluetooth) {
                formData.append("Bluetooth", this.Bluetooth);
            }
            if (this.SiriusXM) {
                formData.append("SiriusXM", this.SiriusXM);
            }
            if (this.GPS) {
                formData.append("GPS", this.GPS);
            }
            if (this.AppleCar) {
                formData.append("AppleCar", this.AppleCar);
            }

            // Agregar user_id al FormData recuperándolo de localStorage
            const landingsId = localStorage.getItem("landings_id");
            formData.append("landing_id", landingsId);

            // Enviar FormData al backend utilizando Axios
            axios
                .post("http://localhost:8000/create_vehiculo", formData)
                .then(response => {
                    console.log("datos del vehiculo ", response.data);
                    this.ShowModal = false;
                    const nuevoVehiculo = response.data.vehiculo; // Asegúrate de que response.data contenga el nuevo vehículo devuelto por el backend
                    this.cantidadActiva.push(nuevoVehiculo);
                })
                .catch(error => {
                    console.error("El error es", error);
                });
        },

        handleFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.image = URL.createObjectURL(file);
            } else {
                this.image = null;
            }
        }
    }
};
</script>

<style>
.no-hay {
    margin: 30px;
    font-weight: 700;
    color: #222;
    font-size: 1.9rem;
    text-align: center;
}
.Modal-body {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
}
.slider-container {
    position: relative;
    margin: 0 auto;
}

.nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    font-size: 24px;
    color: #000;
    cursor: pointer;
    z-index: 1;
}

.left {
    left: 10px;
}

.right {
    right: 10px;
}

.slider {
    overflow: hidden;

    position: relative;
    display: flex;
    justify-content: center;
}

.slider img {
    width: 500px;
    height: 300px;
    object-fit: cover;
}
.add-image {
    display: flex;
    justify-content: center;
}
.add-image button {
    background-color: #f16822 !important;
    margin: 10px 0px 10px 0;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.max-images-message {
    text-align: center;
    font-size: 0.9rem;
    color: #222;
    font-weight: 600;
}
.add-image input {
    display: none;
}

.Vehiculo-add {
    display: flex;
    justify-content: space-around;
    margin: 20px 0px 5px 0px;
}

.row-vehiculo {
    display: flex;
    align-items: center;
    gap: 20px;
}

.row-vehiculo h1 {
    font-size: clamp(12px, 1rem, 1.3rem);
    font-weight: 600;
}

.count {
    background-color: #f16822;
    color: white;
    padding: 5px;
    border-radius: 50%;
    font-weight: 600;
    width: 30px;
    height: 30px;
    text-align: center;
    line-height: 20px;
}

/* Estilos del botón */
.btn {
    background-color: #f16822 !important;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #b34d1a;
}
.Btn-Submit {
    background-color: #f16822 !important;
    color: white;
    padding: 10px 20px;
    width: 100%;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;

    margin: 20px auto; /* Centra el botón horizontalmente */
    display: block; /* Asegura que el botón ocupe todo el ancho del contenedor */
}

/* Estilos del modal */
.Modal {
    display: none;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    z-index: 1000;
    background-color: rgba(0, 0, 0, 0.5);
}

.Modal.is-active {
    display: block;
}

.Modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border-radius: 10px;
    width: 80%;
    max-width: 600px;
    position: relative;
}

.Header-Modal {
    display: flex;
    justify-content: center;
    align-items: center;
}

.Header-Modal h1 {
    font-size: 1.5rem;
    font-weight: 600;
    margin: 10px 0px 15px 0px;
}

.close-btn {
    position: absolute;
    top: 5px;
    right: 10px;
    background-color: transparent;
    border: none;
    color: #999;
    font-size: 24px;
    cursor: pointer;
}

.Row-Modal {
    display: flex;
    margin: 10px 0px 5px 0;
    align-items: center;
    flex-direction: column;
    justify-content: center;
}

.Row-Modal h1 {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 5px 0px 10px 0;
}

.Row-Modal input[type="text"] {
    outline: none;
    padding: 10px 12px 10px 12px;
    border-radius: 5px;
    border: 1px solid #e0e0e0;
    font-size: 0.8rem;
}

.Row-Modal textarea {
    width: 45%;
    outline: none;
    padding: 5px;
    height: 100px;
    margin: 20px 0px 10px 0;
    border-radius: 5px;
    border: 1px solid #e0e0e0;
    font-size: 0.8rem;
}

.Row-Modal p {
    font-size: 0.7rem;
    margin: 10px 0 5px 0;
    padding: 3px;
    font-weight: 600;
    border-radius: 5px;
    color: white;
    background-color: #f16822;
}

.close-btn:hover {
    color: #666;
}

.precio label {
    font-size: 0.8rem;
    margin: 0px 0 0 5px;
    font-weight: 600;
}

.Select-feature {
    display: flex;
    margin: 15px 0px 15px 0;
    justify-content: center;
}

.Select-feature select {
    font-size: 13px;
    margin: 0px 5px 0px 5px;
    border: 1px solid #999;
    outline: none;
    font-size: 12px;
    padding: 3px;
}
.Select-feature {
    border: 1px solid #999;
    outline: none;
    font-size: 10px;
    padding: 5px;
}

.Container-Select h1 {
    text-align: center;
    font-size: 1.2rem;
    font-weight: 600;
    color: #222;
    margin: 10px 0px 10px 0;
}

.Select-Add {
    display: flex;
    justify-content: center;
}

.Container-Select-Add h1 {
    text-align: center;
    font-size: 1.2rem;
    font-weight: 600;
    color: #222;
    margin: 10px 0px 10px 0;
}

.Select-Add input[type="checkbox"] {
    border: 1px solid #bdbdbd;
    margin: 0px 5px 0px 0px;
}

.Select-Add label {
    margin: 0px 0px 0px 5px;
    font-size: 12px;
    color: #222;
}

.Select-Add input:checked {
    border: 1px solid #bdbdbd;
    margin: 0px 5px 0px 0px;
    background-color: #f16822;
}
</style>
