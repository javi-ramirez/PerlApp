<?php
        $conexion = mysqli_connect('localhost','root','root','lavivesh_perlapp');

        // Check connection
        if ($conexion->connect_error) 
        {
            die('Connection failed: ' . $conexion->connect_error);
        } 
        else
        {
          echo 'Connected successfull';
        }

        $nombrePHP =$_POST['nombreJS'];
        $uidPHP =$_POST['uidJS'];
        $respuesta=array();
        $respuesta[]
                $consulta = "SELECT max(detalle.iddetalle), chofer.nombre_chofer, ruta.nombre_ruta from detalle INNER JOIN chofer on chofer.idchofer=detalle.fk_idchofer INNER JOIN ruta on ruta.idruta=detalle.fk_idruta WHERE idchofer='$uidJS' and detalle.hora_fin='0000-00-00 00:00:00";

        $sql = 'INSERT INTO chofer VALUES ("'.$uidPHP.'", "'.$nombrePHP.'")';
        
        if (mysqli_query($conexion, $sql)) 
        {
            echo 'Insersión chofer correcta';
        } 
        else 
        {
            echo 'Error: ' . $sql . '<br>' . mysqli_error($conexion);
        }
        mysqli_close($conexion);
 ?>