<!DOCTYPE html>
<html>
  <head>
    <title>Agregar Usuario</title>
      
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.14.1/firebase-app.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.14.1/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.1/firebase-firestore.js"></script>
    <script>
      // Your web app's Firebase configuration
      var firebaseConfig = 
      {
        apiKey: "AIzaSyC7OGgyyFDYjGSpnGv5ZOED9lXwUV1IyEw",
        authDomain: "perlapp-25536.firebaseapp.com",
        databaseURL: "https://perlapp-25536.firebaseio.com",
        projectId: "perlapp-25536",
        storageBucket: "perlapp-25536.appspot.com",
        messagingSenderId: "655163858448",
        appId: "1:655163858448:web:f43565bca9fdb4d157f495",
        measurementId: "G-2S4TQVZXB4"
      };
      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);
      firebase.analytics();
    </script>
    <script src="JQuery.js"></script>
  </head>

  <body>
     <input id="nombre" type="text" placeholder="Ingresa tu nombre">
    <input id="email" type="email" placeholder="Ingresa tu email">
    <input id="contrasena" type="password" placeholder="Ingresa tu contrasena">
    <button onclick="registrar()">Enviar</button>
  </body>
</html>

<script type="text/javascript">
  function registrar() 
  {
    var email= document.getElementById('email').value;
    var contrasena= document.getElementById('contrasena').value;
    var nombreJS = document.getElementById('nombre').value;

    firebase.auth().createUserWithEmailAndPassword(email, contrasena).catch(function(error)
    {  
      var errorCode = error.code;
      var errorMessage = error.message;

    });
    
    var user = firebase.auth().currentUser;
    var name, email, photoUrl, uid, emailVerified;

    if (user != null) 
    {
      
      email = user.email;
      uidJS = user.uid;  
      // The user's ID, unique to the Firebase project. Do NOT use
      // this value to authenticate with your backend server, if
      // you have one. Use User.getToken() instead.
      //document.write(uid);
    $.ajax({
        type:"POST",
        url:"registrar.php, consultar.php",
        data:{nombreJS, uidJS},
        success:function(r){
          if(r==1){
            alert("agregado con exito");
          }else{
            
          }
        }
      });
    }
  }
</script>