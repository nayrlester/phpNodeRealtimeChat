var socket = require( 'socket.io' );
var express = require( 'express' );
var http = require( 'http' );

var app = express();
var server = http.createServer( app );

var io = socket.listen( server );

io.sockets.on( 'connection', function( client ) {
	console.log( "New client !" );
	
	client.on( 'message', function( data ) {
		console.log( 'Message received ' + data.inc_number + ":" + data.message + ":" + data.id );
		io.sockets.emit( 'message', { name: data.name, message: data.message, id: data.id } );
	});

	client.on( 'inputages', function( data ) {
		console.log( 'Age received ' + data.inc_number );
		io.sockets.emit( 'inputages', { inc_number: data.inc_number } );
	});

	client.on( 'deletemessage', function( data ) {
		console.log( 'message deleted ' + data.rowId );
		io.sockets.emit( 'deletemessage', { rowId: data.rowId } );
	});
});

server.listen( 8080 );