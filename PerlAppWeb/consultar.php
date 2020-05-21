<?php
        $conexion = mysqli_connect('localhost','root','root','perlapp');

        // Check connection
        if ($conexion->connect_error)
        {
            die('Connection failed: ' . $conexion->connect_error);
        }
        else
        {
          echo 'Connected successfull';
        }
        $uidPHP =$_POST['uidJS'];

       $consultaRutaChoferCamion = 'SELECT u.nombre_chofer chofer, b.numero camion, c.nombre_ruta ruta FROM detalle ub INNER JOIN chofer u ON ub.fk_idchofer = u.idchofer INNER JOIN camion b ON ub.fk_idcamion = b.idcamion INNER JOIN ruta c ON ub.fk_idruta = c.idruta WHERE ub.idchofer = "$uidPHP"';
       $resultadoConsulta = mysqli_query($conexion, $consultaRutaChoferCamion) or die('erro de consulta');
       echo $resultadoConsulta;
        while($datos=mysql_fetch_array($resultadoConsulta))
        {
            $chofer = $datos[0];
            $camion = $datos[1];
            $ruta = $datos[2];
        }
        $array = array($chofer, $camion, $ruta);
        $json = json_encode($arr);
        echo $json;
        mysqli_close($conexion);
 ?>