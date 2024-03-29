<template>
    <div class="Wrapper">
        <div class="row"><h1>Manual de Usuario</h1></div>
        <div>
            <img src="./static/pdf.png" alt="" />
        </div>
    </div>
</template>
<script></script>
<style>
.Wrapper {
    padding: 20px;
    height: 100vh;
}

.row {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

.row h1 {
    font-weight: 700;
    font-size: clamp(10px, 32px, 20px);
    margin-bottom: 10px; /* Añadido para separar el título del contenido */
}
</style>
