<?php 
	include_once( dirname( __FILE__ ) . '/class/Database.class.php' );
	$pdo = Database::getInstance()->getPdoObject();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		
		<title>PHPNodePDO</title>
	
		<link rel="stylesheet" href="css/bootstrap.css" />
		<style type="text/css">body { padding-top: 60px; }</style>
		<link rel="stylesheet" href="css/bootstrap-responsive.css" />
		<link rel="stylesheet" href="css/index.css" />
	</head>

	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="brand" href="index.php">NodeJS_PHP</a>
					
				</div>
			</div>
		</div>
		
		<div class="container">
			<h1>Node and PHP</h1>
			<p>
				Realtime chat with delete message and upating record in DB without refresh
			</p>
			
			<form class="form-inline" id="ageForm">
				<input id="inc_number" type="text" class="input-large" placeHolder="Input your Age" />

				<input type="submit" value="Submit" />
			</form>
			
			<div>
				<ul id="ages">
					<?php 
						$query = $pdo->prepare( 'SELECT * FROM countings ORDER BY id DESC' );
						$query->execute();
						
						$ages = $query->fetchAll( PDO::FETCH_OBJ );
						foreach( $ages as $age ):
					?>
						<li> <strong><?php echo $age->inc_number; ?>
					<?php endforeach; ?>
				</ul>
			</div>
			<br>
			<br>
			<form class="form-inline" id="messageForm">
				<input id="nameInput" type="text" class="input-medium" placeholder="Name" />
				<input id="messageInput" type="text" class="input-xxlarge" placeHolder="Message" />
			

				<input type="submit" value="Submit" />
			</form>
			
			<div>
				<ul id="messages">
					<?php 
						$query = $pdo->prepare( 'SELECT * FROM message ORDER BY id DESC' );
						$query->execute();
						
						$messages = $query->fetchAll( PDO::FETCH_OBJ );
						foreach( $messages as $message ):
					?>
						<li> <?php echo $message->name; ?>:   <?php echo $message->message; ?> <button onclick="deleteRow(<?php echo $message->id; ?>)"> Delete </button></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/node_modules/socket.io-client/dist/socket.io.js"></script>
		<script src="js/client.js"></script>
	</body>
</html>