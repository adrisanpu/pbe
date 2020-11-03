<?php
//************COMENTARIS***********
// - S'ha d'aclarar com funciona l'ordre de timetables.
// - S'ha d'implementar el tema de les constraints per URL que hi ha a l'enunciat?
// - El numero d'iteracions de cada taula (camps) esta una mica chapuza pero no he trobat altra opcio:
//		- count(*) pero retorna un objecte de tipus mysqli_result q no puc castejar a int per operar.
//		- si ho faig am un i++ per iteracio surt un warning al server que molesta.
//************COMENTARIS***********

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
	//variables d'exemple
	$query = "tasks";
	$name = "0xa9,0x47,0x56,0xc1";
	//per a cada query diferent es fa una busqueda a la db amb la sentencia sql pertinent que a mes ordena els registres de la manera que s'especifica a l'enunciat
	switch($query){
		case "timetables":
			$i_max = 4;
			$consultData = "select * from ". $query. " where uid = ". '"'. $name. '"';
			showInServer($connection, $consultData, $i_max);
			break;
		case "tasks":
			$i_max = 3;
			$consultData = "select * from ". $query. " where uid = ". '"'. $name. '"'. " order by date";
			showInServer($connection, $consultData, $i_max);
			break;
		case "marks":
			$i_max = 3;
			$consultData = "select * from ". $query. " where uid = ". '"'. $name. '"'. " order by subject";
			showInServer($connection, $consultData, $i_max);
			break;		
	}
	//funcio que es crida quan es vol mostrar al servidor el resultat final de la busqueda 
	function showInServer($connectDB, $consultDB, $fields){
		$result = mysqli_query($connectDB, $consultDB);
		while($row = mysqli_fetch_row($result)){
		$i = 1;
			while($i <= $fields){
				echo $row[$i]. ",";
				$i ++;
			}
		echo "<br>";
		}
	}
	//tanquem la conexio amb la db
	mysqli_close($connection);
	//posteriorment python llegeix els valors que apareixen al servidor web
?>