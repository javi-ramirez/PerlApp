  <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Agregar Camiones</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>	
	<div id="menu">
		
		<ul>
			<img src="Blanco.png">
			<li><a href="inicio.php">Inicio</a></li>
			<li><a href="agregarChofer.php">Chofer</a></li>
			<li><a href="agregarRuta.php">Ruta</a></li>
			<li><a href="agregarCamion.php">Cami&oacute;n</a></li>
			<li><a href="#">Historial</a></li>
		</ul>	
	</div>
	<div class="center-content" > 
	<p>Agregar Camiones</p>
	</div>
		
	<form action="insertarCamion.php" method="POST" >
	<p id="fuente">N&uacute;mero:</p>
	<input type="text" class="field input" id="numero_camion" name="numero_camion"> <br/>
	
	<p class="center-content"> <input type="submit" value="Agregar" id="numero" name="numero"></p>
	
	
</body>
</html>
