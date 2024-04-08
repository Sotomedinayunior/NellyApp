<template>
    <div class="Container-Revieew">
        <div class="line-action">
            <div class="Title-Review">
                <h1>Review</h1>
                <p>
                    Here you can take a look of your new website:
                    nelly.melia.com.do
                </p>
            </div>
            <div class="Container-Button-Actions">
                <button class="btn" :style="{ fontSize: '0.9rem' }">
                    Publicar
                </button>
            </div>
        </div>
        <div class="Iframe-Preview"><PreviewPage /></div>
    </div>
</template>
<script>
import PreviewPage from "./PreviewPage.vue";
export default {
    components: {
        PreviewPage
    },
    data() {}
};
</script>
<style scoped>
.line-action {
    display: flex;
    justify-content: space-around;
    margin: 20px 0px 5px 0px;
}

.Title-Review h1 {
    font-size: clamp(14px, 1.5rem, 2rem);
    font-weight: 700;
    color: #333;
}

.Title-Review p {
    font-size: clamp(9px, 0.9rem, 1rem);
}
.Iframe-Preview {
    display: flex;

    background-color: #f2f2f2;
    width: 950px;
    margin: 15px auto; /* Establece márgenes automáticos en los lados izquierdo y derecho para centrar horizontalmente */
}
</style>
