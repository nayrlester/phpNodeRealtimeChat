<?php
	
	include_once( dirname( __FILE__ ) . '/../class/Database.class.php' );
	$pdo = Database::getInstance()->getPdoObject();
	
	$query = $pdo->prepare( 'SELECT * from message ' );
    $query->execute();
	
    $orderObject = array();
	while ($row = $query->fetch()) {
	  	
		$obj = array(
			'id' => $row['id'],
			'name' => $row['name'],
			'message' => $row['message'],
		);
		array_push($orderObject, $obj);
	}

	$jsonstring = json_encode($orderObject);
	echo $jsonstring;

?>