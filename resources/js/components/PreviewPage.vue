<template>
    <div class="Wrapper-Preview">
        <header class="Container-Header">
            <div class="Column-logo">
                <img :src="landings.logo" :alt="landings.nombre" />
            </div>
            <div class="Column-menu">
                <nav>
                    <ul class="Container-item">
                        <li>
                            <a href="#">Overview</a>
                        </li>
                        <li>
                            <a href="#">Elevate you stay</a>
                        </li>
                        <li>
                            <a href="#">Accommodation</a>
                        </li>
                        <li>
                            <a href="#">Cuisine</a>
                        </li>
                        <li>
                            <a href="#">Activities</a>
                        </li>
                        <li>
                            <a href="#">Agenda</a>
                        </li>
                        <li>
                            <a href="#">Events</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <section class="Slider">
            <h1>Renta tu Vehiculo</h1>
            <p>Busca tu vehiculo ideal</p>
            <div class="Form-Viaje">
                <img src="./static/form.png" alt="" />
            </div>
        </section>
        <main class="Container-section-Card">
            <h1>Nuestros vehiculos</h1>
            <div class="Carrusel-Card">
                <div class="card-cart" v-for="item of vehiculo" :key="item.id">
                    <h2>{{ item.name }}</h2>
                    <div class="section-info">
                        <div class="container-icon">
                            <span
                                ><img
                                    src="./static/user.png"
                                    alt="user-icon"
                                />{{ item.capacidad }}</span
                            >
                            <span
                                ><img
                                    src="./static/bag.png"
                                    alt="user-icon"
                                />{{ item.equipaje }}</span
                            >
                        </div>
                        <div class="container-price">
                            <span>{{ item.precio }}</span
                            ><span>/day</span>
                        </div>
                    </div>
                    <img
                        :src="item.image"
                        :alt="item.name"
                        class="image-cart"
                    />
                </div>
            </div>
        </main>
        <article class="Container-info">
            <div class="Column-image">
                <img src="./static/autos.png" alt="Imagen" class="Imagen" />
            </div>
            <div class="Column-checklist">
                <h1>How it works</h1>
                <ul>
                    <li>
                        <strong>Select Your Car</strong>
                        <p>
                            Browse our fleet and choose the one that fits your
                            needs.
                        </p>
                    </li>
                    <li>
                        <strong>Book Your Ride</strong>
                        <p>
                            Fill out the booking form with your details and trip
                            dates.
                        </p>
                    </li>
                    <li>
                        <strong>Enjoy Your Trip</strong>
                        <p>
                            Drive safely and enjoy your trip! Return the car at
                            your convenience.
                        </p>
                    </li>
                </ul>
            </div>
        </article>
        <footer class="footer-pages">
            <ul class="container-item">
                <li><a href="#">Legal Notice</a></li>
                <li><a href="#">Privacy policy </a></li>
                <li><a href="#">cookies policy</a></li>
                <li><a href="#">cookie Notice</a></li>
            </ul>
            <p class="Right-author">
                &copy;{{ new Date().getFullYear() }} All rights reserved
            </p>
        </footer>
    </div>
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            landings: {},
            vehiculo: {}
        };
    },
    mounted() {
        let id = localStorage.getItem("landings_id");

        axios
            .get(`http://localhost:8000/landings/${id}`)
            .then(response => {
                this.landings = response.data;
                console.log(response.data);
            })
            .catch(err => {
                console.error(`Tenemos un error ${err}`);
            });

        axios
            .get(`http://localhost:8000/vehiculos/${id}`)
            .then(response => {
                this.vehiculo = response.data;
                console.log(response.data);
            })
            .catch(err => {
                console.error(`El error es ${err}`);
            });
    }
};
</script>
<style scoped>
.Wrapper-Preview {
    display: grid;
    background-color: white;
    grid-template-columns: auto auto;
    margin: 10px 10px 0px 10px;
    width: 100%;
    grid-template-areas: "header header" "slider slider" "main main" "article article" "footer footer";
}
.Container-item {
    display: flex;
}
.Column-logo {
    height: 0;
}
.Column-logo img {
    width: 50px;
    height: 50px;
    border-radius: 10px;
}
.Container-item li {
    font-size: 12px;
    font-weight: 500;
    color: #444;
    margin: 0px 15px 0px 0px;
}
.Container-Header li:hover {
    border-bottom: 2px solid #666;
}
.Container-Header {
    grid-area: header;
    padding: 0.92rem;
    justify-content: space-between;
    display: flex;
    margin: 10px 0px 20px 0px;
    height: auto; /* Establece la altura automáticamente según el contenido */
}
.Slider {
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
.Slider::before {
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
.Slider h1 {
    z-index: 2;
    font-size: 3.4rem;
    font-weight: 700;
    margin: 10px 0 0 0;
    color: #fff;
}

.Slider p {
    z-index: 2;
    color: #fff;
    font-size: 1.7rem;
    margin: 0px 0px 20px 0;
}

.Form-Viaje {
    z-index: 2;
    width: 80%;
    margin: 0px 0px 25px 0;
}
.Container-section-Card {
    grid-area: main;
    padding: 25px 10px 25px 10px;
    display: flex;
    flex-direction: column;
    justify-content: start;
}
.Carrusel-Card {
    display: flex;
    scroll-behavior: mandatory x;
}
.Container-section-Card h1 {
    font-size: 1.7rem;
    color: #222;
    font-weight: 800;
}
.card-cart {
    display: flex;
    flex-direction: column;
}
.card-cart h2 {
    font-size: 1rem;
    color: #333;
    font-weight: 700;
    margin: 10px 0px 10px 0;
}

.section-info {
    display: flex;
    justify-content: space-between;
}
.container-icon {
    display: flex;
    justify-content: space-between;
    margin: 0px 10px 5px 0px;
}
.container-icon span {
    background-color: #f2f2f2;
    border-radius: 20px;
    display: flex;
    margin: 0px 10px 0px 4px;
    padding: 5px;
}
.container-price {
    display: flex;
}
.container-price :nth-child(1) {
    font-weight: 700;
    font-size: 15px;
}
.container-price :nth-child(2) {
    font-size: 11px;
}

.image-cart {
    width: 250px;
    border-radius: 15px;
    object-fit: cover;
    aspect-ratio: 16/9;
}
.Container-info {
    width: 100%;
    display: grid;
    grid-auto-flow: column;
    grid-template-columns: 50% 50%;
    justify-content: space-between;
}
.Column-image {
    margin: auto 0;
}
.Imagen {
    max-width: 100%;
    height: 300px;
    aspect-ratio: 40/21;
    object-fit: cover;
    border-radius: 10px;
}
.Column-checklist {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;

    padding: 10px 10px 20px 25px;
}
.Column-checklist h1 {
    font-size: 2.375rem;
    font-weight: 700;
    margin: 10px 10px 15px 20px;
}

.Column-checklist ul {
    display: flex;
    flex-direction: row;
}

.footer-pages {
    background-color: #dddddd33;
    display: flex;
    justify-content: center;
    flex-direction: column;
}
.footer-pages {
    grid-area: footer;
    margin: 10px 0px -1px 0;
    padding: 15px;
}
.container-item {
    display: flex;
    justify-content: center;
    flex-direction: row;

    color: #222;
}
.container-item li a {
    font-size: 13px;
    margin: 0px 10px 0px 10px;
}
.Right-author {
    margin: 10px 0px 10px 0px;
    text-align: center;
    color: #222;
    font-size: 12px;
}
</style>
