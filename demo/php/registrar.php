<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Asesor semántico gramatical">
    <meta name="author" content="David Domínguez">
	<title>YopiSoft - Registrar</title>
	
	<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/small-business.css" rel="stylesheet">	
	<link href="../css/general.css" rel="stylesheet" media="screen">	
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/funciones.js"></script>
    <script src="../js/vanadium.js" type="text/javascript"></script>
  </head>

  <body>
  <?php
		
	require_once('../../core/confg.php');		// Archivo de configuración de variables para la base de datos, combiar la ruta según se necesite
	
			$conn = mysql_connect($server, $db_user, $db_pass) or die(mysql_error());
			mysql_select_db($database, $conn);
			if(isset($_POST['registrar']))
			{			
				$pal = $_POST['pal'];
				$ej = $_POST['ej'];
				$codEj = $_POST['cod'];
				$ex = $_POST['ex'];
				$palN = "<b>" . $pal . "</b>";
				$ej = str_replace($pal,$palN, $ej);				
				$palN = "<b>" . ucwords($pal) . "</b>";				
				$ej = str_replace(ucwords($pal),$palN, $ej);
				$exp = $pal . "# " . $ex;
				$ej = "#Ej: " . $ej;
				
				$sql_cons = "SELECT * FROM `" . $nom_tabla_pal . "` WHERE `" . $nom_col_pal . "` LIKE '" . $pal . "'";
				$res = mysql_query($sql_cons, $conn) or die(mysql_error());	
				if(($cont = mysql_fetch_array($res))==0)
				{
					$insertar = "INSERT INTO `" . $nom_tabla_pal . "` (`" . $nom_col_pal . "`, `" . $nom_col_ej . "`) VALUES ('$pal', '$codEj');";
					$result = mysql_query($insertar, $conn) or die(mysql_error());				
				}
				else
				{
					$codEj = $cont['codEj'];
				}		
					$insertar = "INSERT INTO `" . $nom_tabla_ej . "` (`" . $nom_col_ej . "`, `" . $nom_col_ejemplos . "`, `" . $nom_col_exp . "`) VALUES ('$codEj', '$ej', '$exp');";
					$result = mysql_query($insertar, $conn) or die(mysql_error());
					echo '<div class="alert alert-success"> Registro realizado con éxito </div>';
			}
			
		?>
  
  
  
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <a class="navbar-brand logo-nav" href="../"><img src="../img/yopi.png" alt="Logo de yopisoft"></a>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../">ASGRAM</a></li>	
            <li><a href="proyectos.php">Proyectos</a></li>	
            <li><a href="http://yopisoft.blogspot.com.es/" target="_blank">Blog</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">

      <div class="row">
	<form name="datos_registro" action="registrar.php" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
        <div class="col-lg-8 thumbnail">          
					<h2>Datos</h2>										
					<div class="form-group">
						<label class="col-lg-3 control-label">Palabra</label>
						<div class="col-lg-8">
							<input type="text" class="form-control :required" id="pal" name="pal" placeholder="Palabra que puede ser confundida con otra">
						</div>
					</div>	
					<div class="form-group">
						<label class="col-lg-3 control-label">Código de ejemplo</label>
						<div class="col-lg-8">
							<input type="text" class="form-control :required :length;5" id="cod" name="cod" placeholder="Código que comparten las palabras que pueden ser confundiadas (columna derecha)">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Explicación</label>
						<div class="col-lg-8">
							<input type="text" class="form-control :required :max_length;200" id="ex" name="ex" placeholder="Breve explicación de donde viene la palabra">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Ejemplo de uso</label>
						<div class="col-lg-8">
							<input type="text" class="form-control :required :max_length;200" id="ej" name="ej" placeholder="Ejemplo de situación que haga uso de la palabra de forma correcta ">
						</div>
					</div>
					<br/>
					<div>
						<input type="submit" name="registrar" id="registrar" value="Registrar" class="btn btn-primary btn-lg"/>	
						<input type="button" name="volver" id="volver" value="Volver" class="btn btn-success btn-lg" onclick="window.location='../../'"/>				
					</div>
				
        </div>
        <div class="col-lg-4">
		  
            <h1>Registro actual</h1>
            <p>De esta columna se obtiene el campo "Código de ejemplo" del formulario. Se busca la palabra con la que pueda ser confundida y se usa su codigo de ejemplo</p>
			<select id="sel" name="sel" size="25" style="width:100%;" onclick="seleccion()">
			<?php
				$sql2 = "SELECT * FROM `" . $nom_tabla_pal . "` order by `" . $nom_col_ej . "` desc";		
				$res = mysql_query($sql2, $conn);
				while($row = mysql_fetch_array($res))
				{
					echo "<option value=\"" . $row[1] . "\">" . $row[1] . "\t|\t" . $row[0] ."</option>";
				}
			?>
			</select>
					  
        </div>
		</form>
      </div>
	  
	  <?php // pie página
		require_once('pie.php');
	  ?>

    </div><!-- /.container -->

  </body>
</html>