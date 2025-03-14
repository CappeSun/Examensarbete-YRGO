# Dreamcaster Project
 Official repo for the Dreamcaster Project, a livestreaming service aimed at gaming (very much in progress).



# This and everything below was added at a later point

This is not the actual official repo, just a teacher's reference for grading, and for anyone else interested, so that I can keep updating the project. The real repo is private for now.

# Required software

Node.js and npm are required for the chat server, the auth server and for installing the required packages. Composer is used to run the dev server. You'll need NGINX with the RTMP module installed for the stream server, however you may omit this if you're not interested, as it is not critical for running the rest of the application. What it does is simply:

1. Accept a connection over RTMP from OBS or similar software.
2. Check with the auth server if the key is 'cappestreamthebeststream'.
3. Serve the stream at :8080/cappesun/index.m3u8.

All I wrote for the stream part was the config and authentication server for NGINX to serve the stream at another location than specified with the key, more or less.

# Installation

This is a Laravel app using Vite as the development server. You can run it with

`npm install`

`composer run dev`

in the 'Dreamcaster/' directory. The chat server expects the port to be 8000.

To run the chat server, simply run

`npm install`

`node index.js`

in the 'Servers/Chat/' directory.

Install NGINX from https://nginx.org/en/docs/install.html and follow the instructions at https://github.com/arut/nginx-rtmp-module/wiki to install the rtmp module. Use the nginx.conf provided in 'Servers/NGINX/'. Then start NGINX and run the auth server with

`npm install`

`node index.js`

in the 'Servers/Auth/' directory.
