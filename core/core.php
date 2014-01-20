<?php

/*****************************************************************************************************************************************************************************************************
	Titulo: Motor de ASGRAM (Analizador semantico gramatical).
	
	Versión: 1.0.0
	
	Requisitos: 
		- Base de datos SQL.
		- Una tabla con dos columnas. En una columna la palabra a buscar y en la otra columna su codificación.
		- Una tabla con tres columnas. En una columna la codificación del ejemplo, que deberá coincidir con la codificación de la columna anterior, es decir, cada palabra de la tabla anterior tendrá una fila en esta nueva tabla, en otra columna se almacenarán los ejemplos y en la que queda se almacenara la explicación pertinente.
		
	Descripción: Recorre el texto que recive en la varibale '$txt' y busca coincidencias en la base de datos. En el caso de encontrar una coincidencia, se marca la/s palabra/s coincidente/s y se le 						asigna una función para realizar la acción que se desee, al marcar el texto, también se añaden los ejemplos y explicaciones que se encuentren en la base de datos.

*****************************************************************************************************************************************************************************************************/


	require_once('../../core/confg.php');		// Archivo de configuración de variables para la base de datos, combiar la ruta según se necesite
			
	require_once('snippets/preFormat.php'); 	// Separa las palabras de caracteres especiales
			
	$trozos = explode(" ", $txt);

	$conn = @mysql_connect($server, $db_user, $db_pass) or die(mysql_error());
	mysql_select_db($database, $conn);
	$cod = 0;
	$sig[] = array();
	$anterior = "";
	foreach($trozos as &$trozo)
	{			
		$trozo = trim($trozo); // quita el salto de linea
		$actual = $trozo;
		if(($trozo != '%')&&($trozo != '?')&&($trozo != '_')&&($trozo != '*'))
		{				
			$sql_cons = "SELECT * FROM `" . $nom_tabla_pal . "` WHERE `" . $nom_col_pal . "` LIKE '" . $trozo . "'";
			$res = mysql_query($sql_cons, $conn) or die(mysql_error());		
			if(($cont = mysql_fetch_array($res))!=0)
			{				
				$sql_cons = "SELECT * FROM `" . $nom_tabla_ej . "` WHERE `" . $nom_col_ej . "` LIKE '" . $cont[1] . "'";
				$val = mysql_query($sql_cons, $conn) or die(mysql_error());	
				$arg = "";
				$i = 0;
				while($res = mysql_fetch_array($val))
				{
					if($i == 0){
						$arg = "'" . $res[2] . $res[1] . "'";
					}
					else{
						$arg = $arg . ", '" . $res[2] . $res[1] . "'";
					}
					$i++;
				}	

				if($anterior != "")
				{
					$doble = $anterior . " " .$trozo;
					$sql_cons = "SELECT * FROM `" . $nom_tabla_pal . "` WHERE `" . $nom_col_pal . "` LIKE '" . $doble . "'";
					$res = mysql_query($sql_cons, $conn) or die(mysql_error());		
					if(($cont = mysql_fetch_array($res))!=0)
					{					
						$sql_cons = "SELECT * FROM `" . $nom_tabla_ej . "` WHERE `" . $nom_col_ej . "` LIKE '" . $cont[1] . "'";
						$val = mysql_query($sql_cons, $conn) or die(mysql_error());	
						$arg = "";
						$i = 0;
						while($res = mysql_fetch_array($val))
						{
							if($i == 0){
								$arg = "'" . $res[2] . $res[1] . "'";
							}
							else{
								$arg = $arg . ", '" . $res[2] . $res[1] . "'";
							}
							$i++;
						}							
						$ref = ""; // borra la palabra si forma parte de la siguiente expresion		
						$trozo ='<l id= "' . $cod . '" onClick="' . $nom_func . '(' . $cod . ', ' . $arg . ')" class="posible">' . $doble . '</l>';
						$cod++;
					}
					else
					{						
						$trozo ='<span id= "' . $cod . '" onClick="' . $nom_func . '(' . $cod . ', ' . $arg . ')" class="posible">' . $trozo . '</span>';
						$cod++;	
					}
				}
				else
				{						
					$trozo ='<span id= "' . $cod . '" onClick="' . $nom_func . '(' . $cod . ', ' . $arg . ')" class="posible">' . $trozo . '</span>';
					$cod++;	
				}
										
			}				
			else if($anterior != "")
			{
				$doble = $anterior . " " . $trozo;
				$sql_cons = "SELECT * FROM `" . $nom_tabla_pal . "` WHERE `" . $nom_col_pal . "` LIKE '" . $doble . "'";
				$res = mysql_query($sql_cons, $conn) or die(mysql_error());		
				if(($cont = mysql_fetch_array($res))!=0)
				{					
					$sql_cons = "SELECT * FROM `" . $nom_tabla_ej . "` WHERE `" . $nom_col_ej . "` LIKE '" . $cont[1] . "'";
					$val = mysql_query($sql_cons, $conn) or die(mysql_error());	
					$arg = "";
					$i = 0;
					while($res = mysql_fetch_array($val))
					{
						if($i == 0){
							$arg = "'" . $res[2] . $res[1] . "'";
						}
						else{
							$arg = $arg . ", '" . $res[2] . $res[1] . "'";
						}
						$i++;
					}							
					$ref = ""; // borra la palabra si forma parte de la siguiente expresion		
					$trozo ='<l id= "' . $cod . '" onClick="' . $nom_func . '(' . $cod . ', ' . $arg . ')" class="posible">' . $doble . '</l>';
					$cod++;
				}
			}	
		}				
		$ref = &$trozo;					
		$anterior = $actual;
	}
					
	$txtmod = implode(" ", $trozos);	
			
	require_once('snippets/postFormat.php'); // Vuelve a poner los caracteres especiales en su sitio	
?>