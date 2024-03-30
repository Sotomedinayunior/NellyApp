<template>
    <div class="Container-Component">
        <div class="modal" :class="{ 'is-active': showModal }">
            <div class="modal-background"></div>
            <div class="modal-content">
                <!-- Contenido del modal -->
                <div class="circle-checkmark">
                    <span class="icon is-large">
                        <i class="fas fa-check"></i>
                    </span>
                </div>
                <div class="success-message">
                    <p>Datos enviados correctamente</p>
                </div>
            </div>
            <button
                class="modal-close is-large"
                aria-label="close"
                @click="showModal = false"
            ></button>
        </div>
        <form
            enctype="multipart/form-data"
            class="Form-Build"
            ref="form"
            @submit.prevent="submitForm"
        >
            <!-- Contenido del formulario -->
            <div class="block">
                <input type="hidden" name="user_id" v-model="userId" />
                <h1>1 - Name Your Web site</h1>
                <input
                    type="text"
                    name="nombre"
                    class="input"
                    id=""
                    placeholder="Name Your Web site"
                    v-model="nombre"
                    required
                />
            </div>
            <div class="block">
                <h1>2 - Upload the logo</h1>
                <p>upload a HD image</p>
                <div class="logo-container">
                    <input
                        type="file"
                        name="logo"
                        class="Logo-upload"
                        ref="fileInput"
                        @change="handleFileChange"
                        required
                    />
                    <img
                        v-if="logo"
                        :src="logo"
                        alt="Uploaded Image"
                        class="uploaded-image"
                    />
                    <span v-else>Select an image</span>
                </div>
            </div>

            <div class="block">
                <h1>3 - Choose Primary & Secondary Color</h1>
                <p>This will be reflected on buttons, styles etc.</p>
                <div class="Select-color">
                    <div class="color-option">
                        <label for="colorprimario">Primary Color:</label>
                        <input
                            type="color"
                            name="primary_color"
                            id="colorprimario"
                            class="color-input"
                            v-model="primary_color"
                            required
                        />
                    </div>
                    <div class="color-option">
                        <label for="colorsecondary">Secondary Color:</label>
                        <input
                            type="color"
                            name="secondary_color"
                            id="colorsecondary"
                            class="color-input"
                            v-model="secondary_color"
                            required
                        />
                    </div>
                </div>
            </div>
        </form>
        <div class="Preview">
            <div class="Actions">
                <div class="title-actions">
                    <h1>
                        Preview
                    </h1>
                    <p>Take a look how it will look & feel.</p>
                </div>
                <button type="button" class="btn" @click="submitForm">
                    Aceptar cambios
                </button>
            </div>
            <section class="squeletor">
                <header class="header-prev ">
                    <img
                        v-if="logo"
                        :src="logo"
                        alt="Uploaded Image"
                        class="img-prev"
                    />
                    <div class="rectangulo" :style="{ color: secondary_color }">
                        {{ nombre }}
                    </div>
                </header>

                <main class="main-prev">
                    <div
                        class="rectangulo"
                        :style="{ backgroundColor: primary_color }"
                    >
                        <span :style="{ color: secondary_color }">{{
                            nombre
                        }}</span>
                    </div>
                    <div
                        class="rectangulo"
                        :style="{ backgroundColor: primary_color }"
                    >
                        <span :style="{ color: secondary_color }">{{
                            nombre
                        }}</span>
                    </div>
                    <div
                        class="rectangulo"
                        :style="{ backgroundColor: primary_color }"
                    >
                        <span :style="{ color: secondary_color }">{{
                            nombre
                        }}</span>
                    </div>
                    <div
                        class="rectangulo"
                        :style="{ backgroundColor: primary_color }"
                    >
                        <span :style="{ color: secondary_color }">{{
                            nombre
                        }}</span>
                    </div>
                </main>
                <footer
                    class="footer-prev"
                    :style="{ backgroundColor: primary_color }"
                >
                    {{ nombre }}
                </footer>
            </section>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            showModal: false,
            logo: null,
            nombre: "",
            primary_color: "",
            secondary_color: "",
            userId: null
        };
    },
    mounted() {
        // Obtener el ID del usuario y asignarlo a la variable userId
        this.userId = localStorage.getItem("user_id");
    },

    methods: {
        handleFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.logo = URL.createObjectURL(file);
            } else {
                this.logo = null;
            }
        },
        submitForm() {
            // Validar si todos los campos obligatorios están llenos
            if (!this.nombre || !this.primary_color || !this.secondary_color) {
                // Mostrar mensaje de error si algún campo está vacío
                alert("Por favor, complete todos los campos obligatorios.");
                return;
            }

            // Crear un objeto FormData para enviar los datos del formulario
            const formData = new FormData();
            formData.append("nombre", this.nombre);
            formData.append("primary_color", this.primary_color);
            formData.append("secondary_color", this.secondary_color);
            formData.append("logo", this.$refs.fileInput.files[0]);
            formData.append("user_id", this.userId);

            // Realizar la solicitud POST utilizando Axios
            axios
                .post("http://localhost:8000/api/create_landings", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data" // Es importante establecer este encabezado para enviar archivos
                    }
                })
                .then(response => {
                    // Manejar la respuesta del servidor
                    console.log(response.data);
                    this.showModal = true;
                })
                .catch(error => {
                    // Manejar cualquier error que ocurra durante la solicitud
                    console.error("Error al enviar los datos:", error);
                });
        }
    }
};
</script>

