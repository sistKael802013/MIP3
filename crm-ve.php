<?php include("intro.php"); ?>
<?php require_once("assets/includes/connection.php");?>
<?php 
session_start();
$mflot="display: block;"; 
$idempresa = $_GET["id"];      
$id_user = $_SESSION["id_usr"];
$_SESSION["idempresa"] = $idempresa;

   //Ingresar una empresa a la BD
if (isset($_POST["submit1"])){
    $idempresa= $_POST["idempresa"];
    $nomempresa=$_POST["nomempresa"];
    $direccion=$_POST["direccion"];
    $telefono= $_POST["telefono"];
    $email=$_POST["email"];
    $ciudad= $_POST["ciudad"];
    $dpto = $_POST["dpto"];
    $sector=$_POST["sector"];
    $fuente=$_POST["fuente"];
    $info= $_POST["info"];
    $estado="pcliente";
    $switch="on";
    $sql = "INSERT INTO `crm_empresas` (idempresa ,nomempresa, direccion ,telefono ,email, ciudad, dpto, sector, fuente, info, estado, switch) " .
    "VALUES ('$idempresa','$nomempresa', '$direccion', '$telefono', '$email', '$ciudad', '$dpto', '$sector', '$fuente', '$info', '$estado', '$switch')";
    if ($conn->query($sql) === TRUE) {
        $exito=on;
    }  else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} 

//imprimir empleado
$variable ="SELECT * FROM  `crm_empresas` WHERE  id_emp = $idempresa";
$result = $conn->query($variable);
$row = mysqli_fetch_row($result);
$numrow = mysqli_num_rows($result);

if ($row[14]== "Activo") {
    $label="blue";
} else{

    $label = "red";
} 

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>MIP: Vista Empresa </title>
    <meta name="description" content="Dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <!--Basic Styles-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/weather-icons.min.css" rel="stylesheet" />
    <!--Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <!--Beyond styles-->
    <link id="beyond-link" href="assets/css/beyond.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/demo.min.css" rel="stylesheet"/>
    <link href="assets/css/typicons.min.css" rel="stylesheet"/>
    <link href="assets/css/animate.min.css" rel="stylesheet"/>
    <link id="skin-link" href="" rel="stylesheet" type="text/css"/>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!--Page Related styles-->
    <link href="assets/css/dataTables.bootstrap.css" rel="stylesheet" />
    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="assets/js/skins.min.js"></script>
    <link href="assets/css/custom.css" rel="stylesheet"/> 
</head>

