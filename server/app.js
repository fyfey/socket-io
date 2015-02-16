var http = require('http');
var app = require('express')();
var server = http.createServer(app);
var io = require('socket.io')(server);
var uuid = require('node-uuid');

app.listen(3000);

var connections = {};

app.get('/connections', function(req, res) {
    res.json(connections);
});

io.set('authorization', function(handshake, callback) {
    if (handshake.headers.cookie) {
        console.log(handshake.headers.cookie);
    } else {
        return callback('No session.', false);
    }
});

io.on('connection', function(socket) {
    console.log('a user connected');
    console.log(socket);
});

/*
var connections = {};
server.listen(3000, function() {
    console.log('Listening on *:3000');

    server.on('request', function(request, response) {

        var path = require('url').parse(request.url).pathname;

        console.log('path', path);
        switch (path) {
            case '/auth':
                response.writeHead(200, {"Content-Type": "application/json"});
                doAuth(request, response, server);
                break;
            case '/active':
                response.writeHead(200, {"Content-Type": "application/json"});
                res.write(JSON.stringify({active: connections}));
                console.log(connections);
                response.end();
                break;
        }
    }.bind(this));

    function doAuth(req, res, server) {
        var data = '';
        req.on('data', function(chunk) {
            data += chunk;
        });
        req.on('end', function() {
            var token = JSON.parse(data);
            connections[token.token] = uuid.v1();

            res.write(JSON.stringify({token: connections[token.token]}));
            res.end();
        });
    }
});
*/
