<?php

	class ConstraintsVerify{
		//atributs de la classe
		public $conexion;
		public $constr;
		public $table;
		//constructor de l'objecte que s'ha de verificar
		function __construct($connection, $constr, $table){
			$this->connection = $connection;
			$this->constr = $constr;
			$this->table = $table;
		}
		//verifica si totes les constraints de la llista existeixen en la taula
		function verify(){
			$aux = explode('&', $this->constr);
			for($i = 0; $i < count($aux); $i++){
				if(!$this->verifySingleConstr($aux[$i])){
					echo "Error en la verificacio de les constraints";
					exit();
				}
			}
			return $aux;
		}	
		//verifica una sola constraint
		function verifySingleConstr($singleConstr){
			$aux = explode('=', $singleConstr);
			$aux2 = explode('[', $aux[0]);
			if($aux2[0] != "limit"){
				$query = "SHOW COLUMNS FROM ".$this->table." LIKE ".'"'.$aux2[0].'"';
				$results = mysqli_query($this->connection, $query);
				if(!mysqli_fetch_row($results))
					return False;
			} 
			return True;
		}
		//creador de constraints preparades per sentencia sql
		function constrCreator($constr, $table){
			if($constr != NULL){
				$constrStr = "";
				$limitConstrStr = $this->limitDetector($constr);
				$limit = $limitConstrStr[0];
				$constrSinLimit = $limitConstrStr[1];
				if($constrSinLimit != NULL){
					$len = count($constrSinLimit);
					for ($i=0; $i < $len; $i++) {
						$aux = explode('=', $constrSinLimit[$i]);
							$aux2 = explode('[', $aux[0]);
							if(count($aux2) > 1) $extra = $aux2[1];
							else $extra = "";
							switch($extra){
                                case "gt]":
                                    $aux2[0] = $aux2[0]. " >'";
                                    break;
                                case "gte]":
                                    $aux2[0] = $aux2[0]. " >='";
                                    break;
                                case "lt]":
                                    $aux2[0] = $aux2[0]. " <'";
                                    break;
                                case "lte]":
                                    $aux2[0] = $aux2[0]. " <='";
                                    break;
                                default:
                                    $aux2[0] = $aux2[0]."='";
                                    break;
                            }
							$aux[1] = $aux[1]."'";
							$constrStr = $constrStr. $aux2[0]. $aux[1];
							if($i < $len-1)
								$constrStr = $constrStr. " AND ";
							else
								$constrStr = $constrStr;
					}
				}
				if($limit != NULL)
					$limitStr = " limit ". $limit;
				else 
					$limitStr = "";
				if($constrSinLimit != NULL)
					$constrStr = "select * from ". $table. " where ". $constrStr. $limitStr;
				else 
					$constrStr = "select * from ". $table. $limitStr;
			}
			else
				$constrStr = "select * from ". $table;

			return $constrStr;
		}

		//buscar si hi ha limit entre les constraints i si hi ha l'extreu i es guarda el valor
		function limitDetector($constr){
			$limitConstrStr[0]= "";
			$len = count($constr);
			$j = 0;
			for ($i=0; $i < $len; $i++) { 
				$aux = explode('=', $constr[$i]);
				if($aux[0] == "limit"){
					$limitConstrStr[0] = $aux[1];
				}
				else{
					$constrSinLimit[$j] = $constr[$i];
					$j++;
				}
			}
			$limitConstrStr[1] = $constrSinLimit;
			return $limitConstrStr;
		}
	}
?>
