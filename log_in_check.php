<?php 
require_once("assets/includes/connection.php");

 	$_SESSION["prueba"]= "prueba";

    if(isset($_SESSION['nick'])){
    
    echo '<script type="text/javascript"> 
    window.location="index.php"; 
    </script>';

    }

    if(isset($_POST["ingresar"])){
        $user=$_POST['nom'];
        $clave=$_POST['pass'];
        $variable = "SELECT * FROM  usuarios WHERE user= '".$user."' AND clave = '".$clave."'";
        $result = $conn->query($variable);
        $row = mysqli_fetch_row($result);
        $dbemail=$row[2];
        $dbclave=$row[3];
        
          if($user == $dbemail && $clave == $dbclave){
             $_SESSION["nombre"]= $row[1];
             $_SESSION["foto"]= $row[7];
             $_SESSION["email"]= $row[4];
             $_SESSION["nick"]= $user;
		     echo '<script type="text/javascript"> 
		       			window.location="index.php?id='. $user. '"; 
		       	   </script>';
       } else {

       $error ="Usuario o contraseña invalida!";

       }
   }


 ?>