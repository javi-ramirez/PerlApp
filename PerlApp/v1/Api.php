<?php 
 
	//getting the dboperation class
	require_once '../includes/DbOperation.php';
 
	//function validating all the paramters are available
	//we will pass the required parameters to this function 
	function isTheseParametersAvailable($params){
		//assuming all parameters are available 
		$available = true; 
		$missingparams = ""; 
		
		foreach($params as $param){
			if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
				$available = false; 
				$missingparams = $missingparams . ", " . $param; 
			}
		}
		
		//if parameters are missing 
		if(!$available){
			$response = array(); 
			$response['error'] = true; 
			$response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
			
			//displaying error
			echo json_encode($response);
			
			//stopping further execution
			die();
		}
	}
	
	//an array to display response
	$response = array();
	
	//if it is an api call 
	//that means a get parameter named api call is set in the URL 
	//and with this parameter we are concluding that it is an api call
	if(isset($_GET['apicall']))
	{
		
		switch($_GET['apicall'])
		{

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////CRUD CAMION///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			//the CREATE operation
			//if the api call value is 'createusuario'
			//we will create a record in the database
			case 'createcamion':
				//first check the parameters required for this request are available or not 
				isTheseParametersAvailable(array('numero'));
				
				//creating a new dboperation object
				$db = new DbOperation();
				
				//creating a new record in the database
				$result = $db->createCamion(
					$_POST['numero']
				);
				
 
				//if the record is created adding success to response
				if($result){
					//record is created means there is no error
					$response['error'] = false; 
 
					//in message we have a success message
					$response['message'] = 'Camion agregado correctamente';
 
					//and we are getting all the usuario from the database in the response
					$response['camion'] = $db->getCamion();
				}else{
 
					//if record is not added that means there is an error 
					$response['error'] = true; 
 
					//and we have the error message
					$response['message'] = 'Se produjo un error, por favor intente nuevamente';
				}
				
			break; 
			
			//the READ operation
			//if the call is getheroes
			case 'getcamion':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Lista de camiones cargada correctamente';
				$response['camion'] = $db->getCamion();
			break; 
			
			
			//the UPDATE operation
			case 'updatecamion':
				isTheseParametersAvailable(array('idcamion','numero'));
				$db = new DbOperation();
				$result = $db->updateCamion(
					$_POST['idcamion'],
					$_POST['numero']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Camion actualizado correctamente';
					$response['camion'] = $db->getCamion();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Se produjo un error, por favor intente nuevamente';
				}
			break; 
			
			//the delete operation
			case 'deletecamion':
 
				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['idcamion'])){
					$db = new DbOperation();
					if($db->deleteCamion($_GET['idcamion'])){
						$response['error'] = false; 
						$response['message'] = 'Camion eliminado correctamente';
						$response['camion'] = $db->getCamion();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Se produjo un error, por favor intente nuevamente';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nada que eliminar, proporcione una identificación por favor';
				}
			break;  

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////CRUD CHOFER///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			//the CREATE operation
			//if the api call value is 'createusuario'
			//we will create a record in the database
			case 'createchofer':
				//first check the parameters required for this request are available or not 
				isTheseParametersAvailable(array('nombre_chofer', 'correo'));
				
				//creating a new dboperation object
				$db = new DbOperation();
				
				//creating a new record in the database
				$result = $db->createChofer(
					$_POST['nombre_chofer'],
					$_POST['correo']
				);
 
				//if the record is created adding success to response
				if($result){
					//record is created means there is no error
					$response['error'] = false; 
 
					//in message we have a success message
					$response['message'] = 'Chofer agregado correctamente';
 
					//and we are getting all the procesado from the database in the response
					$response['chofer'] = $db->getChofer();
				}else{
 
					//if record is not added that means there is an error 
					$response['error'] = true; 
 
					//and we have the error message
					$response['message'] = 'Se produjo un error, por favor intente nuevamente';
				}
				
			break;

			//the READ operation
			//if the call is getheroes
			case 'getchofer':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Lista de choferes cargada correctamente';
				$response['chofer'] = $db->getChofer();
			break; 

			//the UPDATE operation
			case 'updatechofer':
				isTheseParametersAvailable(array('idchofer','nombre_chofer', 'correo'));
				$db = new DbOperation();
				$result = $db->updateChofer(
					$_POST['idchofer'],
					$_POST['nombre_chofer'],
					$_POST['correo']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Chofer actualizado correctamente';
					$response['chofer'] = $_POST['idchofer'];
					$response['chofer'] = $db->getChofer();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Se produjo un error, por favor intente nuevamente';
				}
			break; 

			//the delete operation
			case 'deletechofer':
 
				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['idchofer'])){
					$db = new DbOperation();
					if($db->deleteChofer($_GET['idchofer'])){
						$response['error'] = false; 
						$response['message'] = 'Chofer eliminado correctamente';
						$response['chofer'] = $db->getChofer();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Se produjo un error, por favor intente nuevamente';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nada que eliminar, proporcione una identificación por favor';
				}
			break;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////CRUD COMENTARIO///////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			//the CREATE operation
			//if the api call value is 'createusuario'
			//we will create a record in the database
			case 'createcomentario':
				//first check the parameters required for this request are available or not 
				isTheseParametersAvailable(array('creador', 'comentario', 'fecha_hora', 'fk_idcamion'));
				
				//creating a new dboperation object
				$db = new DbOperation();
				
				//creating a new record in the database
				$result = $db->createComentario(
					$_POST['creador'],
					$_POST['comentario'],
					$_POST['fecha_hora'],
					$_POST['fk_idcamion']
				);
 
				//if the record is created adding success to response
				if($result){
					//record is created means there is no error
					$response['error'] = false; 
 
					//in message we have a success message
					$response['message'] = 'Comentario agregado correctamente';
 
					//and we are getting all the procesado from the database in the response
					$response['comentario'] = $db->getComentario();
				}else{
 
					//if record is not added that means there is an error 
					$response['error'] = true; 
 
					//and we have the error message
					$response['message'] = 'Se produjo un error, por favor intente nuevamente';
				}
				
			break;

			//the READ operation
			//if the call is getheroes
			case 'getcomentario':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Lista de comentarios cargada correctamente';
				$response['comentario'] = $db->getComentario();
			break; 

			//the UPDATE operation
			case 'updatecomentario':
				isTheseParametersAvailable(array('idcomentario','creador', 'comentario', 'fecha_hora', 'fk_idcamion'));
				$db = new DbOperation();
				$result = $db->updateComentario(
					$_POST['idcomentario'],
					$_POST['creador'],
					$_POST['comentario'],
					$_POST['fecha_hora'],
					$_POST['fk_idcamion']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Comentario actualizado correctamente';
					$response['comentario'] = $_POST['idcomentario'];
					$response['comentario'] = $db->getComentario();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Se produjo un error, por favor intente nuevamente';
				}
			break; 

			//the delete operation
			case 'deletecomentario':
 
				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['idcomentario'])){
					$db = new DbOperation();
					if($db->deleteComentario($_GET['idcomentario'])){
						$response['error'] = false; 
						$response['message'] = 'Comentario eliminado correctamente';
						$response['comentario'] = $db->getComentario();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Se produjo un error, por favor intente nuevamente';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nada que eliminar, proporcione una identificación por favor';
				}
			break;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////CRUD DETALLE /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			//the CREATE operation
			//if the api call value is 'createusuario'
			//we will create a record in the database
			case 'createdetalle':
				//first check the parameters required for this request are available or not 
				isTheseParametersAvailable(array('hora_inicio', 'hora_fin', 'fk_idchofer', 'fk_idruta', 'fk_idcamion'));
				
				//creating a new dboperation object
				$db = new DbOperation();
				
				//creating a new record in the database
				$result = $db->createDetalle(
					$_POST['hora_inicio'],
					$_POST['hora_fin'],
					$_POST['fk_idchofer'],
					$_POST['fk_idruta'],
					$_POST['fk_idcamion']
				);
 
				//if the record is created adding success to response
				if($result){
					//record is created means there is no error
					$response['error'] = false; 
 
					//in message we have a success message
					$response['message'] = 'Detalle agregado correctamente';
 
					//and we are getting all the procesado from the database in the response
					$response['detalle'] = $db->getDetalle();
				}else{
 
					//if record is not added that means there is an error 
					$response['error'] = true; 
 
					//and we have the error message
					$response['message'] = 'Se produjo un error, por favor intente nuevamente';
				}
				
			break;

			//the READ operation
			//if the call is getheroes
			case 'getdetalle':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Lista de detalles cargada correctamente';
				$response['detalle'] = $db->getDetalle();
			break; 

			//the UPDATE operation
			case 'updatedetalle':
				isTheseParametersAvailable(array('iddetalle','hora_inicio', 'hora_fin', 'fk_idchofer', 'fk_idruta', 'fk_idcamion'));
				$db = new DbOperation();
				$result = $db->updateDetalle(
					$_POST['iddetalle'],
					$_POST['hora_inicio'],
					$_POST['hora_fin'],
					$_POST['fk_idchofer'],
					$_POST['fk_idruta'],
					$_POST['fk_idcamion']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Detalle actualizado correctamente';
					$response['detalle'] = $_POST['iddetalle'];
					$response['detalle'] = $db->getDetalle();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Se produjo un error, por favor intente nuevamente';
				}
			break; 

			//the delete operation
			case 'deletedetalle':
 
				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['iddetalle'])){
					$db = new DbOperation();
					if($db->deleteDetalle($_GET['iddetalle'])){
						$response['error'] = false; 
						$response['message'] = 'Detalle eliminado correctamente';
						$response['detalle'] = $db->getDetalle();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Se produjo un error, por favor intente nuevamente';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nada que eliminar, proporcione una identificación por favor';
				}
			break;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////CRUD RUTA ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			//the CREATE operation
			//if the api call value is 'createusuario'
			//we will create a record in the database
			case 'createruta':
				//first check the parameters required for this request are available or not 
				isTheseParametersAvailable(array('nombre_ruta'));
				
				//creating a new dboperation object
				$db = new DbOperation();
				
				//creating a new record in the database
				$result = $db->createRuta(
					$_POST['nombre_ruta']
				);
				
 
				//if the record is created adding success to response
				if($result){
					//record is created means there is no error
					$response['error'] = false; 
 
					//in message we have a success message
					$response['message'] = 'Ruta agregada correctamente';
 
					//and we are getting all the usuario from the database in the response
					$response['ruta'] = $db->getRuta();
				}else{
 
					//if record is not added that means there is an error 
					$response['error'] = true; 
 
					//and we have the error message
					$response['message'] = 'Se produjo un error, por favor intente nuevamente';
				}
				
			break; 
			
			//the READ operation
			//if the call is getheroes
			case 'getruta':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Lista de rutas cargada correctamente';
				$response['ruta'] = $db->getRuta();
			break; 
			
			
			//the UPDATE operation
			case 'updateruta':
				isTheseParametersAvailable(array('idruta','nombre_ruta'));
				$db = new DbOperation();
				$result = $db->updateRuta(
					$_POST['idruta'],
					$_POST['nombre_ruta']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Ruta actualizada correctamente';
					$response['ruta'] = $db->getRuta();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Se produjo un error, por favor intente nuevamente';
				}
			break; 
			
			//the delete operation
			case 'deleteruta':
 
				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['idruta'])){
					$db = new DbOperation();
					if($db->deleteRuta($_GET['idruta'])){
						$response['error'] = false; 
						$response['message'] = 'Ruta eliminada correctamente';
						$response['ruta'] = $db->getRuta();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Se produjo un error, por favor intente nuevamente';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nada que eliminar, proporcione una identificación por favor';
				}
			break;  

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////EJEMPLO DE LOGIN (ACTUALMENTE NO SE NECESITA) ////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			/*
			//the login operation
			case 'loginusuario':
 				isTheseParametersAvailable(array('correoE','contra'));
				$db = new DbOperation();
				$result = $db->loginUsuario(
					$_POST['correoE'],
					$_POST['contra']
				);

				if($result){
					$response['error'] = false; 
					$response['message'] = 'Sesión iniciada correctamente';
					$response['usuario'] = true;
				}else{
					$response['error'] = true; 
					$response['message'] = 'Usuario o contraseña incorrectos';
				}

			break; */
		}
		
	}else{
		//if it is not api call 
		//pushing appropriate values to response array 
		$response['error'] = true; 
		$response['message'] = 'Invalid API Call';
	}
	
	//displaying the response in json structure 
	echo json_encode($response);
?>
