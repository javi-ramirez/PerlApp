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
			<li><a href="#">Inicio</a></li>
			<li><a href="agregarChofer.php">Chofer</a></li>
			<li><a href="agregarRuta.php">Ruta</a></li>
			<li><a href="agregarCamion.php">Camión</a></li>
			<li><a href="#">Historial</a></li>
		</ul>		
	</div>	
	<div class="center-content" > 
	<p>Perlapp</p>
	</div>
	<br>
<div class="Table">
				<div class="Heading">
					<div class="Cell">Número</div>
					<div class="Cell">Ruta</div>
				</div>

<?php 
				$consulta="select numero, nombre_ruta from camion, ruta";
							 
							include("conect.php");
							$resultado=mysqli_query($conexion, $consulta)
							or die("Error al hacer la consulta");
				include("conect.php");
				$resultado=mysqli_query($conexion,$consulta)
                or die ("Error al consultar");
                while ($fila=mysqli_fetch_array($resultado)) {
				echo "<div class='Row'>";
                echo "<div class='Cell'>".$fila['numero']."</div>";
                echo "<div class='Cell'>".$fila['nombre_ruta']."</div>";
				echo "</div>";
				}
				 ?>
				</div>
				</div>




	
</body>
</html>