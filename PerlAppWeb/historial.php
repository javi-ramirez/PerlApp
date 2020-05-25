<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Historial </title>
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
			<li><a href="historial.php">Historial</a></li>
			
		</ul>	
	</div>

	<div class="center-content" > 
	<p>Detalles</p>
	</div>
		
	<div class="Table">
				<div class="Heading">
					<div class="Cell">Nombre del chofer</div>
					<div class="Cell">Cami&oacute;n</div>
					<div class="Cell">Ruta</div>
					<div class="Cell">Hora Inicio</div>
					<div class="Cell">Hora Fin</div>
				</div>
	</div>

	<div class="center-content" > 
	<p>Comentarios</p>
	</div>
		

<table border="1px" align="center">
				<tr>
					<td>Nombre del chofer</td>
					<td>Cami&oacute;n</td>
					<td>Comentario</td>
				</tr>

<?php 
				$consulta="Select nombre_chofer, numero,comentario from chofer, camion, comentario";
							 
							include("conect.php");
							$resultado=mysqli_query($conexion, $consulta)
							or die("Error al hacer la consulta");
				include("conect.php");
				$resultado=mysqli_query($conexion,$consulta)
                or die ("Error al consultar");
                while ($fila=mysqli_fetch_array($resultado)) {
				echo "<tr>";
                echo "<td>".$fila['nombre_chofer']."</td>";
                echo "<td>".$fila['numero']."</td>";
                echo "<td>".$fila['comentario']."</td>";
				echo "</tr>";
				}
				 ?>
				</tr>
				</table>
				
</body>
</html>