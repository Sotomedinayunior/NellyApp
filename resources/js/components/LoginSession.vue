<template>
    <div class="container-form">
        <form class="Form" @submit="SubmitForm">
            <img src="./static/Logo.png" class="" alt="Logo" />
            <input
                type="email"
                placeholder="Email"
                name="email"
                id=""
                v-model="credencials.email"
                required
            />

            <input
                type="password"
                placeholder="Password"
                name="password"
                id=""
                v-model="credencials.password"
                required
            />
            <button type="submit">
                ingresar
            </button>
        </form>
    </div>
</template>
<script>
import "./css/LoginSession.css";

import Axios from "axios";
export default {
    name: "LoginSession",
    data() {
        return {
            credencials: {
                email: "",
                password: ""
            }
        };
    },
    methods: {
        SubmitForm(e) {
            e.preventDefault();

            Axios.post("http://localhost:8000/api/login", this.credencials)
                .then(response => {
                    if (response.data.token) {
                        localStorage.setItem("token", response.data.token);
                        console.log("Token guardado", response.data.token);
                        this.$router.push("/dashboard");
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        }
    }
};
</script>
