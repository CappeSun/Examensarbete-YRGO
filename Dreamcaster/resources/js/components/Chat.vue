<script setup>
	import { ref, reactive } from 'vue';

	let emoteListDisplay = ref(0);

	let ws;
	let messages = reactive([]);
	let message = '';
	let isScrolling = ref(false);
	let emotes = ['kayPog', 'gjob', 'OiMinna','Kappa','LUL','OMEGALUL','KEKW','KEKWait','MikuHands','HUH','SmugAsuka','SenkoHmm','Heh','Fakiu','WTF','SmugUsagi','catHehe','Oky','peepoHmm','catBleh','HYPERS','SusWokege','GGEZ','AYAYA','Sadge','peepoHappy','POGGIES','Prayge','FeelsDankMan','pepeHeHeh','mlady','Luvv','peepoBlanket','peepoSmile','PepePoint','PepeSus','Shruge','5Head','PINGAS','catHeh','ItsOkay','dogeKek','WeirdDog','fineDog', 'PepeHands', 'widepeepoHappy', 'monkaS', 'monkaEyes', 'FeelsStrongMan', 'peepoLove', 'monkaGun', 'monkaH', 'YouDied', 'Madge', 'PauseChamp', 'Okayge', 'SmileW', 'pepoHmm', 'peepoShrug', 'Wokege', 'PeepoWeird', 'FeelsWeirdMan', 'peepoShy', 'Susge', 'KKona', 'Bedge', 'peepoHug', 'SuchMeme', 'AYAYAHyper', 'catOK', 'BOOMER', 'KermitENOUGH', 'peepoRiot', 'BASED', 'FeelsOkayMan', 'PeepoFinger', 'Weirdge', 'peepoExit', 'haHAA'];		// Hardcoded, will be sent over ws

	ws = new WebSocket('ws://127.0.0.1:4433/' + laraId);

	ws.onopen = () =>{
		ws.onmessage = (event) =>{
			console.log('msg:', event.data);
			switch (event.data.charCodeAt(0)){
				case 0x01:
					doModAction(event.data);
					break;
				case 0x02:
					break;
				case 0x03:
					ws.send(String.fromCharCode(0x03));		// Keepalive
					break;
				default:
					messages.push([event.data.split(String.fromCharCode(0x00)), false]);		// Message, deleted

					if (!isScrolling.value){
						if (messages.length > 80)
							messages.splice(0, messages.length - 50);

						setTimeout(() =>{
							chatCont.scrollTo({
								top: chatCont.scrollHeight
							});
						})
					}
			}
		}
	}
	// ws.onerror = () => {
	// 	ws = new WebSocket('ws://127.0.0.1:4433/' + laraId);
	// }

	function sendMsg(){
		if (!message) return;
		ws.send(message);
		message = '';
		msgInput.value = '';
		emoteListDisplay.value = 0;
	}

	function doModAction(msg){
		switch (msg.charCodeAt(1)){
			case 0x00:
				messages[messages.findIndex((e) => e[0][2] == msg.substring(2))][1] = true;
				break;
			case 0x01:
				break;
			case 0x02:
				break;
		}
	}

	function getUserColor(code){
		code ??= String.fromCharCode(0x00);

		switch (code.charCodeAt(0)){
			case 0x01:
				return 'userColorGrey';
			case 0x02:
				return 'userColorBlue';
			case 0x03:
				return 'userColorGreen';
			case 0x04:
				return 'userColorRed';
			case 0x05:
				return 'userColorPurple';
			case 0x06:
				return 'userColorDreamcaster';
			case 0x07:
				return 'userColorGold';
			default:
				return 'userColorGrey';
		}
	}

	function readBadgeIds(badges){
		let ids = [];
		for (let i = 0; i < badges.length; i += 2)
			ids.push(badges[i] + badges[i+1]);
		return ids;
	}

	function handleChatScroll(event){
		if (event.target.scrollTop < (event.target.scrollHeight - event.target.offsetHeight))
			isScrolling.value = true;
		else
			isScrolling.value = false;
	}

	function autoScrollOn(){
		isScrolling.value = false;

		chatCont.scrollTo({
			top: chatCont.scrollHeight
		});
	}

	function msgAddEmote(name){
		message += ' :' + name;
		msgInput.value = message;
	}
</script>