<body>
    <?php
	    include("header.php");
	    include("colizq.php");
    ?>
    <!-- Page Content -->
    <div class="page-content">
        <!-- Page Breadcrumb -->
        <div class="page-breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="#">Home</a>
                </li>
                <li class="active">
                    CRM
                </li>
            </ul>
        </div>
        <div class="page-header position-relative">
            <div class="header-title">
                <h1>
                    Ver Posible Cliente
                </h1>
            </div>
            <div class="header-buttons">
                <a class="sidebar-toggler" href="#">
                    <i class="fa fa-arrows-h"></i>
                </a>
                <a class="refresh" id="refresh-toggler" href="">
                    <i class="glyphicon glyphicon-refresh"></i>
                </a>
                <a class="fullscreen" id="fullscreen-toggler" href="#">
                    <i class="glyphicon glyphicon-fullscreen"></i>
                </a>
            </div>
        </div>
        <div class="page-body">
            <?php echo $anuncio?>
            <div class="well with-header  with-footer">
                <div class="header bg-blue">
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModa2"><i class="fa fa-cogs"></i> Nuevo Posible Cliente</button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal1"><i class="fa fa-calculator"></i> Editar </button>
                </div>
                <br>
                <br>
                <div style="border 1px #444;">
                    <div class="profile-header row">
                        <div class="col-lg-12 col-md-12 col-sm-12 veremp">
                            <table class="table table-bordered">
                                <tr>
                                    <th>NIT:</th>
                                    <td>
                                        <?php echo $row[1];?>
                                    </td>
                                    <th>Nombre:</th>
                                    <td>
                                        <?php echo $row[2];?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Direccion:</th>
                                    <td colspan="3">
                                        <?php echo $row[3];?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Telefono1:</th>
                                    <td>
                                        <?php echo $row[4];?>
                                    </td>
                                    <th>Telefono 2:</th>
                                    <td>
                                        <?php echo $row[15];?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ciudad:</th>
                                    <td>
                                        <?php echo $row[7];?>
                                    </td>
                                    <th>Departamento:</th>
                                    <td>
                                        <?php echo $row[8];?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Sector:</th>
                                    <td>
                                        <?php echo $row[10];?>
                                    </td>
                                    <th>Fuente:</th>
                                    <td>
                                        <?php echo $row[11];?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                <br>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="panel-group accordion" id="accordions">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordions" href="#collapseOnes">
                                        <i class="fa-fw fa fa-user"></i> Contactos
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOnes" class="panel-collapse collapse in">
                                <div class="panel-body border-red">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#mod_n_cont"><i class="fa fa-user-plus"></i> Ingresar Nuevo Contacto</button>
                                        <br>
                                    </div>
                                    <hr class="wide">
                                    <!-- TABLA DE CONTACTOS -->
                                    <section id="tbl_contact"></section>
                                    <!-- TABLA DE CONTACTOS -->
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordions" href="#collapseTwos">
                                        <i class="fa-fw fa fa-check"></i>Oportunidades
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwos" class="panel-collapse collapse">
                                <div class="panel-body border-red">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#mod_crear_opor"><i class="fa fa-plus"></i> Agregar oportunidad</button>
                                        <!-- <button type="button" class="btn btn-default"><i class="fa fa-cogs"></i> Settings</button> -->
                                    </div>
                                    <hr class="wide">
                                    <!-- TABLA DE OPORTUNIDADES -->
                                    <section id="tbl_oport"></section>
                                    <!-- TABLA DE OPORTUNIDADES -->
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordions" href="#collapseFive">
                                        <i class="fa-fw fa fa-bookmark"></i>Anotaciones
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse">
                                <div class="panel-body border-gold">
                                    <h2><i class="fa fa-ban"></i>Función no disponible.</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="btn-group">
                    <button type="button" class="btn btn-labeled btn-blue" data-toggle="modal" data-target="#myModal1"><i class="btn-label fa fa-plus"></i>Adicionar un elemento</button>
                </div>
                <br>  
                <!-- MODAL CREAR CONTACTO -->
                <div class="modal fade" id="mod_n_cont" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Ingresar Información Contacto</h4>
                            </div>
                            <div class="modal-body">
                                <div id="registration-form">
                                    <form action=# method="post" role="form">
                                        <div class="row">
                                            <div class="form-title" style="padding: 0 23px;">Información Personal</div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <span class="input-icon icon-right">
                                                        <select id="saludo" name="saludo">
                                                            <option value="Sr.">Señor.</option>
                                                            <option value="Sra.">Señora.</option>
                                                            <option value="Ing.">Ingeniero</option>
                                                            <option value="Prof.">Profesor</option>
                                                            <option value="Dr.">Doctor</option>
                                                        </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="form-group">
                                                    <span class="input-icon icon-right">
                                                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required>
                                                        <i class="fa fa-map-marker"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <span class="input-icon icon-right">
                                                        <input type="text" id="cargo" name="cargo" class="form-control" placeholder="Cargo" required>
                                                        <i class="fa fa-map-marker"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <span class="input-icon icon-right">
                                                        <input type="tel" id="tel" name="tel" class="form-control" placeholder="Telefono" required>
                                                        <i class="fa fa-newspaper-o"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <span class="input-icon icon-right">
                                                        <input type="tel" id="cel" name="cel" class="form-control" placeholder="Celular" required>
                                                        <i class="fa fa-map-marker"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <span class="input-icon icon-right">
                                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                                                        <i class="fa fa-newspaper-o"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <span class="input-icon icon-right">
                                                        <input type="email" id="email2" name="email2" class="form-control" placeholder="Email alternativo" required>
                                                        <i class="fa fa-map-marker"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <p>Fecha Cumpleaños</p>
                                                <div class="input-group">
                                                    <input class="form-control date-picker" name="f_nac" id="f_nac" type="text" data-date-format="dd-mm-yyyy">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                        <input type="button" href="javascript:;" onclick="guardar_cont($('#saludo').val(), $('#nombre').val(), $('#cargo').val(), $('#tel').val(), $('#cel').val(), $('#email').val(), $('#email2').val(), $('#f_nac').val());return false;" name="sut1" id="sut1" class="btn btn-blue" value="Ingresar" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL CREAR CONTACTO -->
                
                <!-- MODAL VER INFORMACION DEL CONTACTO -->
                <div class="modal fade" id="mod_ver_contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <b>Contacto: </b>
                                <h2 class="modal-title" id="vernombre"></h2>
                            </div>
                            <div class="modal-body">
                                <div id="registration-form">
                                    <div class="row-sm-6">
                                        <div>Cargo:</div>
                                        <h3 id="vercargo"></h3>
                                    </div>
                                    <div class="row-sm-6">
                                        <div>Teléfono:</div>
                                        <h3 id="vertel"></h3>
                                    </div>
                                    <div class="row-sm-6">
                                        <div>Celular:</div>
                                        <h3 id="vercel"></h3>
                                    </div>
                                    <div class="row-sm-6">
                                        <div>Correo:</div>
                                        <h3 id="veremail"></h3>
                                    </div>
                                    <div class="row-sm-6">
                                        <div>Correo alternativo:</div>
                                        <h3 id="veremail2"></h3>
                                    </div>
                                    <div class="row-sm-6">
                                        <div>Fecha de nacimiento:</div>
                                        <h3 id="verfnac"></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL VER INFORMACION DEL CONTACTO -->
                
                <!-- modal editar contactos -->
                <div class="modal fade" id="mod_editar_contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Editar Información Contacto</h4>
                            </div>
                            <div class="modal-body">
                                <div id="registration-form">
                                    <form action="" method="post" role="form">
                                        <div class="row">
                                            <div class="form-title" style="padding: 0 23px;">Información Personal</div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <span class="input-icon icon-right">
                                                        <input type="hidden" id="id_cont_ed" class="form-control">
                                                        <select id="saludo_ed" name="saludo">
                                                            <option value="Sr."></option>
                                                            <option value="Sr.">Señor.</option>
                                                            <option value="Sra.">Señora.</option>
                                                            <option value="Ing.">Ingeniero</option>
                                                            <option value="Prof.">Profesor</option>
                                                            <option value="Dr.">Doctor</option>
                                                        </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="form-group">
                                                    <span class="input-icon icon-right">
                                                        <input  type="text" id="nombre_ed" name="nombre" class="form-control" placeholder="Nombre" required>
                                                        <i class="fa fa-map-marker"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <span class="input-icon icon-right">
                                                        <input type="text" id="cargo_ed" name="cargo" class="form-control" placeholder="Cargo" required>
                                                        <i class="fa fa-map-marker"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <span class="input-icon icon-right">
                                                        <input type="tel" id="tel_ed" name="tel" class="form-control" placeholder="Telefono" required>
                                                        <i class="fa fa-newspaper-o"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <span class="input-icon icon-right">
                                                        <input type="tel" id="cel_ed" name="cel" class="form-control" placeholder="Celular" required>
                                                        <i class="fa fa-map-marker"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <span class="input-icon icon-right">
                                                        <input type="email" id="email_ed" name="email" class="form-control" placeholder="Email" required>
                                                        <i class="fa fa-newspaper-o"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <span class="input-icon icon-right">
                                                        <input type="email" id="email2_ed" name="email2" class="form-control" placeholder="Email alternativo" required>
                                                        <i class="fa fa-map-marker"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <p>Fecha Cumpleaños</p>
                                                <div class="input-group">
                                                    <input class="form-control date-picker" id="f_nac_ed" name="f_nac" type="text" data-date-format="dd-mm-yyyy">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                        <input type="button" href="javascript:;" onclick="editar_cont($('#id_cont_ed').val(), $('#saludo_ed').val(), $('#nombre_ed').val(), $('#cargo_ed').val(), $('#tel_ed').val(), $('#cel_ed').val(), $('#email_ed').val(), $('#email2_ed').val(), $('#f_nac_ed').val());return false;" name="sut1" id="sut1" class="btn btn-blue" value="Ingresar" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal fin -->
                <!-- INICIO MODAL ELIMINAR CONTACTO -->
                <div>
                    <form id="form_eliminar" action="" method="POST">
                        <div id="mod_el_contact" class="modal modal-message modal-warning fade" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <input type="hidden" id="id_cont_el" value="">
                                        <i class="fa fa-warning"></i>
                                    </div>
                                    <div class="modal-title">Confirmación</div>
                                    <div class="modal-body">Desea eliminar este contacto? <br><i>NOTA: esta acción no se puede deshacer.</i></div>
                                    <div class="modal-footer">
                                        <input type="button" href="javascript:;" onclick="eliminar_cont($('#id_cont_el').val());return false;" name="sut1" id="sut1" class="btn btn-blue" value="Si" /> 
                                        <button type="button" class="btn btn-default"  data-dismiss="modal">No</button>
                                    </div>
                                </div> 
                            </div> 
                        </div>    
                    </form>
                </div>
                <!-- FIN MODAL ELIMINAR CONTACTO -->
                <!-- MODAL CREAR OPORTUNIDAD -->
                <div class="modal fade" id="mod_crear_opor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <h4 class="modal-title" id="myModalLabel">Crear Oportunidad</h4> 
                            </div>
                            <div class="modal-body">
                                <div class="row-md-12">
                                    <div class="form-title">Nombre</div>
                                    <div class="form-group"> 
                                        <span class="input-icon icon-right">
                                            <input type="text" id="n_opor" name="n_opor" class="form-control" placeholder="" required>
                                            <i class="fa fa-align-justify"></i>
                                        </span> 
                                    </div>
                                </div>
                                <div class="row-md-12">
                                    <div class="col-md-6">
                                        <div class="form-title">Código</div>
                                        <div class="form-group"> 
                                            <span class="input-icon icon-right">
                                                <input type="text" id="c_opor" name="c_opor" class="form-control" placeholder="" required>
                                                <i class="fa fa-barcode"></i>
                                            </span> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-title">Contacto</div>
                                        <div class="form-group">
                                            <!-- vvvvvvvvvvv -->
                                            <?php 
                                                $sqla = "SELECT  * FROM crm_cont WHERE id_emp = $idempresa";
                                                $resultset1 = $conn->query($sqla);
                                                if ($resultset1->num_rows > 0) { 
                                            ?>
                                            <select id="sel_copor" style="width:100%;" sized="4">
                                                <?php while($row1 = $resultset1->fetch_assoc()){?>
                                                    <option value="<?php echo $row1["id_cont"]; ?>" /><?php echo $row1["nombre"]; ?>
                                                <?php } ?>
                                            </select>
                                            <?php }?>
                                            <!-- vvvvvvvvvvv -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row-md-12">
                                    <div class="col-md-6">
                                        <div class="form-title">Fase</div>
                                        <div class="form-group"> 
                                            <span class="input-icon icon-right">
                                                <select id="f_opor" name="f_opor" style="width:100%;">
                                                    <option value="1">Detectada</option>
                                                    <option value="2">Invitada a cotizar</option>
                                                    <option value="3">Propuesta presentada</option>
                                                    <option value="4">Cerrada ganada</option>
                                                    <option value="5">Cerrada perdida</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-title"> Probabilidad </div>
                                        <div class="form-group"> 
                                            <span class="input-icon icon-right">
                                                <input type="text" id="pro_opor" name="f_opor_ed" class="form-control" placeholder="" required>
                                                <i class="fa fa-signal"></i>
                                            </span> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row-md-12">
                                    <div class="col-md-6">
                                        <div class="form-title">Valor</div>
                                        <div class="form-group"> 
                                            <span class="input-icon icon-right">
                                                <input type="text" id="v_opor" name="v_opor" class="form-control" placeholder="" required>
                                                <i class="fa fa-usd"></i>
                                            </span> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-title"> Fecha de cierre </div>
                                        <div class="input-group">
                                            <input id="fc_opor" name="fc_opor" class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" required> <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                            </span> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row-md-12">
                                    <hr class="wide">
                                    <div class="form-group">
                                        <textarea id="cm_opor" name="cm_opor" class="form-control" rows="6" id="form-field-8" placeholder="Informacion adicional"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div></div>
                            <div class="modal-footer">
                                <input type="button" href="javascript:;" onclick="guardar_opor($('#n_opor').val(), $('#c_opor').val(), $('#sel_copor').val(), $('#v_opor').val(), $('#fc_opor').val(), $('#cm_opor').val(), $('#f_opor').val(), $('#pro_opor').val());return false;" name="sut1"  id="sut1" class="btn btn-blue" value="Ingresar"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL CREAR OPORTUNIDAD -->
                <!-- MODAL EDITAR OPORTUNIDAD -->
                <div class="modal fade" id="mod_editar_opor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <input type="hidden" id="id_opor_ed" value="">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <h4 class="modal-title" id="myModalLabel">Editar Oportunidad</h4> 
                            </div>
                            <div class="modal-body">
                                <div class="row-md-12">
                                        <div class="form-title">Nombre</div>
                                        <div class="form-group"> 
                                            <span class="input-icon icon-right">
                                                <input type="text" id="n_opor_ed" name="n_opor_ed" class="form-control" placeholder="" required>
                                                <i class="fa fa-align-justify"></i>
                                            </span> 
                                        </div>
                                </div>
                                <div class="row-md-12">
                                    <div class="col-md-6">
                                        <div class="form-title">Código</div>
                                        <div class="form-group"> 
                                            <span class="input-icon icon-right">
                                                <input type="text" id="c_opor_ed" name="c_opor_ed" class="form-control" placeholder="" required>
                                                <i class="fa fa-barcode"></i>
                                            </span> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-title">Contacto</div>
                                        <div class="form-group">
                                            <!-- vvvvvvvvvvv -->
                                            <?php 
                                                $sqla = "SELECT  * FROM crm_cont WHERE id_emp = $idempresa";
                                                $resultset1 = $conn->query($sqla);
                                                if ($resultset1->num_rows > 0) { 
                                            ?>
                                            <select id="sel_copor_ed" style="width:100%;" sized="4">
                                                <?php while($row1 = $resultset1->fetch_assoc()) {?>
                                                <option value="<?php echo $row1["id_cont"]; ?>" /><?php echo $row1["nombre"]; ?>
                                                <?php } ?>
                                            </select>
                                            <?php }?>
                                        <!-- vvvvvvvvvvv -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row-md-12">
                                    <div class="col-md-6">
                                        <div class="form-title">Fase</div>
                                        <div class="form-group"> 
                                            <span class="input-icon icon-right">
                                                <select id="f_opor_ed" name="f_opor_ed" style="width:100%;">
                                                    <option value="1">Detectada</option>
                                                    <option value="2">Invitada a cotizar</option>
                                                    <option value="3">Propuesta presentada</option>
                                                    <option value="4">Cerrada ganada</option>
                                                    <option value="5">Cerrada perdida</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-title"> Probabilidad </div>
                                        <div class="form-group"> 
                                            <span class="input-icon icon-right">
                                                <input type="text" id="pro_opor_ed" name="f_opor_ed" class="form-control" placeholder="" required>
                                                <i class="fa fa-signal"></i>
                                            </span> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row-md-12">
                                    <div class="col-md-6">
                                        <div class="form-title">Valor</div>
                                        <div class="form-group"> 
                                            <span class="input-icon icon-right">
                                                <input type="text" id="v_opor_ed" name="v_opor_ed" class="form-control" placeholder="" required>
                                                <i class="fa fa-usd"></i>
                                            </span> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-title"> Fecha de cierre </div>
                                        <div class="input-group">
                                            <input id="fc_opor_ed" name="fc_opor_ed" class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" required> 
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row-md-12">
                                    <hr class="wide">
                                    <div class="form-group">
                                        <textarea id="cm_opor_ed" name="cm_opor_ed" class="form-control" rows="6" id="form-field-8" placeholder="Informacion adicional"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" href="javascript:;" onclick="editar_opor($('#id_opor_ed').val(), $('#n_opor_ed').val(), $('#c_opor_ed').val(), $('#sel_copor_ed').val(), $('#v_opor_ed').val(), $('#fc_opor_ed').val(), $('#cm_opor_ed').val(), $('#f_opor_ed').val(), $('#pro_opor_ed').val());return false;" name="sut1"  id="sut1" class="btn btn-blue" value="Ingresar"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL EDITAR OPORTUNIDAD -->
                <!-- INICIO MODAL ELIMINAR CONTACTO -->
                <div>
                    <form id="form_eliminar" action="" method="POST">
                        <div id="mod_el_opor" class="modal modal-message modal-warning fade" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <input type="hidden" id="id_opor_el" value="">
                                        <i class="fa fa-warning"></i>
                                    </div>
                                    <div class="modal-title">Confirmación</div>

                                    <div class="modal-body">Desea eliminar este elemento?</div>
                                    <div class="modal-footer">
                                        <input type="button" href="javascript:;" onclick="eliminar_opor($('#id_opor_el').val());return false;" name="sut1" id="sut1" class="btn btn-blue" value="Si" /> 
                                        <button type="button" class="btn btn-default"  data-dismiss="modal">No</button>
                                    </div>
                                </div> 
                            </div> 
                        </div>    
                    </form>
                </div>
                <!-- FIN MODAL ELIMINAR CONTACTO -->
                <!-- EDITAR INFORMACION CLIENTE -->
		        <div class="modal fade" id="myModa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		            <div class="modal-dialog" role="document">
		                <div class="modal-content">
		                    <div class="modal-header">
		                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
		                        <h4 class="modal-title" id="myModalLabel">Crear Nuevo Cliente</h4> </div>
		                    <div class="modal-body">
		                        <div id="registration-form">
		                            <form action="crm-ve.php" method="post" role="form">
		                                <div class="form-title"> Información </div>
		                                <div class="col-sm-4">
		                                    <div class="form-group"> 
		                                        <span class="input-icon icon-right">
		                                            <input type="text" id="idempresa_ed" class="form-control" placeholder="NIT" required>
		                                            <i class="fa fa-newspaper-o"></i>
		                                        </span> 
		                                    </div>
		                                </div>
		                                <div class="col-sm-8">
		                                     <div class="form-group"> 
		                                        <span class="input-icon icon-right">
		                                            <input type="text" id="nomempres_ed" class="form-control" placeholder="Nombre Empresa" required>
		                                            <i class="fa fa-id-card-o"></i>
		                                        </span> 
		                                    </div>
		                                </div>
		                                <div class="col-sm-12">
		                                     <div class="form-group"> 
		                                        <span class="input-icon icon-right">
		                                            <input type="text" id="direccion_ed" class="form-control" placeholder="Dirección" required>
		                                            <i class="fa fa-map-marker"></i>
		                                        </span> 
		                                    </div>
		                                </div> 
		                                <div class="col-sm-6">
		                                     <div class="form-group"> 
		                                        <span class="input-icon icon-right">
		                                            <input type="tel" id="telefono_ed" class="form-control" placeholder="Teléfono" required>
		                                            <i class="fa fa-phone"></i>
		                                        </span> 
		                                    </div>
		                                </div> 
		                                <div class="col-sm-6">
		                                     <div class="form-group"> 
		                                        <span class="input-icon icon-right">
		                                            <input type="email" id="email_ed" class="form-control" placeholder="Email">
		                                            <i class="fa fa-envelope-o"></i>
		                                        </span> 
		                                    </div>
		                                </div> 
		                                <div class="col-sm-6">
		                                     <div class="form-group"> 
		                                        <span class="input-icon icon-right">
		                                            <input type="text" id="ciudad_ed" class="form-control" placeholder="Ciudad">
		                                            <i class="fa fa-map-marker"></i>
		                                        </span> 
		                                    </div>
		                                </div> <div class="col-sm-6">
		                                     <div class="form-group"> 
		                                        <span class="input-icon icon-right">
		                                            <input type="text" id="dpto_ed" class="form-control" placeholder="Departamento" required>
		                                            <i class="fa fa-map-marker"></i>
		                                        </span> 
		                                    </div>
		                                </div> 
		                                <hr>
		                                <div class="col-sm-6">
		                                    <div class="form-title">Sector</div>
	                                        <div class="form-group"> 
	                                            <select id="sector" name="sector" style="width:100%;" sized="4" required>
                                                    <option value="Metalmecanico" />Metalmecanico
                                                    <option value="Alimenticio" />Alimenticio
                                                    <option value="Quimico" />Quimico
                                                    <option value="Gobierno" />Gobierno
                                                    <option value="Servicios" />Servicios
                                                    <option value="Generacion Energia" />Generacion Energia
	                                            </select>   
	                                        </div>
		                                    </div>
		                                </div>
		                                <div class="col-sm-6">
		                                    <div class="form-title">Fuente</div>
	                                        <div class="form-group">
	                                            <select id="fuente" name="fuente" style="width:100%;" sized="4" required>
	                                                <option value="Aviso" />Aviso de Revista o prensa.
	                                                <option value="Referido Cliente" />Referido Cliente
	                                                <option value="Referido Empleado" />Referido Empleado
	                                                <option value="Relaciones Publicas" />Relaciones Publicas
	                                                <option value="Web" />Web
	                                            </select>   
	                                        </div>
		                                </div>
		                                <br>
		                                <hr>
		                            	<!-- <div> -->
		                                <button type="submit" name="submit1" class="btn btn-blue">Ingresar</button>
		                            	<!-- </div>  -->
		                            </form>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		        </div>
		        <!-- EDITAR INFORMACION CLIENTE -->
            </div>
        </div>
    </div>
