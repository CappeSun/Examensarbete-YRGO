export function arrayEnc(data){
	let res = '';
	data.forEach((entry) =>{
		res += entry[0] + String.fromCharCode(0x01) + entry[1] + String.fromCharCode(0x00);
	});
	res = res.slice(0, -1);
	return res;
}

export function arrayDec(data){
	let res = [];
	data = data.split(String.fromCharCode(0x00));
	data.forEach((entry) =>{
		res.push(entry.split(String.fromCharCode(0x01)));
	});
	return res;
}

export function numEnc(number){		// 32-bit signed, -2147483648 - 2147483647
	let res = '';
	let numSum = 0;
	for (let i = 0; i < 4; i++){
		let byte = number >> 8*i;
		byte = byte & 0b11111111;
		res += String.fromCharCode(byte);
		numSum += byte;
		if (numSum == number) i = 4;
	}
	return res;
}

export function numDec(number){
	let res = 0;
	for (let i = 0; i < number.length; i++){
		let byte = number.charCodeAt(i);
		res += byte << 8*i;
	}
	return res;
}