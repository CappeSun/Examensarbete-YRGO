import './bootstrap';

import { createApp } from 'vue';
import Headerr from './components/Headerr.vue';
import Stream from './components/Stream.vue';
import StreamList from './components/StreamList.vue';
import Chat from './components/Chat.vue';
import Emote from './components/Emote.vue';
import Badge from './components/Badge.vue';

createApp({})
	.component('Headerr', Headerr)
	.component('Stream', Stream)
	.component('StreamList', StreamList)
	.component('Chat', Chat)
	.component('Emote', Emote)
	.component('Badge', Badge)
	.mount('#app');