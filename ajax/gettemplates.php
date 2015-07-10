<?php
	$myconn = new mysqli('localhost','memester','opisafaggot','memester');
	
	$result = $myconn->query("select name, file from templates limit 500");
	
	$return = array();
	while($row = $result->fetch_assoc()){
		$return[] = $row;
	}
	
	echo json_encode($return);
?>
