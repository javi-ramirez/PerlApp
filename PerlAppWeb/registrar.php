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

        $nombrePHP =$_POST['nombreJS'];
        $uidPHP =$_POST['uidJS'];
        

        $sql = 'INSERT INTO chofer VALUES (default,"'.$uidPHP.'", "'.$nombrePHP.'")';
        
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