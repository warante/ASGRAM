<?php

/*


*/

			$db_dir = "../db/db.php";		// ubicación de los datos de la base de datos
			$nom_tabla_pal = "palabras" 	// nombre de la tabla que contiene las palabras
			$nom_col_pal = "pal"			// nombre de la columna que contiene las palabras
			$nom_tabla_ej = "ejemplos" 		// nombre de la tabla que contiene los códigos de los ejemplos
			$nom_col_ej = "codEj"			// nombre de la columna que contiene los códigos de los ejemplos
			
			
			require_once('snippets/preFormat.php'); // Separa las palabras de caracteres especiales
			
			$trozos = explode(" ", $txt);
			include($db_dir);
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
					$sql_cons = "SELECT * FROM `" . $nom_tabla_pal "` WHERE `" . $nom_col_pal . "` LIKE '" . $trozo . "'";
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
							$sql_cons = "SELECT * FROM `" . $nom_tabla_pal "` WHERE `" . $nom_col_pal . "` LIKE '" . $doble . "'";
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
								$trozo ='<l id= "' . $cod . '" onClick="ventana(' . $cod . ', ' . $arg . ')" class="posible">' . $doble . '</l>';
								$cod++;
							}
							else
							{						
								$trozo ='<span id= "' . $cod . '" onClick="ventana(' . $cod . ', ' . $arg . ')" class="posible">' . $trozo . '</span>';
								$cod++;	
							}
						}
						else
						{						
							$trozo ='<span id= "' . $cod . '" onClick="ventana(' . $cod . ', ' . $arg . ')" class="posible">' . $trozo . '</span>';
							$cod++;	
						}
											
					}				
					else if($anterior != "")
					{
						$doble = $anterior . " " . $trozo;
						$sql_cons = "SELECT * FROM `palabras` WHERE `pal` LIKE '" . $doble . "'";
						$res = mysql_query($sql_cons, $conn) or die(mysql_error());		
						if(($cont = mysql_fetch_array($res))!=0)
						{					
							$sql_cons = "SELECT * FROM `ejemplos` WHERE `codEj` LIKE '" . $cont[1] . "'";
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
							$trozo ='<l id= "' . $cod . '" onClick="ventana(' . $cod . ', ' . $arg . ')" class="posible">' . $doble . '</l>';
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