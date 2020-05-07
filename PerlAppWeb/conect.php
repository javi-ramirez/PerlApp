 <?php
 $usuariobd="root";
 $host="localhost";
 $clave="root";
 $basededatos="perlapp";

 
 
 $conexion=mysqli_connect($host,$usuariobd,$clave,$basededatos)
 or die ("No se pudo conectar al servidor.");
 ?>