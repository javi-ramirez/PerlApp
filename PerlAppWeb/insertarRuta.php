 <?php
 $nombre_ruta=$_POST["ruta"];

 

 include("conect.php"); 
 
 $cadenaInserta="insert into ruta (nombre_ruta)".
				"values('$nombre_ruta')"; 
						
				mysqli_query($conexion,$cadenaInserta)
				or die("Error al insertar la ruta.");
				header("Location: agregarRuta.php"); 
 
 ?>