<?php
	//dades de la db
	$dbHost = "localHost";
	$dbName = ""; //posar nom de la db creada a mysql
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
	$name = $_GET["name"];
	$query = $_GET["query"];
	//creem la comanda en sql per transmetre a la db
	$consult = "SELECT ". $query. " FROM". $name;
	$result = mysqli_query($connection, $consult);
	//imprimir al servidor web les dades en files separades per salt de linia i columnes per coma
	while($row = mysqli_fetch_row($result)){
		$i = 0;
		while($row[i]){
			echo $row[i]. ",";
		}
		echo "<br>";
	}
	//posteriorment python llegeix els valors que apareixen al servidor web
?>