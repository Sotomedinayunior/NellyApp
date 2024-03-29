<template>
    <div class="Wrapper-Login">
        <div id="login">
            <LoginSession />
        </div>
        <div id="fondo"></div>
    </div>
</template>

<script>
import LoginSession from "../components/LoginSession.vue";
export default {
    components: {
        LoginSession
    }
};
</script>

<style>
.Wrapper-Login {
    display: flex; /* Cambiado a flex */
    height: 100vh;
}

#login {
    flex: 1; /* El login ocupa todo el espacio disponible */
}

#fondo {
    flex: 1; /* El fondo ocupa todo el espacio disponible */
    background-image: url("../components/static/Background.png");
    background-size: cover;
    background-repeat: no-repeat;
}
</style>