</div>
<script src="assets/js/jquery-1.12.3.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>
<!--Beyond Scripts-->
<script src="assets/js/beyond.js"></script>
<!--Page Related Scripts-->
<script src="assets/js/datatable/jquery.dataTables.min.js"></script>
<script src="assets/js/datatable/dataTables.bootstrap.min.js"></script>
<script src="assets/js/datatable/ZeroClipboard.js"></script>
<script src="assets/js/datatable/dataTables.tableTools.min.js"></script>
<script src="assets/js/datatable/datatables-init.js"></script>
<script src="http://hayageek.github.io/jQuery-Upload-File/4.0.10/jquery.uploadfile.min.js"></script>
<!--Page Related Scripts-->
<!--Jquery Select2-->
<script src="assets/js/select2/select2.js"></script>
<!--Bootstrap Tags Input-->
<script src="assets/js/tagsinput/bootstrap-tagsinput.js"></script>
<!--Bootstrap Date Picker-->
<script src="assets/js/datetime/bootstrap-datepicker.js"></script>
<!--Bootstrap Time Picker-->
<script src="assets/js/datetime/bootstrap-timepicker.js"></script>
<!--Bootstrap Date Range Picker-->
<script src="assets/js/datetime/moment.js"></script>
<script src="assets/js/datetime/daterangepicker.js"></script>
<!--Jquery Autosize-->
<script src="assets/js/textarea/jquery.autosize.js"></script>
<!--Fuelux Spinbox-->
<script src="assets/js/fuelux/spinbox/fuelux.spinbox.min.js"></script>
<!--jQUery MiniColors-->
<script src="assets/js/colorpicker/jquery.minicolors.js"></script>
<!--jQUery Knob-->
<script src="assets/js/knob/jquery.knob.js"></script>
<!--noUiSlider-->
<script src="assets/js/slider/jquery.nouislider.js"></script>
<!--jQRangeSlider-->
<script src="assets/js/jquery-ui-1.10.4.custom.js"></script>
<script src="assets/js/slider/jQRangeSlider/jQAllRangeSliders-withRuler-min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- toastr.js para notificaciones -->
<script src="assets/js/toastr/toastr.js"></script>
<script>
    $(document).on("ready", function(){
        list_tbl_contact(); 
        list_tbl_oport();
        $('#example').DataTable( {
	        "order": [[ 1, "asc" ]]
	    } );
    });

    function list_tbl_oport(){
        var tabla = $.ajax({
            url: 'crm-ve_calltblopor.php'
            , dataType: 'text'
            , async: false
        }).responseText;
            document.getElementById("tbl_oport").innerHTML = tabla;
    }	

    function list_tbl_contact(){
        var tabla = $.ajax({
            url: 'crm-ve_calltbl.php'
            , dataType: 'text'
            , async: false
        }).responseText;
            document.getElementById("tbl_contact").innerHTML = tabla;
    }


    function ver_dat_cont(saludo, nombre, cargo, tel, cel, email, email2, f_nac) {
    	if (!nombre) {
    		document.getElementById("vernombre").innerHTML = "No hay datos.";
    	}else{
    		document.getElementById("vernombre").innerHTML = ""+saludo+" "+nombre+"";
    	}
    	if (!cargo) {
    		document.getElementById("vercargo").innerHTML = "No hay datos.";
    	}else{
    		document.getElementById("vercargo").innerHTML = ""+cargo+"";
    	}
    	if (!tel) {
    		document.getElementById("vertel").innerHTML = "No hay datos.";
    	}else{
    		document.getElementById("vertel").innerHTML = ""+tel+"";
    	}
    	if (!cel) {
    		document.getElementById("vercel").innerHTML = "No hay datos.";
    	}else{
    		document.getElementById("vercel").innerHTML = ""+cel+"";
    	}
    	if (!email) {
    		document.getElementById("veremail").innerHTML = "No hay datos.";
    	}else{
    		document.getElementById("veremail").innerHTML = ""+email+"";
    	}
    	if (!email2) {
    		document.getElementById("veremail2").innerHTML = "No hay datos.";
    	}else{
    		document.getElementById("veremail2").innerHTML = ""+email2+"";
    	}
    	if (!f_nac) {
    		document.getElementById("verfnac").innerHTML = "No hay datos.";
    	}else{
    		document.getElementById("verfnac").innerHTML = ""+f_nac+"";
    	}
       
    }

    //CONTACTOS
    function guardar_cont(saludo, nombre, cargo, tel, cel, email, email2, f_nac) {
    	// El id de la empresa se ingresa en el archivo 'crm-ve_crud.php' con $_SESSION[].
        var opcion = "guardar_cont";
        var param = {
            "saludo": saludo 
            , "nombre": nombre
            , "tel": tel
            , "cargo": cargo
            , "cel": cel
            , "email": email
            , "email2": email2
            , "f_nac": f_nac
            , "opcion": opcion
        };
        $.ajax({
            data: param
            , url: 'crm-ve_crud.php'
            , type: 'post'
            , beforeSend: function () {
                Notify('Procesando...', 'bottom-left', '5000', 'info', 'fa-clock-o', false);
            }, success: function (info) {
                Notify('Registro ingresado correctamente.', 'bottom-left', '5000', 'success', 'fa-check', true);
                $('#mod_n_cont').modal('hide');
                console.log(info);
                list_tbl_contact();

            }   
        });
    }

    function editar_cont(id_cont, saludo, nombre, cargo, tel, cel, email, email2, f_nac){
    	// El id de la empresa se ingresa en el archivo 'crm-ve_crud.php' con $_SESSION[].
        var opcion = "editar_cont";
        var param = {
           "saludo": saludo 
            , "id_cont": id_cont
            , "nombre": nombre
            , "tel": tel
            , "cargo": cargo
            , "cel": cel
            , "email": email
            , "email2": email2
            , "f_nac": f_nac
            , "opcion": opcion
        };
        $.ajax({
            data: param
            , url: 'crm-ve_crud.php'
            , type: 'post'
            , beforeSend: function () {
                Notify('Procesando...', 'bottom-left', '5000', 'info', 'fa-clock-o', false);
            }, success: function (info) {
                Notify('Registro actualizado correctamente.', 'bottom-left', '5000', 'success', 'fa-check', true);
                $('#mod_editar_contact').modal('hide');
                console.log(info);
                list_tbl_contact();
            }   
        });
    }

    function eliminar_cont(id_cont) {
        var opcion = "eliminar_cont";
        var param = {
            "id_cont": id_cont
            , "opcion": opcion
        };
        $.ajax({
            data: param
            , url: 'crm-ve_crud.php'
            , type: 'post'
            , beforeSend: function () {
                Notify('Procesando...', 'bottom-left', '5000', 'info', 'fa-clock-o', false);
            }, success: function (info) {
                Notify('Registro ingresado correctamente.', 'bottom-left', '5000', 'success', 'fa-check', true);
                $('#mod_el_contact').modal('hide');
                console.log(info);
                list_tbl_contact();

            }   
        });
    }
    //CONTACTOS

    // OPORTUNIDAD
    function guardar_opor(n_opor, c_opor, sel_copor, v_opor, fc_opor, cm_opor, f_opor, pro_opor) {
    	// El id de la empresa se ingresa en el archivo 'crm-ve_crud.php' con $_SESSION[].

    	var propietario = <?php echo $id_user; ?>;
        var opcion = "guardar_opor";
        var param = {
            "propietario": propietario 
            , "nombre": n_opor
            , "codigo": c_opor
            , "contacto": sel_copor
            , "valor": v_opor
            , "fecha_cierre": fc_opor
            , "info": cm_opor
            , "fase": f_opor
            , "probabilidad": pro_opor
            , "opcion": opcion
        };
        $.ajax({
            data: param
            , url: 'crm-ve_crud.php'
            , type: 'post'
            , beforeSend: function () {
                Notify('Procesando...', 'bottom-left', '5000', 'info', 'fa-clock-o', false);
            }, success: function (info) {
                Notify('Registro ingresado correctamente.', 'bottom-left', '5000', 'success', 'fa-check', true);
                $('#mod_n_cont').modal('hide');
                console.log(info);
                list_tbl_oport();

            }   
        });
    }


    function editar_opor(id_opor_ed, n_opor, c_opor, sel_copor, v_opor, fc_opor, cm_opor, f_opor, pro_opor) {
    	// El id de la empresa se ingresa en el archivo 'crm-ve_crud.php' con $_SESSION[].

    	var propietario = <?php echo $id_user; ?>;
        var opcion = "editar_opor";
        var param = {
        	"id": id_opor_ed
            ,"propietario": propietario 
            , "nombre": n_opor
            , "codigo": c_opor
            , "contacto": sel_copor
            , "valor": v_opor
            , "fecha_cierre": fc_opor
            , "info": cm_opor
            , "fase": f_opor
            , "probabilidad": pro_opor
            , "opcion": opcion
        };
        $.ajax({
            data: param
            , url: 'crm-ve_crud.php'
            , type: 'post'
            , beforeSend: function () {
                Notify('Procesando...', 'bottom-left', '5000', 'info', 'fa-clock-o', false);
            }, success: function (info) {
                Notify('Registro ingresado correctamente.', 'bottom-left', '5000', 'success', 'fa-check', true);
                $('#mod_crear_opor').modal('hide');
                console.log(info);
                list_tbl_oport();

            }   
        });
    }

    function eliminar_opor(id_opor_el) {
        var opcion = "eliminar_opor";
        var param = {
            "id": id_opor_el
            , "opcion": opcion
        };
        $.ajax({
            data: param
            , url: 'crm-ve_crud.php'
            , type: 'post'
            , beforeSend: function () {
                Notify('Procesando...', 'bottom-left', '5000', 'info', 'fa-clock-o', false);
            }, success: function (info) {
                Notify('Registro ingresado correctamente.', 'bottom-left', '5000', 'success', 'fa-check', true);
                $('#mod_editar_opor').modal('hide');
                console.log(info);
                list_tbl_oport();

            }   
        });
    }
    // !OPORTUNIDAD
    function ed_info_empr(repuesto, vr_unit, unidad) {
        var opcion = "n_rep";
        var param = {
            "repuesto": repuesto
            , "vr_unit": vr_unit
            , "unidad": unidad
            , "opcion": opcion
        };
        $.ajax({
            data: param
            , url: 'flot-vserv_crud.php'
            , type: 'post'
            , beforeSend: function () {
                Notify('Procesando...', 'bottom-left', '5000', 'info', 'fa-clock-o', false);
            }, success: function (info) {
                Notify('Registro ingresado correctamente.', 'bottom-left', '5000', 'success', 'fa-check', true);
                $('#mod_el_opor').modal('hide');
                console.log(info);
                
            }   
        });
    }

