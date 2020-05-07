 <?php
 $numero=$_POST["numero_camion"];

 

 include("conect.php"); 
 
 $cadenaInserta="insert into camion (numero)".
				"values('$numero')"; 
						
				mysqli_query($conexion,$cadenaInserta)
				or die("Error al insertar el numero del camion.");
				header("Location: agregarCamion.php"); 
 
 ?>
 