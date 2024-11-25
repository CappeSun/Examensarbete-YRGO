<script setup>
    import { onMounted } from 'vue';
    import videojs from 'video.js';

    const channel = laraChannel;

    onMounted(() =>{
        streamPlayer.player = videojs(streamPlayer, {
            autoplay: false,
            controls: true,
            sources: [
                {
                    src: 'http://98.128.174.220:8080/' + channel + '/index.m3u8',
                    type: 'application/vnd.apple.mpegurl'
                }]
        });
    })
</script>

<template>
    <video id="streamPlayer" class="video-js"></video>
</template>

<style type="text/css">
    .video-js{
        height: 100%;
        width: 100%;
    }
</style>