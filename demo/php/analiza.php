<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Analizador, aquí encontraras el texto analizado con las palabras que puedan tener distintos significados marcadas y con un menú interactivo con explicaciones y ejemplos.">
    <meta name="author" content="David Domínguez">
	<title>ASGRAM - Analiza las palabras homónimas de su texto</title>
	
	<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/small-business.css" rel="stylesheet">	
	<link href="../css/general.css" rel="stylesheet" media="screen">	
	
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/funciones.js"></script>
  </head>

<?php
	if(isset($_POST['enviar']))
		{		
			$txt = strip_tags($_POST['texto']);			
			if($txt == ""){
				$txt = "No ha introducido ningun texto, para analizar un texto pulse en \"Analizar otro texto\".";
			}
			else
			{
				require_once('../../core/core.php');	// Analaiza el texto y añade los ejemplos
			}
		}
	else
	{
		$txtmod = "No ha introducido ningun texto, para analizar un texto pulse en \"Analizar otro texto\".";
	}
?>
  <body>
	
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	  <?php
		require_once('navbar.php');
	  ?>
    </nav>

    <div class="container">	  
	  <div class="row">
	  <form name="contenido" action="php/analiza.php" method="post" enctype="multipart/form-data">
        <div class="col-lg-4">		  
            <h1>Texto analizado</h1>
            <p class="hidden-xs hidden-sm">Si el texto contiene palabras que tienen varias formas de ser interpretadas se mostrarán en un color distinto. Para comprobar si ha usado la palabra correcta pulse sobre la palabra coloreada y seleccione la correcta a través del menú que aparecerá. A continuación se detalla que significa cada color: </p>
			<p class="visible-sm visible-xs"><b class="posible">&middot;Azul</b> Palabra que debe revisar si no está seguro de su uso (pulse sobre ella).</p>
			<p class="visible-md visible-lg"><b class="posible">&middot;Azul</b> Palabra que posee al menos otro significado escrita de otra forma, revísela si no está seguro de su uso.</p>
			<p><b class="visto">&middot;Naranja</b> Palabra que ya ha sido revisada.</p>
			<p class="hidden-xs hidden-sm"><b>&middot;Negro</b> Palabra que no posee otro significado y que por tanto no necesita revisión.</p>
			<input type="button" name="volver" id="volver" value="Analizar otro texto" class="btn btn-primary btn-lg" onclick="window.location='../'"/>
			<a href="http://yopisoft.blogspot.com.es/2013/11/manual-de-uso.html" class="btn btn-lg btn-success" target="_blank">Ayuda</a>
			<hr class="visible-sm visible-xs visible-md">			
        </div>
        <div class="col-lg-8">		
			<div style="overflow-y: scroll;" class="borde">
			<?php echo $txtmod; ?>
				<input id="zoom" value="boton" type="button" class="button oculto btn btn-primary btn-lg" onclick="modal()" data-toggle="modal" data-target="#myModal" /> 
				</div>
        </div>
		</form>
      </div>   
	  
	  <?php // pie página
		require_once('pie.php');
	  ?>
	  
    </div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">¿Quiso decir?</h4>
			  </div>
			  <div class="modal-body">				
				<p id="opcion1"></p>
				<p id="opcion2"></p>
				<p id="opcion3"></p>
				<p id="opcion4"></p>
				<p id="opcion5"></p>				
				<p id="opcion6"></p>			
				<p id="opcion7"></p>
			  </div>
			  <div class="modal-footer">
				<input id="btnSi" onclick="cambiar()" name="btnSi" type="button" value="Cambiar" class="cambia btn btn-success" />
				<input id="btnNo" name="btnNo" type="button" value="Mantener" class="cambia btn btn-default" data-dismiss="modal" />
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	
	
	<input id="valor" name="valor" size="20" type="text" value="" class="oculto"/>
  </body>
</html>