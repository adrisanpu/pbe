<?php

	$dbHost = "localhost";
	$dbName="pbe";
	$dbUsr="root";
	$dbPassword="";
	require_once("connectDB.php");
	$db = new dbConnection($dbHost, $dbName, $dbUsr, $dbPassword, "utf8");
	$connection = $db->connect();
	$userName = $_GET["username"];
	$password = $_GET["password"];
	$query = "select * from students where username=".'"'. $userName.'" and password="'. $password.'"';
	$results = mysqli_query($connection, $query);
	if($fila=mysqli_fetch_row($results))
    	echo json_encode(array("uid"=>$fila[0], "name"=>$fila[1]));	
	else
		echo json_encode((array("name"=>"ERROR")));
	$db->disconnect();	
?>
