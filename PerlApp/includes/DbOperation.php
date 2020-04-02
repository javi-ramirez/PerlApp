<?php
 
	class DbOperation
	{
	    //Database connection link
	    private $con;
	 
	    //Class constructor
	    function __construct()
	    {
	        //Getting the DbConnect.php file
	        require_once dirname(__FILE__) . '/DbConnect.php';
	 
	        //Creating a DbConnect object to connect to the database
	        $db = new DbConnect();
	 
	        //Initializing our connection link of this class
	        //by calling the method connect of DbConnect class
	        $this->con = $db->connect();
	    }
		
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////CRUD CAMION///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		/*
		* The create operation
		* When this method is called a new record is created in the database
		*/
		function createCamion($numero)
		{
			$stmt = $this->con->prepare("INSERT INTO camion (numero) VALUES ('$numero')");
			if($stmt->execute())
				return true; 
			return false; 
		}
	 
		/*
		* The read operation
		* When this method is called it is returning all the existing record of the database
		*/
		function getCamion()
		{
			$stmt = $this->con->prepare("SELECT idcamion, numero FROM camion");
			$stmt->execute();
			$stmt->bind_result($idcamion, $numero);
			
			$camion = array(); 
			
			while($stmt->fetch())
			{
				$datos  = array();
				$datos['idcamion'] = $idcamion; 
				$datos['numero'] = $numero; 

				array_push($camion, $datos); 
			}
			return $camion; 
		}
		
		/*
		* The update operation
		* When this method is called the record with the given id is updated with the new given values
		*/
		function updateCamion($idcamion, $numero)
		{
			$stmt = $this->con->prepare("UPDATE camion SET numero = '$numero' WHERE idcamion = '$idcamion'");
			if($stmt->execute())
				return true; 
			return false; 
		}
		
		
		/*
		* The delete operation
		* When this method is called record is deleted for the given id 
		*/
		function deleteCamion($idcamion)
		{
			$stmt = $this->con->prepare("DELETE FROM camion WHERE idcamion = $idcamion");
			if($stmt->execute())
				return true; 
			return false; 
		}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////CRUD CHOFER///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		/*
		* The create operation
		* When this method is called a new record is created in the database
		*/
		function createChofer($nombre_chofer, $correo)
		{

			$stmt = $this->con->prepare("INSERT INTO chofer VALUES (default,'$nombre_chofer', '$correo')");
			if($stmt->execute())
				return true; 
			return false; 
		}
	 
		/*
		* The read operation
		* When this method is called it is returning all the existing record of the database
		*/
		function getChofer()
		{
			$stmt = $this->con->prepare("SELECT idchofer, nombre_chofer, correo FROM chofer");
			$stmt->execute();
			$stmt->bind_result($idchofer, $nombre_chofer, $correo);

			$chofer = array(); 
			
			while($stmt->fetch())
			{
				$datos  = array();
				$datos['idchofer'] = $idchofer; 
				$datos['nombre_chofer'] = $nombre_chofer; 
				$datos['correo'] = $correo; 
				
				array_push($chofer, $datos); 
			}	
			return $chofer; 
		}
		
		/*
		* The update operation
		* When this method is called the record with the given id is updated with the new given values
		*/
		function updateChofer($idchofer,$nombre_chofer, $correo)
		{
			$stmt = $this->con->prepare("UPDATE chofer SET nombre_chofer = '$nombre_chofer', correo = '$correo' WHERE idchofer = '$idchofer'");
			if($stmt->execute())
				return true; 
			return false; 
		}
		
		
		/*
		* The delete operation
		* When this method is called record is deleted for the given id 
		*/
		function deleteChofer($idchofer)
		{
			$stmt = $this->con->prepare("DELETE FROM chofer WHERE idchofer = $idchofer");
			if($stmt->execute())
				return true; 
			return false; 
		}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////CRUD COMENTARIO///////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		/*
		* The create operation
		* When this method is called a new record is created in the database
		*/
		function createComentario($creador, $comentario, $fecha_hora, $fk_idcamion)
		{

			$stmt = $this->con->prepare("INSERT INTO comentario VALUES (default,'$creador', '$comentario', '$fecha_hora', '$fk_idcamion')");
			if($stmt->execute())
				return true; 
			return false; 
		}
	 
		/*
		* The read operation
		* When this method is called it is returning all the existing record of the database
		*/
		function getComentario()
		{
			$stmt = $this->con->prepare("SELECT idcomentario, creador, comentario, fecha_hora, fk_idcamion FROM comentario");
			$stmt->execute();
			$stmt->bind_result($idcomentario, $creador, $comentario, $fecha_hora, $fk_idcamion);

			$comentario1 = array(); 
			
			while($stmt->fetch())
			{
				$datos  = array();
				$datos['idcomentario'] = $idcomentario;
				$datos['creador'] = $creador; 
				$datos['comentario'] = $comentario;
				$datos['fecha_hora'] = $fecha_hora;
				$datos['fk_idcamion'] = $fk_idcamion; 
				
				array_push($comentario1, $datos); 
			}	
			return $comentario1; 
		}
		
		/*
		* The update operation
		* When this method is called the record with the given id is updated with the new given values
		*/
		function updateComentario($idcomentario,$creador, $comentario, $fecha_hora, $fk_idcamion)
		{
			$stmt = $this->con->prepare("UPDATE comentario SET creador = '$creador', comentario = '$comentario', fecha_hora = '$fecha_hora', fk_idcamion = '$fk_idcamion' WHERE idcomentario = '$idcomentario'");
			if($stmt->execute())
				return true; 
			return false; 
		}
		
		
		/*
		* The delete operation
		* When this method is called record is deleted for the given id 
		*/
		function deleteComentario($idcomentario)
		{
			$stmt = $this->con->prepare("DELETE FROM comentario WHERE idcomentario = $idcomentario");
			if($stmt->execute())
				return true; 
			return false; 
		}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////CRUD DETALLE /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		/*
		* The create operation
		* When this method is called a new record is created in the database
		*/
		function createDetalle($hora_inicio, $hora_fin, $fk_idchofer, $fk_idruta, $fk_idcamion)
		{

			$stmt = $this->con->prepare("INSERT INTO detalle VALUES (default,'$hora_inicio', '$hora_fin', '$fk_idchofer', '$fk_idruta','$fk_idcamion')");
			if($stmt->execute())
				return true; 
			return false; 
		}
	 
		/*
		* The read operation
		* When this method is called it is returning all the existing record of the database
		*/
		function getDetalle()
		{
			$stmt = $this->con->prepare("SELECT iddetalle, hora_inicio, hora_fin, fk_idchofer, fk_idruta, fk_idcamion FROM detalle");
			$stmt->execute();
			$stmt->bind_result($iddetalle, $hora_inicio, $hora_fin, $fk_idchofer, $fk_idruta, $fk_idcamion);

			$detalle = array(); 
			
			while($stmt->fetch())
			{
				$datos  = array();
				$datos['iddetalle'] = $iddetalle;
				$datos['hora_inicio'] = $hora_inicio; 
				$datos['hora_fin'] = $hora_fin;
				$datos['fk_idchofer'] = $fk_idchofer;
				$datos['fk_idruta'] = $fk_idruta;
				$datos['fk_idcamion'] = $fk_idcamion; 
				
				array_push($detalle, $datos); 
			}	
			return $detalle; 
		}
		
		/*
		* The update operation
		* When this method is called the record with the given id is updated with the new given values
		*/
		function updateDetalle($iddetalle,$hora_inicio, $hora_fin, $fk_idchofer, $fk_idruta, $fk_idcamion)
		{
			$stmt = $this->con->prepare("UPDATE detalle SET hora_inicio = '$hora_inicio', hora_fin = '$hora_fin', fk_idchofer = '$fk_idchofer', fk_idruta = '$fk_idruta', fk_idcamion = '$fk_idcamion' WHERE iddetalle = '$iddetalle'");
			if($stmt->execute())
				return true; 
			return false; 
		}
		
		
		/*
		* The delete operation
		* When this method is called record is deleted for the given id 
		*/
		function deleteDetalle($iddetalle)
		{
			$stmt = $this->con->prepare("DELETE FROM detalle WHERE iddetalle = $iddetalle");
			if($stmt->execute())
				return true; 
			return false; 
		}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////CRUD RUTA ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		/*
		* The create operation
		* When this method is called a new record is created in the database
		*/
		function createRuta($nombre_ruta)
		{
			$stmt = $this->con->prepare("INSERT INTO ruta (nombre_ruta) VALUES ('$nombre_ruta')");
			if($stmt->execute())
				return true; 
			return false; 
		}
	 
		/*
		* The read operation
		* When this method is called it is returning all the existing record of the database
		*/
		function getRuta()
		{
			$stmt = $this->con->prepare("SELECT idruta, nombre_ruta FROM ruta");
			$stmt->execute();
			$stmt->bind_result($idruta, $nombre_ruta);
			
			$ruta = array(); 
			
			while($stmt->fetch())
			{
				$datos  = array();
				$datos['idruta'] = $idruta; 
				$datos['nombre_ruta'] = $nombre_ruta; 

				array_push($ruta, $datos); 
			}
			return $ruta; 
		}
		
		/*
		* The update operation
		* When this method is called the record with the given id is updated with the new given values
		*/
		function updateRuta($idruta, $nombre_ruta)
		{
			$stmt = $this->con->prepare("UPDATE ruta SET nombre_ruta = '$nombre_ruta' WHERE idruta = '$idruta'");
			if($stmt->execute())
				return true; 
			return false; 
		}
		
		
		/*
		* The delete operation
		* When this method is called record is deleted for the given id 
		*/
		function deleteRuta($idruta)
		{
			$stmt = $this->con->prepare("DELETE FROM ruta WHERE idruta = $idruta");
			if($stmt->execute())
				return true; 
			return false; 
		}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////EJEMPLO DE LOGIN (ACTUALMENTE NO SE NECESITA) ////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		/*
		* The login operation
		* When this method is called record is login for the given correoE y contra 
		*/

		/*function loginUsuario($correoE,$contra){
			$stmt = $this->con->prepare("SELECT idUsuario, nombre, apellidoP, apellidoM, fechaNac, correoE, contra from usuario where correoE = '$correoE' and  contra ='$contra'");
			if($stmt->execute())
			$stmt->bind_result($idUsuario, $nombre, $apellidoP, $apellidoM, $fechaNac, $correoE, $contra);
			
			$usuario = array(); 
			
			while($stmt->fetch()){
				$persona  = array();
				$persona['idUsuario'] = $idUsuario; 
				$persona['nombre'] = $nombre; 
				$persona['apellidoP'] = $apellidoP; 
				$persona['apellidoM'] = $apellidoM; 
				$persona['fechaNac'] = $fechaNac;
				$persona['correoE'] = $correoE;
				$persona['contra'] = $contra; 
				
				array_push($usuario, $persona); 
			}
			
			return $usuario; 
		}*/
	}
?>
