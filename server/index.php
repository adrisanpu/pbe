<?php
//************COMENTARIS***********
// - el uid s'ha de passar desde python al url http://localhost/pbe/get.php?timetables?uid=34737834&day=Fri&ho... 
// - la taula timetables ha d'estar ordenada per dies.
// - limit ha d'anar despres de order by
//************COMENTARIS***********

	//dades de la db
	$dbHost = "localHost";
	$dbName = "pbe";
	$dbUsr = "root";
	$dbPassword = "";

	//connexio amb la db utilitzant el fitxer connectDB.php
	require_once("connectDB.php");
	$db = new db_connection($dbHost, $dbName, $dbUsr, $dbPassword, "utf8");
	$connection = $db->connect();

	//agafem el url i separem les dades que ens interessen
	require_once("constVeryfier.php");
	$url= $_SERVER["REQUEST_URI"];
	$aux = explode('?', $url);
	$len_query = count($aux);
	$constr = NULL;
	if($len_query > 1){
		$table = $aux[1];
		$contsVeryfier = new constraints_verify($connection, $aux[2], $table);
		if($len_query > 2 && $aux[2] != NULL) 
			$constr = $contsVeryfier->verify();
	}
	else{
		echo "Error en la introducció de la query";
		exit();
	}
	//per a cada query diferent es fa una busqueda a la db amb la sentencia sql pertinent que a mes ordena els registres de la manera que s'especifica a l'enunciat
	switch($table){
		case "timetables":
			$i_max = 4;
			$days = dayParser();
			if($constr == NULL || compDetector($constr)){
				for ($i=0; $i < count($days); $i++) { 
					if($i != 0){
						$constr = NULL;
						$constr[0] = "day=".$days[$i];
						$constr_str = $contsVeryfier->constrCreator($constr, $table);
						printInServer($connection, $constr_str, $i_max);
					}
					else{
						if($constr != NULL)
							array_push($constr,"day=".$days[$i]);
						else
							$constr[0] = "day=".$days[$i];
						$constr_str = $contsVeryfier->constrCreator($constr, $table);
						printInServer($connection, $constr_str, $i_max);
					}
				}
			}
			else{
				$constr_str = $contsVeryfier->constrCreator($constr, $table);
				printInServer($connection, $constr_str, $i_max);
			}				
			break;

		case "tasks":
			$i_max = 3;
			$constr_str = $contsVeryfier->constrCreator($constr, $table);
			//$constr_str = $constr_str. " order by date";
			printInServer($connection, $constr_str, $i_max);
			break;
		case "marks":
			$i_max = 3;
			$constr_str = $contsVeryfier->constrCreator($constr, $table);
			$constr_str = $constr_str. " order by subject";
			printInServer($connection, $constr_str, $i_max);
			break;		
	}

	//funcio que es crida quan es vol mostrar al servidor el resultat final de la busqueda 
	function showInServer($connectDB, $consultDB, $fields){
		$result = mysqli_query($connectDB, $consultDB);
		$num_rows = mysqli_num_rows($result); 
		$out = array_fill(0,$num_rows,"");
		$j = 0;
		while($row = mysqli_fetch_row($result)){
			$i = 1;
				while($i <= $fields){
					$out[$j] = $out[$j].$row[$i]. ",";
					$i ++;
				}
			$j++;
		}
		return $out;
	}
	//funcio que ordena per dies a partir del dia actual
	function dayParser(){
		$actualDate = date("w");
		$days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
		$parsedDays = array(count($days));
		//ordena els dies a partir del dia actual
		for($i = 0; $i < count($days); $i++){
			$parsedDays[$i] = $days[($actualDate+$i)%count($days)];
		}
		return $parsedDays;
	}

	function compDetector($constr){
		foreach ($constr as $value) {
			$aux = explode("=", $value);
			foreach ($aux as $value2) {
				$aux2 = explode("[", $value2);
				if($aux2[1] != NULL)
			 		return True;
			}
		}
		return False;

	}

	function printInServer($connection, $constr_str, $i_max){
		$out = showInServer($connection, $constr_str, $i_max);
			foreach ($out as $value) {
				echo $value. "<br>";
			}
	}
	//tanquem la conexio amb la db
	mysqli_close($connection);
	//posteriorment python llegeix els valors que apareixen al servidor web
?>