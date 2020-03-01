var socket = io.connect( 'http://localhost:8080' );

$( "#messageForm" ).submit( function() {
	var nameVal = $( "#nameInput" ).val();
	var msg = $( "#messageInput" ).val();

	$.ajax({
		url: "./ajax/insertNewMessage.php",
		type: "POST",
		data: { name: nameVal, message: msg },
		success: function(data) {
			var obj = JSON.parse(data);
			var id = obj.id
			
			socket.emit( 'message', { name: nameVal, message: msg , id: id} );
		}
	});
	
	return false;
});

function deleteRow(id){
	var rowId = id;
	
	socket.emit( 'deletemessage', { rowId: rowId } );
	
	$.ajax({
		url: "./ajax/deleteMessage.php",
		type: "POST",
		data: { rowId: rowId},
		success: function(data) {
		}
	});
	
	return false;

}

$( "#ageForm" ).submit( function() {
	var numberVal = $( "#inc_number" ).val();
	
	socket.emit( 'inputages', { inc_number: numberVal } );
	
	$.ajax({
		url: "./ajax/insertNumber.php",
		type: "POST",
		data: { inc_number: numberVal },
		success: function(data) {
			
		}
	});
	
	return false;
});

socket.on( 'message', function( data ) {
	var actualContent = $( "#messages" ).html();
	var newMsgContent = '<li>' + data.name + ': ' + data.message + ' <button onclick="deleteRow('+data.id+')"> Delete </button></li>';
	var content = newMsgContent + actualContent;

	$( "#messages" ).html( content );
});

socket.on( 'inputages', function( data ) {
	$( "#ages" ).empty();
	var actualContent = $( "#ages" ).html();
	var newMsgContent = '<li>' + data.inc_number+ '</li>';
	var content = newMsgContent + actualContent;
	
	$( "#ages" ).html( content );
});

socket.on( 'deletemessage', function( data ) {
	$( "#messages" ).empty();

	$.ajax({
		url: "./ajax/selectMessage.php",
		type: "GET",
		dataType: 'json',
		success: function(data) {
			var newMsgContent;
			var content;
			$.each(data, function(i, item) {
				$( "#messages" ).append('<li>' + item.name + ': ' + item.message + ' <button onclick="deleteRow('+item.id+')"> Delete </button></li>');
			});
		}	
	});
});