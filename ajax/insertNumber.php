<?php
	
	include_once( dirname( __FILE__ ) . '/../class/Database.class.php' );
	$pdo = Database::getInstance()->getPdoObject();
	
	$inc_number = $_POST[ 'inc_number' ];
	
	$query = $pdo->prepare( 'UPDATE countings set inc_number = :inc_number where id = 1' );
	$query->execute( array( 'inc_number' => $inc_number) );
	
?>