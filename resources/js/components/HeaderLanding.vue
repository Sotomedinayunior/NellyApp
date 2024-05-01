<template>
    <div>
        <header class="Header-Landing">
            <div
                class="Column-first"
                v-for="item in landingsData"
                :key="item.id"
            >
                <img
                    :src="item.logo"
                    :alt="item.nombre"
                    width="90"
                    height="90"
                />
            </div>

            <nav class="Column-second">
                <ul class="Container-item">
                    <li>
                        <a href="#">Overview</a>
                        <a href="#">Elevate your stay</a>
                        <a href="#">Accommodation</a>
                        <a href="#">Cuisine</a>
                        <a href="#">Activities</a>
                        <a href="#">Blog</a>
                        <a href="#">Events</a>
                    </li>
                </ul>
            </nav>
        </header>
    </div>
</template>

<script>
export default {
    props: {
        landingsData: Object
    }
};
</script>
<style>
.Header-Landing {
    display: flex;
    justify-content: space-around;
    padding: 0.9rem;
    align-items: center;
}
</style>