<template>
		<div class="chatCont" v-on:scroll.passive="handleChatScroll" id="chatCont">
			<p v-for="msg in messages" :key="msg[0][0][2]" v-on:click.alt.exact="ws.send(String.fromCharCode(0x01) + String.fromCharCode(0x00) + msg[0][2])">
				<Badge v-for="badge in readBadgeIds(msg[0][4])" v-bind:bId="badge"/>
				<span v-bind:class="getUserColor(msg[0][3])">{{msg[0][0]}}</span>:
				<span v-if="msg[1]"><em>Message deleted by moderator</em></span>
				<template v-else v-for="word in msg[0][1].split(' ')">
					<Emote v-if="word[0] === ':' && emotes.includes(word.substring(1))" v-bind:name="word.substring(1)"></Emote>
					<template v-else>{{' '+word}}</template>
				</template>
			</p>
		</div>
		<div class="msgCont">
			<button class="autoScrollBtn" v-bind:class="{isScrolling: isScrolling}" v-on:click="autoScrollOn()">Autoscroll</button>
			<div class="emoteList" v-show="emoteListDisplay">
				<Emote v-for="emote in emotes" v-bind:name="emote" v-on:click="msgAddEmote(emote)"/>
			</div>
			<input id="msgInput" v-model="message" v-on:keydown.enter="sendMsg()" type="text">
			<button class="emoteBtn" v-on:click="emoteListDisplay ? emoteListDisplay = 0 : emoteListDisplay = 1">:D</button>
		</div>
</template>

<style type="text/css">
	.chatCont{
		height: calc(100% - 2.5vw);
		width: 100%;
		overflow-y: scroll;
		overflow-x: hidden;
		overflow-wrap: break-word;
		scrollbar-width: none;
	}
	.chatCont > p{
		margin: 0 0.3vw;
		font-size: 0.9vw;
		line-height: 1.6vw;
	}
	.chatCont > p > span > em{
		color: rgb(200, 200, 200);
	}
	.msgCont{
		height: 2.45vw;
		width: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
		position: relative;
		border-top: 0.05vw solid rgb(200, 200, 200);
	}
	.msgCont > input{
		height: 1.4vw;
		width: 81%;
		margin: 0 0 0 1.5%;
		padding: 0 0.2vw;
		border: none;
		border-radius: 0.25vw;
		font-size: 0.9vw;
	}
	.emoteBtn{
		height: 1.4vw;
		width: 1.4vw;
		margin: 0 0 0 2.5%;
		padding: 0;
		border: none;
		border-radius: 0.5vw;
		background:
			linear-gradient(217deg, rgba(72,0,255,1), rgba(72,0,255,0) 95%),
			linear-gradient(115deg, rgba(136,51,255,1), rgba(146,51,255,0) 80%),
	    	linear-gradient(330deg, rgba(170,31,255,1), rgba(109,51,255,0) 80%);
		color: white;
		font-size: 0.5vw;
		cursor: pointer;
	}
	.emoteList{
		height: 9vw;
		width: 90%;
		margin: 0.25vw 2.5%;
		padding: 0.25vw 2.5%;
		border: 0.05vw solid rgb(200, 200, 200);
		border-radius: 0.5vw;
		display: flex;
		flex-wrap: wrap;
		overflow-y: scroll;
		position: absolute;
		top: -10.25vw;
		left: 0;
		background-color: rgb(20, 20, 20);
	}
	.emoteList > img{
		margin: 0.15vw;
		cursor: pointer;
	}
	.autoScrollBtn{
		width: 12vw;
		position: absolute;
		bottom: 2vw;
		left: calc(50% - 6vw);
		font-size: 0.9vw;
		opacity: 0;
		cursor: pointer;
		pointer-events: none;
		transition: 0.1s ease-in;
	}
	.isScrolling{
		bottom: 3vw;
		opacity: 0.5;
		pointer-events: all;
		transition: 0.1s ease-out;
	}
	.userColorGrey{
		color: rgb(180, 180, 180);
	}
	.userColorBlue{
		color: rgb(0, 0, 255);
	}
	.userColorGreen{
		color: rgb(0, 255, 0);
	}
	.userColorRed{
		color: rgb(255, 0, 0);
	}
	.userColorYellow{
		color: yellow;
	}
	.userColorPurple{
		color: rgb(170,31,255);
	}
	.userColorDreamcaster{
		background: -webkit-linear-gradient(300deg, rgb(72, 0, 255), rgb(136, 51, 255), rgb(170, 31, 255));
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
	}
	.userColorGold{
		background: -webkit-linear-gradient(290deg, rgb(255, 220, 82), rgb(235, 145, 0));
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
	}
</style>
