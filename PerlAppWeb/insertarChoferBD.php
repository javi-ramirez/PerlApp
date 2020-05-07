<?php
 $correo=$_POST["correo"];
 $nombre_chofer=$_POST["no"];


 include("conect.php"); 
 
 $cadenaInserta="insert into chofer (correo,nombre_chofer)".
				"values('$correo','$nombre_chofer')"; 
				//echo $cadenaInserta;
				//exit();
						
				mysqli_query($conexion,$cadenaInserta)
				or die("Error al insertar los datos del chofer.");
				header("Location: agregarChofer.php"); 
 
 ?>
 