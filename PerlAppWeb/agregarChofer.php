<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Agregar Chofer</title>
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
	<p>Agregar Chofer</p>
	</div>
		
	<form action="insertarChoferBD.php" method="post" onsubmit="return validate(this)">
	<p id="fuente">Nombre del chofer:</p>
	<input type="text" class="field input" id="no" name="no"> <br>
	<p id="fuente">Correo:</p>
	<input type="text" class="field input" id="correo" name="correo"> <br>
	<p class="center-content"> <input type="submit"  id="nombre_chofer" name="nombre_chofer" align="center"></p>
	</form>
	
</body>
</html>