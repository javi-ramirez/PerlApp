 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Agregar Rutas</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>

	<div id="menu">
		
		<ul>
			<img src="Blanco.png">
			<li><a href="inicio.php">Inicio</a></li>
			<li><a href="agregarChofer.php">Chofer</a></li>
			<li><a href="agregarRuta.php">Ruta</a></li>
			<li><a href="agregarCamion.php">Camión</a></li>
			<li><a href="#">Historial</a></li>
		</ul>
		
	</div>
	
	<div class="center-content" > 
	<p>Agregar Rutas</p>
	</div>
		
	<form action="insertarRuta.php" method="POST" >
	<p id="fuente">Nombre de la ruta:</p>
	<input type="text" class="field input" id="ruta" name="ruta" > <br/>
	
	<p class="center-content"> <input type="submit" value="Agregar" id="nombre_ruta" name="nombre_ruta"></p>
	
	
</body>
</html>