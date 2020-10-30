<?php
	//dades de la db
	$dbHost = "localHost";
	$dbName = "pbe";
	$dbUsr = "root";
	$dbPassword = "";
	//connexio amb la db
	$connection = mysqli_connect($dbHost, $dbUsr, $dbPassword);
	//metodes de configuracio i comprovacio de la conexio amb la db
	if(mysqli_connect_errno()){
		echo "Error al connectar el servidor amb la base de dades.";
		exit();
	}
	mysqli_select_db($connection, $dbName) or die ("No s'ha pogut trobar la base de dades.");
	//no se perque aquesta funcio em dona error
	mysqli_set_charset($connection, "utf8"); 
	//metode get asigna a les variables el valor que indica el url (que ve de python)
	//$query = $_GET["query"];
	//$name = $_GET["name"];
	$query = "timetables";
	$name = "xxx";
	//creem la comanda en sql per transmetre a la db
	//aquesta comanda pot variar, depen de com construim les taules de la db
	$consult_data = "select * from ". $query. " where uid = ". '"'. $name. '"';
	$result = mysqli_query($connection, $consult_data);
	//definir el num de camps de cada taula
	switch($query){
		case "timetables":
			$i_max = 4;
			break;
		case "tasks" || "marks":
			$i_max = 3;
			break;	
	}
	//imprimir al servidor web les dades en files separades per salt de linia i columnes per coma
	while($row = mysqli_fetch_row($result)){
		$i = 1;
		while($i <= $i_max){
			echo $row[$i]. ",";
			$i ++;
		}
		echo "<br>";
	}
	//tanquem la conexio amb la db
	mysqli_close($connection);
	//posteriorment python llegeix els valors que apareixen al servidor web
?>