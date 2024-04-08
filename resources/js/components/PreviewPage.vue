<template>
    <div class="Wrapper-Preview">
        <header class="Container-Header">
            <div class="Column-logo">
                <img src="./static/ayuda.png" alt="" />
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
                <div class="card-cart">
                    <h2>Tesla Model Y 2023</h2>
                    <div class="section-info">
                        <div class="container-icon">
                            <span
                                ><img src="./static/user.png" alt="user-icon"
                            /></span>
                            <span
                                ><img src="./static/user.png" alt="user-icon"
                            /></span>
                        </div>
                        <div class="container-price">
                            <span>US$45.00</span><span>/day</span>
                        </div>
                    </div>
                    <img src="./static/cart.png" alt="" class="image-cart" />
                </div>
            </div>
        </main>
        <article class="Container-info">
            <div class="Column-image">
                <img src="./static/autos.png" alt="Imagen" />
            </div>
            <div class="Column-checklist">
                <h1>How it works</h1>
            </div>
        </article>
    </div>
</template>
<style scoped>
.Wrapper-Preview {
    display: grid;
    background-color: white;
    grid-template-columns: auto auto;
    margin: 10px 10px 0px 10px;
    width: 100%;
    grid-template-areas: "header header" "slider slider" "main main" "article article";
}
.Container-item {
    display: flex;
}
.Column-logo {
    height: 0;
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
    padding: 0.9rem;
    justify-content: space-between;
    display: flex;
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
    margin: 0px 10px 0px 0px;
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
    height: auto;
}
.Container-info {
    display: flex;
}
.Column-image {
}
</style>
