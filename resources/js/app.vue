<template>
    <div id="app">
        <router-view v-slot="{ Component }">
            <transition name="fade" mode="out-in">
                <component :is="Component" />
            </transition>
        </router-view>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { RouterView } from "vue-router";

export default defineComponent({
    components: {
        RouterView
    }
});
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>
