<script setup>
	import { ref } from 'vue';
	import { g } from '../globals.js';

	let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

	const loggedOut = laraId ? false : true;
	const name = laraName;
</script>

<template>
	<header>
		<img src="/images/headerLogo.png">
		<div class="loggedOutCont" v-if="loggedOut">
			<button id="loginBtn" v-on:click="g.loginDisplay = 1">Login</button>
		</div>
		<div class="loggedInCont" v-else>
			<p>Welcome {{name}}, happy watching!</p>
			<form action="/logout">
				<button id="logoutBtn" type="submit">Logout</button>
			</form>
		</div>
		<div class="loginCont" v-if="g.loginDisplay">
			<div v-show="g.loginDisplay == 1">
				<button v-on:click="g.loginDisplay = 0">X</button>
				<form method="POST" action="/login">
					<p>Username</p>
					<input type="text" name="name">
					<p>Password</p>
					<input type="password" name="password">
					<input type="hidden" name="_token" :value="csrf">
					<button type="submit">Login</button>
				</form>
				<p>Or<button v-on:click="g.loginDisplay = 2">Create Account</button></p>
			</div>
			<div v-show="g.loginDisplay == 2">
				<button v-on:click="g.loginDisplay = 0">X</button>
				<form method="POST" action="/account/create">
					<p>Username</p>
					<input type="text" name="name">
					<p>Email</p>
					<input type="text" name="email">
					<p>Password</p>
					<input type="password" name="password">
					<!--<p>Repeat password</p>
					<input type="text" name="// might work, try" form="// might also work, try">-->
					<input type="hidden" name="_token" :value="csrf">
					<button type="submit">Create</button>
				</form>
				<p>Or<button v-on:click="g.loginDisplay = 1">Login</button></p>
			</div>
		</div>
	</header>
</template>

<style type="text/css">
	header{
		height: 100%;
		width: 100vw;
		position: relative;
		display: flex;
		z-index: 1;
		border-bottom: 0.05vw solid rgb(200, 200, 200);
		z-index: 2;
	}
	header > img{
		height: 2.3vw;
		margin: 0.8vw 0 0 1vw;
	}
	button{
		color: rgb(20, 20, 20);
		background-color: rgb(230, 230, 230);
		border: none;
		border-radius: 0.5vw;
		cursor: pointer;
	}
	.loggedOutCont, .loggedInCont{
		height: 100%;
		width: 100%;
		position: relative;
	}
	.loggedOutCont > button, .loggedInCont > form > button{
		padding: 0.15vw 0.7vw;
		position: absolute;
		top: 0.9vw;
		right: 0.9vw;
		font-size: 1vw;
	}
	.loggedInCont > p{
		margin: 1vw 0 0 3vw;
		font-size: 1vw;
		line-height: 2vw;
	}
	.loginCont{
		height: 100vh;
		width: 100vw;
		position: absolute;
		top: 0;
		left: 0;
		background-color: rgba(0, 0, 0, .23);
	}
	.loginCont p{
		margin: 1vw 0;
		font-size: 1vw;
		line-height: 1vw;
	}
	.loginCont input{
		width: 90%;
		margin: 0 0 2vw 0;
		padding: 0 5%;
		display: block;
		border: none;
		font-size: 1vw;
	}
	.loginCont > div{
		width: 20vw;
		margin: 25vh auto 0 auto;
		padding: 1.5vw;
		border-radius: 1.5vw;
		position: relative;
		background-color: rgb(50, 50, 50);
		border: 0.05vw solid rgb(200, 200, 200);
	}
	.loginCont > div button{
		display: block;
		font-size: 1vw;
		cursor: pointer;
	}
	.loginCont > div > button:first-of-type{
		height: 2vw;
		width: 2vw;
		padding: 0;
		position: absolute;
		top: 0.7vw;
		right: 0.6vw;
		background-color: transparent;
		border: none;
		color: white;
		font-size: 1.2vw;
		line-height: 0;
	}
	.loginCont > div > p{
		height: 1.7vw;
		margin: 1vw 0 0 0;
	}
	.loginCont > div > p > button{
		display: inline;
		border: none;
		background: -webkit-linear-gradient(300deg, rgb(72, 0, 255), rgb(136, 51, 255), rgb(170, 31, 255));
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		cursor: pointer;
	}
</style>