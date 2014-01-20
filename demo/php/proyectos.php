<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Proyectos que tienen disponible el equipo de yopisoft para el uso público. Visita está página a menudo si quieres estar a la última.">
    <meta name="author" content="David Domínguez">
	<title>YopiSoft - Proyectos</title>
	
	<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/small-business.css" rel="stylesheet">	
	<link href="../css/general.css" rel="stylesheet" media="screen">	
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/funciones.js"></script>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	  <?php
		require_once('navbar.php');
	  ?>
    </nav>

    <div class="container">

     <div class="row">
        <div class="col-lg-4">
		  
            <h1>Proyectos</h1>
            <p>Actualmente nos encontramos ampliando la base de datos y adaptando el analizador semántico gramatical para entornos de escritorio y dispositivos móviles. No obstante, también estamos trabajando en otros proyectos que serán añadidos a esta página cuando estén disponibles públicamente.</p><p>Los proyectos listos para su uso son los siguientes:</p>
			<p><a href="../"><b>&middot;ASGRAM - Analizador semántico gramatical: </b></a>El sistema detecta las palabras que puedan tener distinto significado según como se escriban y permite comprobar si son correctas a través de un menú interactivo con ejemplos de uso para resolver todas las dudas.</p>
			<hr class="visible-sm visible-xs visible-md">			
        </div>		
        <div class="col-lg-8">          
			<img style="width:100%;" src="../img/project.jpg" alt="Persona sosteniendo un portatil">
        </div>
      </div>
	  	  
	  <?php // pie página
		require_once('pie.php');
	  ?>
	  
    </div>
  </body>
</html>