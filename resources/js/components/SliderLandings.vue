<template>
    <div class="slider-landing">
        <h1>Renta tu Vehiculo</h1>
        <p>Busca tu vehiculo ideal</p>
        <section>
            <img src="./static/form.png" alt="imagen temporal" />
        </section>
    </div>
</template>
<script>
export default {
    props: {
        color: Object
    }
};
</script>
<style>
.slider-landing {
    grid-area: slider;
    position: relative; /* Posición relativa para que los elementos secundarios se posicionen con respecto a este */
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 500px;
    background-image: url("./static/Car.png");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    flex-direction: column;
}

/* Capa degradado superpuesta */
.slider-landing::before {
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
.slider-landing h1,
p,
section {
    z-index: 2;
}
.slider-landing h1 {
    font-size: 3.4rem;
    font-weight: 700;
    margin: 10px 0 0 0;
    color: #fff;
}

.slider-landing p {
    color: #fff;
    font-size: 1.7rem;
    margin: 0px 0px 20px 0;
}
.slider-landing section > img {
    width: 100%;
    margin: 0px 0px 25px 0;
}
</style>
