<?php

	//dades de la db
	$dbHost = "localHost";
	$dbName = "pbe";
	$dbUsr = "root";
	$dbPassword = "";
	//connexio amb la db utilitzant el fitxer connectDB.php
	require_once("connectDB.php");
	require_once("functions.php");
	$db = new dbConnection($dbHost, $dbName, $dbUsr, $dbPassword, "utf8");
	$connection = $db->connect();
	$funct = new RegularFunctions;
	//parsejat inicial del url i verificacio de les constaints introduides
	$url= $_SERVER["REQUEST_URI"];
	$aux = explode('?', $url);
	$lenQuery = count($aux);
	$constr = NULL;
	if($lenQuery > 1){
		$table = $aux[1];
		$contsVeryfier = new ConstraintsVerify($connection, $aux[2], $table);
		if($lenQuery > 2 && $aux[2] != NULL) 
			$constr = $contsVeryfier->verify();
	}
	else{
		echo "Error en la introducció de la query";
		exit();
	}
	$constrUid = $funct->searchUid($constr);
	//cas on es declara l'ordre en el que s'hauran de mostrar les dades per a cada taula i les imprimeix al servidor
	switch($table){
		case "timetables":
			$iMax = 4;
			$funct->orderAndPrintTimetable($connection, $iMax, $constr, $table, $contsVeryfier, $constrUid);
			break;
		case "tasks":
			$iMax = 3;
			$constrStr = $contsVeryfier->constrCreator($constr, $table);
			$constrStr = $constrStr. " order by date";
			$funct->showIt($connection, $constrStr, $iMax, $table,$constrUid);
			break;
		case "marks":
			$iMax = 3;
			$constrStr = $contsVeryfier->constrCreator($constr, $table);
			$constrStr = $constrStr. " order by subject";
			$funct->showIt($connection, $constrStr, $iMax, $table,$constrUid);
			break;		
	}
	//tanquem la conexio amb la db
	mysqli_close($connection);

?>
