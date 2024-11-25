<script setup>
	import { ref, reactive } from 'vue';
	import { g } from '../globals.js';

	let channels = reactive([
		{name: 'cappesun', dispName: 'CappeSun', title: 'First stream on Dreamcaster!', category: 'Just Chatting', tags: ['Just Chatting', 'YRGO', 'Event'], watchers: 23},
		{name: 'benben', dispName: 'BenBen', title: 'Eating several kgs of cheese LIVE', category: 'Just Chatting', tags: ['Just Chatting', 'cheese', 'yummi cheese', 'help'], watchers: 0},
		{name: 'gamer1', dispName: 'GenericGamer1', title: 'Games', category: 'FPS', tags: ['Generic FPS', 'tag', 'taggies', 'taggers'], watchers: 2},
		{name: 'gamer2', dispName: 'GenericGamer2', title: 'Games', category: 'FPS', tags: ['Generic FPS', 'tag', 'taggies', 'taggers'], watchers: 2},
		{name: 'gamer3', dispName: 'GenericGamer3', title: 'Games', category: 'FPS', tags: ['Generic FPS', 'tag', 'taggies', 'taggers'], watchers: 2},
		{name: 'gamer4', dispName: 'GenericGamer4', title: 'Games', category: 'FPS', tags: ['Generic FPS', 'tag', 'taggies', 'taggers'], watchers: 2},
		{name: 'gamer5', dispName: 'GenericGamer5', title: 'Games', category: 'FPS', tags: ['Generic FPS', 'tag', 'taggies', 'taggers'], watchers: 2},
		{name: 'gamer6', dispName: 'GenericGamer6', title: 'Games', category: 'FPS', tags: ['Generic FPS', 'tag', 'taggies', 'taggers'], watchers: 2},
		{name: 'uihirasawa', dispName: 'Ui_Hirasawa', title: 'Beating the shit out of Ritsu day 1276', with: ['ricchandrums'], category: 'Fighting Games', tags: ['Street Fighter 6', 'Chill'], watchers: 1500},
		{name: 'ricchandrums', dispName: 'RicchanDrums', title: 'Guys I\'m tired', with: ['uihirasawa'], category: 'Fighting Games', tags: ['Street Fighter 6'], watchers: 3}
	]);

	const loggedOut = laraId ? false : true;
</script>

<template>
	<div class="streamListCategory" v-for="category in ['Just Chatting', 'FPS', 'Racing Games', 'Fighting Games']">
		<h2>{{category}}</h2>
		<div>
			<template v-if="channels.some(e => e.category == category)">
				<template v-for="channel in channels">
					<div class="channelCont" v-if="channel.category == category">
						<img v-bind:src="'/pfps/' + channel.name + '.png'">
						<div class="channelStreamWithCont" v-if="channel.with">
							<img v-for="streamwith in channel.with" v-bind:src="'/pfps/' + streamwith + '.png'">
						</div>
						<h1>{{channel.dispName}}</h1>
						<h4>{{channel.watchers < 1000 ? channel.watchers : (Math.round(channel.watchers / 100) / 10 + 'k')}}</h4>
						<div class="channelThumbnailCont">
							<img src="/thumbnails/tempnail.png">
						</div>
						<h2>{{channel.title}}</h2>
						<div class="gameTagsInfoCont">
							<img v-bind:src="'/gamecovers/' + channel.tags[0] + '.png'">
							<div>
								<div>
									<span v-for="tag in channel.tags">{{tag}}</span>
								</div>
							</div>
						</div>
						<button v-if="loggedOut" v-on:click="g.loginDisplay = 1"></button>
						<a v-else v-bind:href="'/' + channel.name"></a>
					</div>
				</template>
			</template>
			<p v-else>No streams in this category</p>
		</div>
	</div>
</template>

