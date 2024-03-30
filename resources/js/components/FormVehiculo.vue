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
                        <!-- <input
                            type="file"
                            accept="image/*"
                            multiple
                            @change="handleFileChange"
                        /> -->
                        <div class="slider-container">
                            <button
                                @click="prevImage"
                                :disabled="currentIndex === 0"
                            >
                                &lt;
                            </button>
                            <div class="slider">
                                <img
                                    v-if="images.length > 0"
                                    :src="images[currentIndex]"
                                    alt="Preview"
                                />
                                <div v-else>No hay imágenes seleccionadas</div>
                            </div>
                            <button
                                @click="nextImage"
                                :disabled="currentIndex === images.length - 1"
                            >
                                &gt;
                            </button>
                        </div>
                        <div class="add-more" @click="openFilePicker">
                            Agregar más imágenes
                        </div>
                        <div
                            v-if="images.length < 12"
                            style="text-align:center;color:grey;font-weight:700;font-size:13px;"
                        >
                            Se pueden agregar como máximo 12 fotos.
                        </div>
                        <div class="Row-Modal">
                            <h1>Detalla los datos del vehículo</h1>
                            <input
                                type="text"
                                name="nombre"
                                placeholder="nombre del vehiculo"
                                id=""
                            />
                            <textarea
                                name="descripcion"
                                id=""
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
                                    placeholder="$ precio "
                                    id=""
                                />
                                <label for="">Por dia</label>
                            </div>
                            <p>
                                &#128161;Estamos estimando cuanto ganarias por
                                reserva
                            </p>
                        </div>
                        <div class="Select-Feuture">
                            <select name="" id="">
                                <label for="">Equipaje</label>
                            </select>
                            <select name="" id="">
                                <label for="">capacidad</label>
                            </select>
                            <select name="" id="">
                                <label for="">tipo</label>
                            </select>
                            <select name="" id="">
                                <label for="">transmision</label>
                            </select>
                        </div>
                        <div class="Select-add">
                            <label for="">
                                <input type="checkbox" name="" id="" />
                                Bluetooth
                            </label>
                            <label for="">
                                <input type="checkbox" name="" id="" />
                                SiriusXM
                            </label>
                            <label for="">
                                <input type="checkbox" name="" id="" />
                                GPS
                            </label>
                            <label for="">
                                <input type="checkbox" name="" id="" />
                                Apple Car
                            </label>
                        </div>
                        <button type="submit">Guardar</button>
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
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            cantidadActiva: [],
            ShowModal: false,
            images: [],
            currentIndex: 0
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
        handleFileChange(event) {
            const files = event.target.files;
            this.addImages(files);
        },
        openFilePicker() {
            const input = document.createElement("input");
            input.type = "file";
            input.accept = "image/*";
            input.multiple = true;
            input.onchange = event => {
                this.addImages(event.target.files);
            };
            input.click();
        },
        addImages(files) {
            if (files.length + this.images.length <= 12) {
                for (let i = 0; i < files.length; i++) {
                    const reader = new FileReader();
                    reader.onload = () => {
                        this.images.push(reader.result);
                    };
                    reader.readAsDataURL(files[i]);
                }
            } else {
                alert("Solo se permiten un máximo de 12 imágenes.");
            }
        },
        submitForm() {
            const formData = new FormData();
            for (let i = 0; i < this.images.length; i++) {
                formData.append("images[]", this.images[i]);
            }
            axios
                .post("http://localhost:8000/endpoint", formData)
                .then(response => {
                    // Manejar la respuesta del servidor si es necesario
                })
                .catch(error => {
                    // Manejar el error si ocurre
                });
        },
        nextImage() {
            if (this.currentIndex < this.images.length - 1) {
                this.currentIndex++;
            }
        },
        prevImage() {
            if (this.currentIndex > 0) {
                this.currentIndex--;
            }
        }
    }
};
</script>

<style>
.slider-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
}

.slider {
    position: relative;
    overflow: hidden;
    height: 200px; /* Reducido el tamaño del slider */
}

.slider img {
    max-width: 100%;
    height: 200px;
    transition: transform 0.3s ease;
}

.slider-controls button {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
}

/* Otros estilos */
/* Estilos restantes... */
.add-more {
    width: 300px;
    height: 200px;
    background-color: lightgray;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin: 0 auto;
}

.add-more:hover {
    background-color: gray;
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
    width: 30px;
    height: 30px;
    text-align: center;
    line-height: 20px;
}

/* Estilos del botón */
.btn {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
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
</style>
