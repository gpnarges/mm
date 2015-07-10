<?php
	define('UPLOAD_DIR', '/var/www/html/memester/www/images/');
	$img = $_POST['picdata'];
	$name = $_POST['name'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace('data:image/jpeg;base64,', '', $img);
	$img = str_replace('data:image/gif;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = uniqid() . '.jpg';
	$success = file_put_contents(UPLOAD_DIR . $file, $data);

	$myconn = new mysqli('localhost','memester','opisafaggot','memester');
	
	$name = $myconn->real_escape_string($name);
	$result = $myconn->query("select name from templates where name = '{$name}'");
	print_r($result);
	
	if ($result->num_rows == 0){
		$myconn->query("insert into templates (name, file) values ('{$name}','{$file}')");
	}else{
		
	}
	
	echo "done";
?>