<style type="text/css">
	.streamListCategory{
		height: fit-content;
	}
	.streamListCategory > h2{
		margin: 1vw 0 -0.3vw 1vw;
		font-size: 1.7vw;
		line-height: 1vw;
	}
	.streamListCategory > div{
		height: 21vw;
		margin: 0 0 1vw 0;
		padding: 2vw 0;
		display: flex;
		overflow-x: scroll;
	}
	.streamListCategory > div > p{
		margin: 7vw auto;
		font-size: 1.5vw;
	}
	.channelCont{
		height: fit-content;
		width: 16vw;
		margin: 0 0.5vw;
		padding: 1vw;
		border-radius: 1.5vw;
		display: block;
		position: relative;
		background-color: rgb(70, 70, 70);
		border: 0.05vw solid rgb(200, 200, 200);
		transition: 0.8s ease-in;
	}
	.channelCont:first-child{
		margin-left: 1vw;
	}
	.channelCont:last-child{
		margin-right: 1vw;
	}
	.channelCont:hover{
		box-shadow: 0.4vw 0.3vw 1vw -0.2vw rgba(72,0,255,1), 0vw -0.4vw 1vw -0.2vw rgba(136,51,255,1), -0.4vw 0.3vw 1vw -0.2vw rgba(170,31,255,1);
		scale: 1.01;
		transition: 0.8s ease-out;
	}
	.channelCont > a{
		height: 100%;
		width: 100%;
		display: block;
		position: absolute;
		top: 0;
		left: 0;
	}
	.channelCont > img{
		height: 2.7vw;
		width: 2.7vw;
		border: 0.2vw solid rgb(30, 30, 30);
		border-radius: 3vw;
		position: absolute;
		top: 0.4vw;
		left: 0.4vw;
		background-color: rgb(0, 0, 0);
		z-index: 1;
	}
	.channelCont > h1{
		margin: 0 0 0.4vw 2.7vw;
		font-size: 1vw;
		line-height: 0.9vw;
	}
	.channelCont > h4{
		margin: 0;
		width: 4vw;
		position: absolute;
		top: 1vw;
		right: 1vw;
		color: rgb(220, 50, 50);
		font-size: 0.8vw;
		line-height: 0.8vw;
		text-align: right;
	}
	.channelStreamWithCont{
		position: absolute;
		top: 2.8vw;
		left: 0.4vw;
		display: flex;
	}
	.channelStreamWithCont > img{
		height: 2.2vw;
		width: 2.2vw;
		border: 0.2vw solid rgb(30, 30, 30);
		border-radius: 3vw;
		position: absolute;
	}
	.channelThumbnailCont{
		height: 9vw;
		width: 16vw;
		margin: auto;
		background-color: rgb(10, 10, 10);
	}
	.channelThumbnailCont > img{
		height: 100%;
		margin: auto;
		display: block;
	}
	.channelCont > h2{
		height: 2.7vw;
		margin: 0.4vw 0;
		padding: 0.2vw;
		font-size: 1.1vw;
		line-height: 1.4vw;
	}
	.gameTagsInfoCont{
		margin: 0;
		display: flex;
	}
	.gameTagsInfoCont > img{
		height: 4.7vw;
		width: 3.525vw;
	}
	.gameTagsInfoCont > div{
		height: 3.9vw;
		margin: 0 0 0 0.5vw;
		padding: 0.4vw 0.4vw 0.4vw 0.4vw;
		flex-grow: 1;
		border-radius: 0.7vw;
		background-color: rgb(40, 40, 40);
		font-size: 0.6vw;
		font-weight: 200;
		line-height: 0.7vw;
	}
	.gameTagsInfoCont > div > div{
		height: 100%;
		width: 100%;
		overflow: hidden;
	}
	.gameTagsInfoCont > div > div > span:first-child{
		background:
			linear-gradient(217deg, rgba(72,0,255,1), rgba(72,0,255,0) 95%),
			linear-gradient(115deg, rgba(136,51,255,1), rgba(146,51,255,0) 80%),
	    	linear-gradient(330deg, rgba(170,31,255,1), rgba(109,51,255,0) 80%);
	    font-weight: 500;
	}
	.gameTagsInfoCont > div > div > span{
		margin: 0 0.3vw 0.3vw 0;
		padding: 0.2vw;
		display: inline-block;
		border-radius: 0.3vw;
		background-color: rgb(110, 110, 110);
	}
	.channelCont > button{
		height: 100%;
		width: 100%;
		border: none;
		position: absolute;
		top: 0;
		left: 0;
		background-color: transparent;
		cursor: pointer;
	}
</style>