<style>
.Container-Component {
    display: flex;

    flex-direction: row;
}

.Form-Build,
.Preview {
    width: 100%; /* Ancho completo para ambos contenedores */
    max-width: 600px; /* Ancho máximo para evitar que se estiren demasiado */
}
.Form-Build {
    display: flex;
    flex-direction: column;
}
.block {
    display: flex;
    flex-direction: column;
    margin-bottom: 1.8rem;
}

.block h1 {
    font-size: clamp(0.9rem, 1rem, 2rem);
    color: #111;
    font-weight: 600;
}
.block p {
    font-size: clamp(9px, 12px, 16px);
    margin: 5px 0 5px 0;
}
.logo-container {
    position: relative;
    width: 400px;
    height: 200px;
    border: 3px dashed #f2994a;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

.Logo-upload {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
}

.uploaded-image {
    max-width: 100%;
    max-height: 100%;
}
.Select-color {
    display: flex;
    gap: 30px; /* Espacio entre los campos de color */
}

.color-option {
    display: flex;
    font-size: clamp(10px, 14px, 20px);
    margin: 10px 0 5px 0;
    flex-direction: column;
}

.color-input {
    padding: 5px;
    border-radius: 5px;
    border: none;
    width: 80px;
    height: 50px;
    cursor: pointer;
}

.Actions {
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-bottom: 30px;

    gap: 100px; /* Espacio entre los elementos */
}

.title-actions h1 {
    color: #222;
    font-weight: 600;
    font-size: clamp(1rem, 1.2rem, 2rem);
}

.title-actions p {
    color: #555;
    font-size: clamp(0.8rem, 1rem, 1.2rem);
}

.squeletor {
    border: 1px solid #ccc; /* Borde para la sección de la vista previa */
    border-radius: 5px; /* Borde redondeado */
    padding: 20px; /* Espaciado interno */
    width: 100%; /* Ancho completo */
    text-align: center; /* Centra el contenido */
}

.squeletor img {
    max-width: 100%; /* Imagen dentro de la sección */
    max-height: 200px; /* Altura máxima de la imagen */
    margin-bottom: 10px; /* Espacio inferior */
}

.btn {
    padding: 5px 10px; /* Ajusta el padding para hacer el botón más pequeño */
    border-radius: 5px; /* Borde redondeado */
    background-color: #f16822 !important; /* Color de fondo */
    color: #fff; /* Color del texto */
    font-size: 12px; /* Tamaño del texto */
    border: none; /* Sin borde */
    cursor: pointer;
    width: 200px !important;
    transition: background-color 0.3s ease; /* Transición suave al cambiar el color de fondo */
}

.btn:hover {
    background-color: #ff7f50; /* Cambia el color de fondo al pasar el ratón */
}

.squeletor {
    display: grid;
    grid-template-areas: "header header header" "main main main" "footer footer footer";
}
.img-prev {
    width: 50px;
    height: 40px;
}
.color-rectangulo {
    background-color: var(--color-primario);
}
.rectangulo {
    width: 30%;
    display: flex;
    align-content: center;
    justify-content: center;
    height: 40px;
}
.header-prev {
    grid-area: header;
    display: flex;
    justify-content: space-between;
}

.main-prev {
    grid-area: main;
    display: flex;
    align-items: center;
    flex-direction: row; /* Apila los elementos verticalmente */
}

.footer-prev {
    margin-top: 20px;
    width: 100%;
    padding: 20px;
    grid-area: footer;
}
.input {
    outline: none;
    width: 70%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

.modal {
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

.modal.is-active {
    display: block;
}

.modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 20px;
    border-radius: 5px;
    position: relative;
    max-width: 400px;
    width: 90%;
}

.modal-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: -1;
}

.circle-checkmark {
    text-align: center;
    margin-bottom: 20px;
}

.circle-checkmark .icon {
    color: #28a745;
    font-size: 4em;
}

.success-message {
    text-align: center;
}
@media screen and (max-width: 768px) {
    .Container-Component {
        flex-direction: column;
    }
}
</style>
