<template>
    <div>
        <HeaderLanding :landingsData="landingsData" />
        <SliderLandingsVue />
    </div>
</template>

<script>
import Axios from "axios";

import HeaderLanding from "../components/HeaderLanding.vue";
import SliderLandingsVue from "../components/SliderLandings.vue";
export default {
    components: {
        HeaderLanding,
        SliderLandingsVue
    },
    data() {
        return {
            landingsData: null
        };
    },
    mounted() {
        const NameLandings = this.$route.params.landings;
        console.log(NameLandings);

        Axios.get(`http://localhost:8000/landing/${NameLandings}`).then(
            response => {
                this.landingsData = response.data;
                console.log(response.data);
            }
        );
    }
};
</script>
<style>
.slider {
    grid-area: slider;
    position: relative; /* Posición relativa para que los elementos secundarios se posicionen con respecto a este */
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 200px;
    background-image: url("./static/Car.png");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    flex-direction: column;
}

/* Capa degradado superpuesta */
.slider::before {
    content: ""; /* Obligatorio para usar ::before o ::after */
    position: absolute; /* Posición absoluta para que la capa esté sobre el contenido */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        0deg,
        rgba(0, 0, 0, 0.7) 0%,
        rgba(0, 0, 0, 0.7) 100%
    );
    z-index: 1; /* Asegura que la capa esté sobre el contenido */
}
</style>
