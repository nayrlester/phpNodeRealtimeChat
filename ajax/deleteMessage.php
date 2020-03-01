<?php
	
	include_once( dirname( __FILE__ ) . '/../class/Database.class.php' );
	$pdo = Database::getInstance()->getPdoObject();
	
	$rowId = $_POST[ 'rowId' ];
	
	$query = $pdo->prepare( 'DELETE from message where id = :rowId' );
	$query->bindParam(":rowId",$rowId,PDO::PARAM_INT);
    $query->execute();
	
?>