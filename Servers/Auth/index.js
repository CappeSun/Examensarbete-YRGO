import express from 'express';

const app = express();

app.use(express.urlencoded());

app.post('/start', (req, res) =>{
	if (req.body.name == 'cappestreamthebeststream'){		// Hardcoded, replace with db lookup: key (req.body.name) -> username
		res.setHeader('Location', 'cappesun');
		res.redirect(302, 'cappesun').send();		// Hardcoded, replace cappe with db response
		return;
	}
	res.status(403).send();
});

app.post('/stop', (req, res) =>{
	// send to chat server
});

app.listen(9000, () => console.log('yuppers!'));