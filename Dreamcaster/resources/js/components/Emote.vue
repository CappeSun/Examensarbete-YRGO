<script setup>
    const p = defineProps(['name']);
</script>

<template>
    <img class="emoteImg" v-bind:src="'/emotes/' + p.name + '.png'">
</template>

<style type="text/css">
    .emoteImg{
        height: 1.25vw;
        margin: 0 0 0 0.1vw;
        position: relative;
        top: 0.2vw;
    }
</style>