<template>
    <div class="container-form">
        <form class="Form" @submit.prevent="SubmitForm">
            <img src="./static/Logo.png" class="" alt="Logo" />
            <div class="input-container">
                <input
                    type="email"
                    placeholder="Email"
                    name="email"
                    v-model="credencials.email"
                    required
                    @focus="clearErrorMessage"
                />
            </div>

            <div class="input-container">
                <input
                    placeholder="Password"
                    name="password"
                    v-model="credencials.password"
                    required
                    @focus="clearErrorMessage"
                    :type="showPassword ? 'text' : 'password'"
                />
                <span class="toggle-password" @click="togglePasswordVisibility">
                    <i
                        class="far"
                        :class="{
                            'fa-eye': !showPassword,
                            'fa-eye-slash': showPassword
                        }"
                    ></i>
                </span>
            </div>

            <button type="submit" :class="{ loading: isLoading }">
                <span v-if="isLoading">Cargando...</span>
                <span v-else>ingresar</span>
            </button>
            <span v-if="errorMessage" class="error-message">{{
                errorMessage
            }}</span>
        </form>
    </div>
</template>
<script>
import Axios from "axios";
export default {
    name: "LoginSession",
    data() {
        return {
            credencials: {
                email: "",
                password: ""
            },
            isLoading: false,
            errorMessage: "",
            showPassword: false
        };
    },
    methods: {
        SubmitForm() {
            if (
                !this.credencials.email.trim() ||
                !this.credencials.password.trim()
            ) {
                this.errorMessage =
                    "Por favor, ingrese tanto el email como la contraseña.";
                return;
            }

            this.isLoading = true; // Activar animación de carga
            Axios.post("http://localhost:8000/login", this.credencials)
                .then(response => {
                    if (response.data.token) {
                        localStorage.setItem("token", response.data.token);
                        localStorage.setItem("user_id", response.data.user_id);
                        // console.log("Token guardado", response.data.token);
                        this.$router.push("/dashboard");
                    }
                })
                .catch(err => {
                    console.error(err);
                    this.errorMessage =
                        "Ocurrió un error al iniciar sesión. Por favor, revise sus credenciales.";
                })
                .finally(() => {
                    this.isLoading = false; // Desactivar animación de carga
                });
        },
        clearErrorMessage() {
            this.errorMessage = ""; // Limpiar el mensaje de error cuando se hace foco en el input
        },
        togglePasswordVisibility() {
            // Método para alternar visibilidad de la contraseña
            this.showPassword = !this.showPassword;
        }
    }
};
</script>
<style scoped>
.toggle-password {
    position: absolute;
    top: 50%;
    right: 50px;
    transform: translateY(-50%);
}

.loading {
    position: relative;
}

.loading::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 20px;
    height: 20px;
    border: 2px solid #fff;
    border-top: 2px solid #f16822;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% {
        transform: translate(-50%, -50%) rotate(0deg);
    }
    100% {
        transform: translate(-50%, -50%) rotate(360deg);
    }
}

.error-message {
    color: red;
}

.container-form {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.Form {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    max-width: 400px; /* Ancho máximo del formulario */
    padding: 20px;
    box-sizing: border-box; /* Incluir el padding en el ancho total */
}

.input-container {
    position: relative;
    width: 100%;
    margin-bottom: 10px;
}

.input-container input[type="email"],
.input-container input[type="password"],
.input-container input[type="text"] {
    width: calc(100% - 40px); /* Restar el ancho del icono del ojo */
    padding-right: 40px;
    outline: none;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button[type="submit"] {
    width: calc(100% - 40px);
    padding: 10px;
    margin-right: 40px;

    border-radius: 5px;
    background-color: #f16822;
    color: #fff;
    border: none;
    cursor: pointer;
}

/* Estilos específicos para dispositivos pequeños */
@media screen and (max-width: 768px) {
    .Form {
        padding: 10px; /* Reducir el padding en dispositivos pequeños */
    }

    button[type="submit"] {
        margin-top: 15px; /* Reducir el margen superior del botón en dispositivos pequeños */
    }
}
</style>
