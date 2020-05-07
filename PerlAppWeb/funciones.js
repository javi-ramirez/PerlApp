function registrar() 
{
	var email= document.getElementById('email').value;
	var contrasena= document.getElementById('contrasena').value;


	firebase.auth().createUserWithEmailAndPassword(email, contrasena).catch(function(error)
	 {
	  
	  var errorCode = error.code;
	  var errorMessage = error.message;

	 });


}