</script>
    

    <script>
        //--Jquery Select2--
        $("#e1").select2();
        $("#e3").select2();
        $("#e4").select2();
        $("#e2").select2({
            placeholder: "Select a State",
            allowClear: true
        });

       
        //--Bootstrap Date Picker--
        $('.date-picker').datepicker();
        // $('.input-group.date').datetimepicker({
        //     widgetPositioning:{
        //                         horizontal: 'auto',
        //                         vertical: 'bottom'
        //                     }
        // });
        
        //--Bootstrap Time Picker--
        $('#timepicker1').timepicker();

        //--Bootstrap Date Range Picker--
        $('#reservation').daterangepicker();

        //--JQuery Autosize--
        $('#textareaanimated').autosize({ append: "\n" });

        //--Fuelux Spinbox--
        $('.spinbox').spinbox();


        //--jQuery MiniColors--
        $('.colorpicker').each(function () {
            $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                defaultValue: $(this).attr('data-defaultValue') || '',
                inline: $(this).attr('data-inline') === 'true',
                letterCase: $(this).attr('data-letterCase') || 'lowercase',
                opacity: $(this).attr('data-opacity'),
                position: $(this).attr('data-position') || 'bottom left',
                change: function (hex, opacity) {
                    if (!hex) return;
                    if (opacity) hex += ', ' + opacity;
                    try {
                        console.log(hex);
                    } catch (e) { }
                },
                theme: 'bootstrap'
            });

        });


        //---Jquery Knob--
        $(".knob").knob();


        //---noUiSlider--
        $("#sample-minimal").noUiSlider({
            range: [0, 100],
            start: [20, 80],
            connect: true,
            serialization: {
                mark: ',',
                resolution: 0.1,
                to: [[$("#minimal-label1"), 'html'],
                      [$('#minimal-label2'), 'html']]
            }
        });

        $("#sample-onehandle").noUiSlider({
            range: [20, 100],
            start: 40,
            step: 20,
            handles: 1,
            connect: "lower",
            serialization: {
                to: [$("#low"), 'html']
            }
        });
        $("#sample-onehandle-upper").noUiSlider({
            range: [20, 100],
            start: 70,
            step: 20,
            handles: 1,
            connect: "upper",
            serialization: {
                to: [$("#low"), 'html']
            }
        });
        $('.slider').noUiSlider({
            range: [0, 255],
            start: 127,
            handles: 1,
            connect: "lower",
            orientation: "vertical",
            serialization: {
                resolution: 1
            }
            , slide: function () {

                var color = 'rgb(' + $("#red").val()
                     + ',' + $("#green").val()
                     + ',' + $("#blue").val()
                     + ')';

                $(".result").css({
                    background: color
                    , color: color
                });
            }
        });

        $(".sized-slider").noUiSlider({
            range: [0, 100],
            start: 50,
            handles: 1,
            connect: "lower",
            serialization: {
                to: [$("#low"), 'html']
            }
        });

        $(".colored-slider").noUiSlider({
            range: [0, 100],
            start: 30,
            handles: 1,
            connect: "lower",
            serialization: {
                to: [$("#low"), 'html']
            }
        });

        //--jQRangeSlider--
        $(".sized-rangeslider").rangeSlider();
        $(".colored-rangeslider").rangeSlider();
        $("#rangeslider").rangeSlider();
        $("#editrangeslider").editRangeSlider();
        $("#daterangeslider").dateRangeSlider();
        $("#noarrowsrangeslider").rangeSlider({ arrows: false });
        $("#boundsrangeslider").rangeSlider({ bounds: { min: 10, max: 90 } });
        $("#dvrangeslider").rangeSlider({ defaultValues: { min: 13, max: 66 } });
        $("#delayrangeslider").rangeSlider({ valueLabels: "change", delayOut: 4000 });
        $("#durationrangeslider").rangeSlider({ valueLabels: "change", durationIn: 1000, durationOut: 1000 });
        $("#disabledrangeslider").rangeSlider({ enabled: false });
        $("#steprangeslider").rangeSlider({ step: 10 });
        $("#labelsrangeslider").rangeSlider({ valueLabels: "hide" });
        $("#simlescalesrangeslider").rangeSlider({
            scales: [
            // Primary scale
            {
                first: function (val) { return val; },
                next: function (val) { return val + 10; },
                stop: function (val) { return false; },
                label: function (val) { return val; },
                format: function (tickContainer, tickStart, tickEnd) {
                    tickContainer.addClass("myCustomClass");
                }
            },
            // Secondary scale
            {
                first: function (val) { return val; },
                next: function (val) {
                    if (val % 10 === 9) {
                        return val + 2;
                    }
                    return val + 1;
                },
                stop: function (val) { return false; },
                label: function () { return null; }
            }]
        });
        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
        $("#dateRulersExample").dateRangeSlider({
            bounds: { min: new Date(2012, 0, 1), max: new Date(2012, 11, 31, 12, 59, 59) },
            defaultValues: { min: new Date(2012, 1, 10), max: new Date(2012, 4, 22) },
            scales: [{
                first: function (value) { return value; },
                end: function (value) { return value; },
                next: function (value) {
                    var next = new Date(value);
                    return new Date(next.setMonth(value.getMonth() + 1));
                },
                label: function (value) {
                    return months[value.getMonth()];
                },
                format: function (tickContainer, tickStart, tickEnd) {
                    tickContainer.addClass("myCustomClass");
                }
            }]
        });
    </script>

</body>
<!--  /Body -->
</html>
