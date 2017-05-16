    <?php
    session_start();
    require_once("assets/includes/connection.php");
    $_SESSION["prueba"]= "prueba";
    if(isset($_SESSION['nick'])){

        echo '<script type="text/javascript"> 
        window.location="index.php"; 
    </script>'; 
}
?>
<?php
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
       $_SESSION["id_usr"] = $row[0];
       echo '<script type="text/javascript"> 
       window.location="index.php?id='. $user. '"; 
   </script>';
} else {

 $error ="Usuario o contraseña invalida!";

}
}
?>


<!DOCTYPE html>
<!--
BeyondAdmin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 1.5.0
Purchase: https://wrapbootstrap.com/theme/beyondadmin-adminapp-angularjs-mvc-WB06R48S4
-->

<html xmlns="http://www.w3.org/1999/xhtml">
<!--Head-->
<head>

    <meta charset="utf-8" />
    <title>Login MIP</title>

    <meta name="description" content="login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <!--Basic Styles-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />

    <!--Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">

    <!--Beyond styles-->
    <link id="beyond-link" href="assets/css/beyond.min.css" rel="stylesheet" />
    <link href="assets/css/demo.min.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />

    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="assets/js/skins.min.js"></script>
    <style type="text/css">
        .fondo{background-image: url("assets/img/portada-mip.jpg");}
    </style>
</head>
<!--Head Ends-->
<!--Body-->
<body class="">
    <div class="login-container animated fadeInDown">
        <div class="loginform">
            <center><img style="width:35px;" src="assets/img/logo2.png" alt="" /><br><b> MIP </b>Project
                <br>
                <br>
            </div>
            <div class="tabbable">
                <ul class="nav nav-tabs nav-justified" id="myTab5">
                    <li class="active">
                        <a data-toggle="tab" href="#log_in">
                            Login
                        </a>
                    </li>
                    <li class="tab-red">
                        <a data-toggle="tab" href="#regtr">
                            Restablecer
                        </a>
                    </li>

                </ul>

                <div class="tab-content loginbox bg-white">
                    <div id="log_in" class="tab-pane in active ">

                        <div class="loginbox-title">Iniciar sesión</div>

                        <div class="loginbox-social"></div>
                        <div class="loginbox-or">
                            <div class="or-line"></div>
                        </div>
                        <form name="loginform"  action="login.php" method="POST">
                            <div class="loginbox-textbox">
                                <input type="text" name="nom" class="form-control" placeholder="Usuario" required/>
                            </div>
                            <div class="loginbox-textbox">
                                <input type="password" name="pass" class="form-control" placeholder="Password" required/>
                            </div>

                            <div class="loginbox-submit">
                                <input type="submit" name="ingresar" class="btn btn-primary btn-block" value="Acceder">
                            </div>
                        </form>                   
                    </div>

                    <div id="regtr" class="tab-pane">
                        <div class="loginbox-social"></div>
                        <div class="loginbox-signup">
                            <i class="help-block">Para comenzar, ingrese su correo corporativo</i>
                        </div> 
                        <form name="loginform"  action="login.php" method="POST">
                            <div class="loginbox-textbox">
                                <input type="text" id="e_mail" class="form-control" placeholder="Correo electrónico" required/>
                                
                            </div>
                            <div class="loginbox-submit">
                                <input type="submit" name="ingresar" class="btn btn-primary btn-block" value="Enviar">
                            </div>
                        </form>       
                    </div>
                </div>
                
            </div>
        </div>


    </div>


    <!--Basic Scripts-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>
    <!--Beyond Scripts-->
    <script src="assets/js/beyond.js"></script>
    <!-- toastr.js para notificaciones -->
    <script src="assets/js/toastr/toastr.js"></script>
    <script>

    	function log_in(nom, pass) {
    		var param = {
    			"nom": nom
    			, "pas": pas
    		};
    		$.ajax({
    			data: param
    			, url: 'index_crud.php'
    			, type: 'post'
    			, beforeSend: function () {
    				Notify('Procesando...', 'bottom-left', '5000', 'info', 'fa-clock-o', false);
    			}, success: function (info) {
    				// Notify('Registro ingresado correctamente.', 'bottom-left', '5000', 'success', 'fa-check', true);
    				var json_info = JSON.parse( info );
    				console.log(info);
    				$('#mod_crear').modal('hide');
    				
    			}
    		});
    	}
    </script>

</body>
    <!--Body Ends-->
</html>
