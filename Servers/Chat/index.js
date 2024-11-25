/*

Codes

Server: 0x00=, 0x01=, 0x02=, 0x03=keepalive
Client: 0x00=, 0x01=, 0x02=, 0x03=keepalive

Actions:
0x01:
0x00+msgId=delete msg
0x01+userId=timeout user
0x02+userId=ban user

0x01:

Message: 0x00=delimiter
Color: COMING SOON (userId 7 is gold for now)
Badges: Three id's, see list which is COMING SOON (stored as two characters using A-Z/a-z/0-9/+/-)

*/

import {WebSocketServer} from 'ws';

const wss = new WebSocketServer({port: 4433});
let connections = [];
let messages = {};	// REMEMBER TO STORE
let messageId = 0;

wss.on('connection', async (ws, req) =>{
	let userId = +req.url.substring(1);

	let userData = await fetch(`http://127.0.0.1:8000/account/get`,
	{
		method: "POST",
		headers: {
			accept: 'application/json',
			"Content-Type": 'application/json'
		},
		body: JSON.stringify({
			id: userId
			// ADD KEY
		})
	});
	userData = await userData.json();

	if (!userData.name){
		ws.terminate();
		return;
	}

	let userName = userData.name;
	let userMod = false;
	let userColor = charCode(Math.floor(Math.random() * 5) + 1);		// Hardcoded, fetch from DB
	let userBadges = userId === 1 ? '23' : '';		// Hardcoded, fetch from DB
	let active = true;

	if (userId === 1) userColor = charCode(0x06);		// Temp
	if (userId === 7) userColor = charCode(0x07);		//
														//
	if (userId === 1) userMod = true;					//

	(() =>{
		let index = connections.findIndex((conn) => conn.userId === userId);
		if (index === -1) return;
		connections[index].ws.terminate();
		connections.splice(index, 1);
	})();

	connections.push({ws: ws, userId: userId, userMod: userMod});
	console.log(`${userName} connected, currently ${connections.length} connections`);

	ws.on('message', (msg) =>{
		if (!msg[0]) return;
		active = true;
		if (msg[0] == 0x03) return;		// Keepalive

		switch (msg[0]){
			case 0x01:
				doModAction(msg, userMod);
				break;
			case 0x02:
				break;
			case 0x2F:
				doCommand(msg, userMod);
				break;
			default:
				if (msg.includes(charCode(0x00))) return;		// Invalid msg

				sendMsg(userName + charCode(0x00) + msg + charCode(0x00) + messageId++ + charCode(0x00) + userColor + charCode(0x00) + userBadges);		// 1: name, 2: msg, 3: id, 4: options (color), 5: badges
		}
	});

	let interval = setInterval(() =>{		// Keepalive
		if (active){
			active = false;
			ws.send(String.fromCharCode(0x03));
		}else{
			connections.splice(connections.findIndex((conn) => conn.userId === userId), 1);
			ws.terminate();
			console.log(`${userName} does not respond, terminating`);
		}
	},6000000);

	ws.on('close', () =>{
		clearInterval(interval);
		connections.splice(connections.findIndex((conn) => conn.userId === userId), 1);
		console.log(`${userName} disconnected, currently ${connections.length} connections`);
	});
});

function sendMsg(msg){
	connections.forEach((conn) =>{
		conn.ws.send(msg);
	});
}

function serverSend(msg){
	sendMsg('SERVER' + charCode(0x00) + msg + charCode(0x00) + messageId++ + charCode(0x00) + charCode(0x06) + charCode(0x00) + '');
}

function charCode(code){
	return String.fromCharCode(code);
}

function doModAction(msg, userMod){
	if (!userMod) return;

	switch (msg[1]){
		case 0x00:		// Delete
			sendMsg(msg + '');		// JS gets confused without the empty string
			break;
		case 0x01:		// Timeout		// Add later, give each user a chat id, check ban status on connect, set on('message') to null and change back when ban ended, send remaining ban duration
			break;
		case 0x02:		// Ban
			break;
	}
}

function doCommand(msg, userMod){
	if (!userMod) return;

	let cmd = (msg + '').substring(1).split(' ');

	switch (cmd[0]){
		case 'watchers':
			serverSend('Number of watchers: ' + connections.length);
			break;
		case 'poll':
			cmd.shift();
			doPoll(cmd);
			break;
	}
}

function doPoll(args){
	// Implement later
}

console.log('Server ready!');
