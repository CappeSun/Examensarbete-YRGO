<script setup>
    const p = defineProps(['bId']);
</script>

<template>
    <img class="badgeImg" v-bind:src="'/badges/' + p.bId + '.png'">
</template>

<style type="text/css">
    .badgeImg{
        height: 1vw;
        position: relative;
        top: 0.1vw;
        margin-right: 0.08vw;
    }
</style>