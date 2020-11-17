<?php
//************COMENTARIS***********
// OBSERVACIONS:
// - el uid s'ha de passar desde python al url http://localhost/pbe/get.php?timetables?uid=34737834&day=Fri&ho... 
// - limit ha d'anar despres de order by
// A SOLUCIONAR:
// - quan ordenem els dies nomes deixem les constr al primer, pero la de uid s'ha de quedar a tots
// - les funcions showinserver i printinserver es poden fer en una sola?
// - les funcions del final del fitxer es poden serpar a un nou fitxer
// - nombrar els fitxers amb noms coherents al seu contingut
// - revisar la nomenclatura de les variables
// - les funcions dayDetector, compDetector i compDayDetector, es podrien simplificar en una sola?
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

	//agafem el url i separem les dades que ens interessen (taula i vector de constraints)
	//verifiquem que les dades son correctes amb funcions del fitxer constVeryfier.php
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
	$constrUid = searchUid($constr);

	//segons la taula que volguem mirar creem una query diferent a la bd i mostrem el seu resultat al servidor
	switch($table){
		case "timetables":
			$i_max = 4;
			orderAndPrintTimetable($connection, $i_max, $constr, $table, $contsVeryfier, $constrUid);				
			break;

		case "tasks":
			$i_max = 3;
			$constr_str = $contsVeryfier->constrCreator($constr, $table);
			$constr_str = $constr_str. " order by date";
			printInServer($connection, $constr_str, $i_max);
			break;
		case "marks":
			$i_max = 3;
			$constr_str = $contsVeryfier->constrCreator($constr, $table);
			$constr_str = $constr_str. " order by subject";
			printInServer($connection, $constr_str, $i_max);
			break;		
	}

	//tanquem la conexio amb la db
	mysqli_close($connection);

	//funcio que retorna un vector amb els resultats de la qurey a la bd 
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

	//funcio que retorna un vector de dies ordenats a partir de l'actual.
	function dayParser($constrDay){
		if($constrDay == 10)
			$actualDate = date("w");
		else
			$actualDate = $constrDay;
		$days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
		$parsedDays = array(count($days));
		//ordena els dies a partir de $actualDate
		for($i = 0; $i < count($days); $i++){
			$parsedDays[$i] = $days[($actualDate+$i)%count($days)];
		}
		return $parsedDays;
	}

	//funcio que detecta si en un vector hi ha algun caracter comparador caracteristic de certes cosntraints
	function compDetector($constr){
		if($constr != NULL){
			foreach ($constr as $value) {
				$aux = explode("=", $value);
				foreach ($aux as $value2) {
					$aux2 = explode("[", $value2);
					if(count($aux2) > 1)
						if($aux2[1] != NULL)
				 			return True;
				}
			}
		}
		return False;
	}

	//funcio que retorna el numero corresponent al dia que hi ha a la constraint day si existeix
	function dayDetector($constr){
		$constrDay = 10; //valor que no correspon a cap dia, per tant no hi ha constraint day
		if($constr != NULL){
			foreach ($constr as $value) {
				$aux = explode("=", $value);
				if($aux[0] == "day")
					return True;
			}
		}
		return False;
	}

	//funcio que retorna el numero del dia a partir del que treballar si hi ha a les constraints
	function compDayDetector($constr){
		$constrDay = 10;
		if($constr != NULL){
			foreach ($constr as $value) {
				$aux = explode("=", $value);
				foreach ($aux as $value2){
					$aux2 = explode("[", $value2);
					if((count($aux2) > 1) && ($aux2[0] == "day")){
						switch($aux[1]){
							case "Mon":
								$constrDay = 1;
								break;
							case "Tue":
								$constrDay = 2;
								break;
							case "Wed":
								$constrDay = 3;
								break;
							case "Thu":
								$constrDay = 4;
								break;
							case "Fri":
								$constrDay = 5;
								break;
						}	
					}
				}
			}
		}
		return $constrDay;
	}

	//funcio que mostra al server
	function printInServer($connection, $constr_str, $i_max){
		$out = showInServer($connection, $constr_str, $i_max);
			foreach ($out as $value) {
				echo $value. "<br>";
			}
	}

	//fucnio que busca i retorna el valor de la constraint uid en un vector de constraints
	function searchUid($constr){
		$constrUid= "";
		if($constr != NULL){
			foreach ($constr as $value) {
				$aux = explode("=", $value);
				if($aux[0] != "uid")
		 			$CosnrUid = $aux[1]; 
			}
		}
		return False;
	}

	//funcio que realitza les querys per ordre de dia a partir de l'actual i aplica certes constraints
	function orderAndPrintTimetable($connection, $i_max, $constr, $table, $contsVeryfier, $constrUid){
		$constrDay = compDayDetector($constr);
		$days = dayParser($constrDay);
			if(($constr == NULL || compDetector($constr)) && (!dayDetector($constr) && compDetector($constr))){
				for ($i=0; $i < count($days); $i++) {
					if($i != 0){
						$constr = NULL;
						$constr[0] = $constrUid;
						$constr[1] = "day=".$days[$i];
						$constr_str0 = $contsVeryfier->constrCreator($constr, $table);
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
					echo $constr_str;
				}
			}
			else{
				$constr_str = $contsVeryfier->constrCreator($constr, $table);
				printInServer($connection, $constr_str, $i_max);
			}
	}
	//posteriorment python llegeix els valors que apareixen al servidor web
?>