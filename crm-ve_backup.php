<?php include("intro.php"); ?>
<?php require_once("assets/includes/connection.php");?>
<?php 
    $mflot="display: block;"; 
    $idempresa = $_GET["id"];      

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
                    // ingresa un contacto a la bd 
                    if (isset($_POST["submit2"])){
                        $saludo= $_POST["saludo"];
                        $nombre=$_POST["nombre"];
                        $tel=$_POST["tel"];
                        $cargo= $_POST["cargo"];
                        $cel=$_POST["cel"];
                        $email= $_POST["email"];
                        $email2 = $_POST["email2"];
                        $f_nac=$_POST["f_nac"];
                        $fuente=$_POST["fuente"];
                        $id_emp= $idempresa;
                        $sql2 = "INSERT INTO `crm_cont` (saludo, nombre, tel, cargo, cel, email, email2, f_nac, id_emp) " .
                        "VALUES ('$saludo','$nombre', '$tel', '$cargo', '$cel', '$email', '$email2', '$f_nac', '$id_emp')";
                    if ($conn->query($sql2) === TRUE) {
                        $exito=on;
                    }  else {
                    echo "Error: " . $sql2 . "<br>" . $conn->error;
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
<!--
BeyondAdmin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 1.5.0
Purchase: https://wrapbootstrap.com/theme/beyondadmin-adminapp-angularjs-mvc-WB06R48S4
-->

<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>

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
    <link href="assets/css/demo.min.css" rel="stylesheet" />
    <link href="assets/css/typicons.min.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <!--Page Related styles-->
    <link href="assets/css/dataTables.bootstrap.css" rel="stylesheet" />

    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="assets/js/skins.min.js"></script>
    <link href="assets/css/custom.css" rel="stylesheet" />
</head>
<!-- /Head -->
<!-- Body -->
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
                        <li class="active">CRM</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                            Ver Posible Cliente
                        </h1>
                    </div>
                    <!--Header Buttons-->
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
                    <!--Header Buttons End-->
                </div>
                <!-- /Page Header -->
                <!-- inicio cuerpo -->
                <div class="page-body">
                    <!-- Nombre oportunidad -->
                                        
                            <?php echo $anuncio?>
                    <div class="well with-header  with-footer">
                                <div class="header bg-blue">
                                    <!-- Recursos Humanos/ Información Empleado -->
                                </div>
                                
                                <div class="btn-group">
                                    
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModa2"><i class="fa fa-cogs"></i> Nuevo Posible Cliente</button>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal1"><i class="fa fa-calculator"></i> Editar </button>
                                        <!-- <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Imprimir Tarea</button> -->
                                    </div>
                                    <div class="widget-buttons" style="float:right;">
                                                <div class="btn-group">
                                                    <!-- <a class="btn btn-<?php echo $label ?> btn-sm " href="javascript:void(0);"><?php echo $row[14];?></a> -->
                                                    <!-- <a class="btn btn-<?php echo $label ?> btn-sm dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-angle-down"></i></a> -->
                                                    <!-- <ul class="dropdown-menu dropdown-<?php echo $label ?> pull-left"> -->
                                                        <!-- <li>
                                                            <a href="javascript:void(0);">Activo</a>
                                                        </li> -->
                                                       <!--  <li>
                                                            <a href="javascript:void(0);">Inactivo</a>
                                                        </li>
                                                    </ul> -->
                                                </div>
                                            </div>
                                        <br><br>
                                        <!-- inicio caja foto y info     -->
                                        <div style="border 1px #444;">
                                        <div class="profile-header row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 veremp">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>NIT:</th>
                                                        <td><?php echo $row[1];?></td>
                                                   
                                                        <th>Nombre:</th>
                                                        <td><?php echo $row[2];?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Direccion:</th>
                                                        <td colspan="3"><?php echo $row[3];?></td>
                                                   
                                                        
                                                    </tr>
                                                    <tr>
                                                        <th>Telefono1:</th>
                                                        <td><?php echo $row[4];?></td>
                                                        <th>Telefono 2:</th>
                                                        <td><?php echo $row[15];?></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <th>Ciudad:</th>
                                                        <td><?php echo $row[7];?></td>
                                                    
                                                        <th>Departamento:</th>
                                                        <td><?php echo $row[8];?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sector:</th>
                                                        <td><?php echo $row[10];?></td>
                                                   
                                                        <th>Fuente:</th>
                                                        <td><?php echo $row[11];?></td>
                                                    </tr>
                                                    
                                                </table>
                                            </div>
                                        </div><br>
                                        <!-- fin caja perfil y foto -->
                                      
                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <!-- INICIO ACORDION -->
                                    <div class="panel-group accordion" id="accordions">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordions" href="#collapseOnes">
                                                        <i class="fa-fw fa fa-check"></i> Contactos
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOnes" class="panel-collapse collapse in">
                                                <div class="panel-body border-red">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModaliad"><i class="fa fa-user"></i> Ingresar Nuevo Contacto</button><br>
                                                    
                                                </div><br>
                                                <?php
                                                    $variablecert ="SELECT * FROM  `crm_cont` WHERE  id_emp = $idempresa";
                                                    $resultcert = $conn->query($variablecert);
                                                    // $rowind = mysqli_fetch_row($resultind);
                                                    if ($resultcert->num_rows > 0) {
                                                        
                                                ?>
                                                <table class="table table-striped table-bordered table-hover" style="margin-bottom:20px;">
                                                    <tr>
                                                        <th>Nombre:</th>
                                                        <th>Cargo</th>
                                                        <th>Telefono</th>
                                                        <th>Email</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                    <?php while($rowcert = $resultcert->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td><?php echo $rowcert["saludo"]." ".$rowcert["nombre"];?></td>
                                                        <td><?php echo $rowcert["cargo"];?></td>
                                                        <td><?php echo $rowcert["tel"];?></td>
                                                        <td><?php echo $rowcert["email"];?></td>
                                                        <td><a href="#" class="btn btn-default btn-xs purple" data-toggle="modal" data-target="#myModaliaded"><i class="fa fa-edit"></i> Editar</a><a href="#" class="btn btn-default btn-xs black"><i class="fa fa-trash-o"></i> Borrar</a></td>
                                                    </tr>
                                                    <?php } ?>
                                                </table>
                                                <?php } else {?>
                                                <h2>No tiene Contactos registrados</h2>
                                                 <?php } ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordions" href="#collapseTwos">
                                                        Oportunidades
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwos" class="panel-collapse collapse">
                                                <div class="panel-body border-red">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default"data-toggle="modal" data-target="#myModal2"><i class="fa fa-cogs"></i> Adicionar Inducción</button>
                                                    <!-- <button type="button" class="btn btn-default"><i class="fa fa-cogs"></i> Settings</button> -->
                                                </div><BR>
                                                <div class="widget-body">
                                                 <div class="table-responsive">
                                                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                     <thead>
                                                            <tr>
                                                                <th>Nombre Oportunidad </th>
                                                                <th class="hidden-xs"> Propietario </th>
                                                                <th class="hidden-xs"> Contacto</th>
                                                                <th class="hidden-xs"> Fecha Cierre </th>
                                                                
                                                                <th>Opciones</th>
                                                            </tr>
                                                        </thead>
                                                        <?php 
                                                            $sql4 = "SELECT * FROM crm_oport WHERE id_emp LIKE $id_emp AND status = 'on'  ";
                                                            $result2 = $conn->query($sql4);
                                                            $_SESSION["numrow"] = mysqli_num_rows($result2);

                                                            if ($result2->num_rows > 0) { 
                                                        ?>

                                                        <tbody>
                                                            <?php while($row1 = $result2->fetch_assoc()) {
                                                            ?>   
                                                            <tr class="odd gradeX">
                                                                <td>
                                                                    <?php echo $row1["nombre"]; ?>
                                                                </td>
                                                                <td class="no-sort">
                                                                    <?php echo $row1["propietario"]; ?>
                                                                </td>
                                                                <td class="no-sort">
                                                                    <?php echo $row1["contacto"]; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $row1["fecha_cierre"]; ?>
                                                                </td>
                                                                
                                                                <td>
                                                                    <div class="btn-group"> <a href="crm-ve.php?id=<?php echo $row1["idempresa"];?>" type="button" class="btn btn-default"><i class="fa fa-edit"></i>Ver</a> </div>
                                                                </td>
                                                            </tr>
                                                            <?php } }?> 
                                                        </tbody>
                                                        
                                                    </table>
                                </div>
                            </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordions" href="#collapseFive">
                                                        Anotaciones 
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFive" class="panel-collapse collapse">
                                                <div class="panel-body border-gold">
                                                <?php
                                                    $variablecert ="SELECT * FROM  `rrhh_cert` WHERE  `cedula` = $cedula ";
                                                    $resultcert = $conn->query($variablecert);
                                                    // $rowind = mysqli_fetch_row($resultind);
                                                    if ($resultcert->num_rows > 0) {
                                                        
                                                ?>
                                                <table class="table table-striped table-bordered table-hover" style="margin-bottom:20px;">
                                                    <tr>
                                                        <th>Certificado:</th>
                                                        <th>Fecha Inicio</th>
                                                        <th>Fecha Vencimiento</th>
                                                        <th></th>
                                                    </tr>
                                                    <?php while($rowcert = $resultcert->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td><?php echo $rowcert["certificado"];?></td>
                                                        <td><?php echo $rowcert["fecha"];?></td>
                                                        <td><?php echo $rowcert["duracion"];?></td>
                                                        <td><a href="#" class="btn btn-default btn-xs purple"><i class="fa fa-edit"></i> Editar</a><a href="#" class="btn btn-default btn-xs black"><i class="fa fa-trash-o"></i> Borrar</a></td>
                                                    </tr>
                                                    <?php } ?>
                                                </table>
                                                <?php } else {?>
                                                <h2>No tiene oportunidades registradas</h2>
                                                 <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>  
                                <!-- Fin acordion -->
                                <div class="btn-group">
                                                <button type="button" class="btn btn-labeled btn-blue" data-toggle="modal" data-target="#myModal1"><i class="btn-label fa fa-plus"></i>Adicionar un elemento</button>
                                                
                                            </div><br>  
                                                                                  
                                                 
                                                <!-- modal ingreso contactos -->
                                                    <div class="modal fade" id="myModaliad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                                        <form action="crm-ve.php?id=<?php echo $idempresa?>" method="post" role="form">
                                                                            <div class="row">
                                                                            <div class="form-title" style="padding: 0 23px;">Información Personal</div>                          
                                                                            <div class="col-sm-3">

                                                                                     <div class="form-group"> 
                                                                                        <span class="input-icon icon-right">
                                                                                            <select name="saludo">
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
                                                                                            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                                                                                            <i class="fa fa-map-marker"></i>
                                                                                        </span> 
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-sm-12">
                                                                                     <div class="form-group"> 
                                                                                        <span class="input-icon icon-right">
                                                                                            <input type="text" name="cargo" class="form-control" placeholder="Cargo" required>
                                                                                            <i class="fa fa-map-marker"></i>
                                                                                        </span> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                     <div class="form-group"> 
                                                                                        <span class="input-icon icon-right">
                                                                                            <input type="tel" name="tel" class="form-control" placeholder="Telefono" required>
                                                                                            <i class="fa fa-newspaper-o"></i>
                                                                                        </span> 
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="col-sm-6">
                                                                                     <div class="form-group"> 
                                                                                        <span class="input-icon icon-right">
                                                                                            <input type="tel" name="cel" class="form-control" placeholder="Celular" required>
                                                                                            <i class="fa fa-map-marker"></i>
                                                                                        </span> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                     <div class="form-group"> 
                                                                                        <span class="input-icon icon-right">
                                                                                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                                                                                            <i class="fa fa-newspaper-o"></i>
                                                                                        </span> 
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="col-sm-6">
                                                                                     <div class="form-group"> 
                                                                                        <span class="input-icon icon-right">
                                                                                            <input type="email" name="email2" class="form-control" placeholder="Email alternativo" required>
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
                                                                                
                                                                            </div><br>
                                                                                <hr>
                                                                                    <button type="submit" name="submit2" class="btn btn-blue">Ingresar</button>
                                                                            </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- modal fin -->
                                                            <!-- modal editar contactos -->
                                                    <div class="modal fade" id="myModaliaded" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                                        <form action="crm-ve.php?id=<?php echo $idempresa?>" method="post" role="form">
                                                                            <div class="row">
                                                                            <div class="form-title" style="padding: 0 23px;">Información Personal</div>                          
                                                                            <div class="col-sm-3">
                                                                                <?php
                                                                                        $edcont ="SELECT * FROM  `crm_cont` WHERE  id = $id_contacto";
                                                                                        $resultec = $conn->query($edcont);
                                                                                        $rowec = mysqli_fetch_row($resultec);
                                                                                        $numrow = mysqli_num_rows($resultec);
    
                                                                                ?>

                                                                                     <div class="form-group"> 
                                                                                        <span class="input-icon icon-right">
                                                                                            <select name="saludo">
                                                                                              <option value="Sr."><?php echo $rowec[1];?></option>
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
                                                                                            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                                                                                            <i class="fa fa-map-marker"></i>
                                                                                        </span> 
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-sm-12">
                                                                                     <div class="form-group"> 
                                                                                        <span class="input-icon icon-right">
                                                                                            <input type="text" name="cargo" class="form-control" placeholder="Cargo" required>
                                                                                            <i class="fa fa-map-marker"></i>
                                                                                        </span> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                     <div class="form-group"> 
                                                                                        <span class="input-icon icon-right">
                                                                                            <input type="tel" name="tel" class="form-control" placeholder="Telefono" required>
                                                                                            <i class="fa fa-newspaper-o"></i>
                                                                                        </span> 
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="col-sm-6">
                                                                                     <div class="form-group"> 
                                                                                        <span class="input-icon icon-right">
                                                                                            <input type="tel" name="cel" class="form-control" placeholder="Celular" required>
                                                                                            <i class="fa fa-map-marker"></i>
                                                                                        </span> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                     <div class="form-group"> 
                                                                                        <span class="input-icon icon-right">
                                                                                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                                                                                            <i class="fa fa-newspaper-o"></i>
                                                                                        </span> 
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="col-sm-6">
                                                                                     <div class="form-group"> 
                                                                                        <span class="input-icon icon-right">
                                                                                            <input type="email" name="email2" class="form-control" placeholder="Email alternativo" required>
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
                                                                                
                                                                            </div><br>
                                                                                <hr>
                                                                                    <button type="submit" name="submit2" class="btn btn-blue">Ingresar</button>
                                                                            </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- modal fin -->

                                                    <!-- modal ingreso induccion -->
                                                    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <h4 class="modal-title" id="myModalLabel">Ingresar Certificado</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div id="registration-form">
                                                                        <form action="rrhh_ve.php?id=<?php echo $cedula?>" method="post" role="form">
                                                                            <div class="form-title">Certificado</div>
                                                                            <div class="form-group">
                                                                                <span class="input-icon icon-right">
                                                                                    <input type="text" name="certificado" class="form-control" placeholder="Nombre cerificado">
                                                                                    <i class="fa fa-user"></i>
                                                                                </span>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    <p>Fecha Inicio</p>
                                                                                    <div class="input-group">
                                                                                        <input class="form-control date-picker" name="fechaini" id="fechaini" type="text" data-date-format="dd-mm-yyyy">
                                                                                        <span class="input-group-addon">
                                                                                            <i class="fa fa-calendar"></i>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <p>Fecha Vencimiento</p>
                                                                                    <div class="input-group">
                                                                                        <input class="form-control date-picker" name="fechaven" id="fechaven" type="text" data-date-format="dd-mm-yyyy">
                                                                                        <span class="input-group-addon">
                                                                                            <i class="fa fa-calendar"></i>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div><br>
                                                                                <hr>
                                                                                    <button type="submit" name="submit3" class="btn btn-blue">Ingresar</button>
                                                                            </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- modal fin -->
                                            <!-- modal inicio -->
                                <div class="modal fade" id="myModa2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                           <div class="modal-body">
                                                    <div id="registration-form">
                                                        <form action="tareas1.php" method="post" role="form">
                                                            <div class="form-title">
                                                                Nombre Tarea
                                                            </div>
                                                            <div class="form-group">
                                                                        <span class="input-icon icon-right">
                                                                            <input type="text" name="n_tarea" class="form-control" placeholder="Nombre tarea">
                                                                            <i class="fa fa-user"></i>
                                                                        </span>
                                                                    </div>
                                                            <div class="form-title">
                                                                Asignar Responsable
                                                            </div>
                                                            <!-- xxx asignar -->
                                                            <div>
                                                               
                                                            </div>
                                                            <!-- xxx fin asignar -->
                                                            <div class="form-title">
                                                               Fecha entrega
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-8 col-xs-12">
                                                                    <div class="input-group">
                                                                        <input name="f_entrega" class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </span>
                                                                     </div>                                                         
                                                                </div>
                                                                <div class="col-sm-4 col-xs-12">
                                                                    <input type="checkbox" name="prioridad"checked data-toggle="toggle" data-width="120" data-on="Es Urgente?" data-off="Urgente" data-onstyle="success" data-offstyle="danger">                                                               
                                                                </div>
                                                            </div><br>
                                                             <div class="form-title">
                                                               Descripción Tarea
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        
                                                                            <textarea name="d_tarea" class="form-control" rows="6" id="form-field-8" placeholder="Su descripción aqui!"></textarea>
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                               
                                                            
                                                            </div>
                                                            
                                                            
                                                            <button type="submit" class="btn btn-blue">Ingresar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                          
                                          
                                        </div>
                                      </div>
                                    </div>

                                <!-- modal fin -->
                                                                           
                     <!-- modal inicio -->
                                <div class="modal fade" id="myModa2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Adicionar Materiales</h4>
                                          </div>
                                          <div class="modal-body">
                                                    <div id="registration-form">
                                                        <form role="form">
                                                            <div class="form-title">
                                                                Elija un Material o Insumo
                                                            </div>
                                                            <div class="form-group">
                                                                <!-- vvvvvvvvvvv -->
                                                                       
                                                                        <select id="e3" style="width:100%;">
                                                                            <option value="AL" />Tuberia SCH 40 2" AC
                                                                            <option value="AK" />Codo SCH 40 2" AC
                                                                            <option value="AZ" />Tee sch 40 2" AC
                                                                            <option value="AR" />Soldadura 6011 
                                                                            <option value="CA" />Tuberia SCH 10 6" inox
                                                                            <option value="CO" />Tuberia Sch 5 2" inox
                                                                            <option value="KA" />Codo SCH 40 2" AC
                                                                            <option value="ZA" />Tee sch 40 2" AC
                                                                            <option value="RA" />Soldadura 6011 
                                                                            <option value="AC" />Tuberia SCH 10 6" inox
                                                                            <option value="OC" />Tuberia Sch 5 2" inox
                                                                       </select>
                                                                <!-- vvvvvvvvvvv -->
                                                            </div>
                                                            <div class="form-title">
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <span class="input-icon icon-right">
                                                                            <input type="text" class="form-control" id="emailInput" placeholder="Unidad">
                                                                            <i class="fa fa-line-chart "></i>
                                                                            
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <span class="input-icon ">
                                                                            <input type="text" class="form-control" placeholder="Vr Unitario">
                                                                            <i class="fa fa-dollar circular"></i>
                                                                            
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <span class="input-icon icon-right">
                                                                            <input type="text" class="form-control" placeholder="Cantidad">
                                                                            <i class="fa fa-check-square-o"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <span class="input-icon icon-right">
                                                                            <input type="text" class="form-control" id="emailInput" placeholder="Rendimiento">
                                                                            <i class="fa fa-line-chart "></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            
                                                            </div>
                                                            <button type="submit" class="btn btn-blue">Ingresar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                          
                                          
                                        </div>
                                      </div>
                                    </div>

                                <!-- modal fin -->
                    
                    <!-- modal inicio -->
                                <div class="modal fade" id="myModa3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Adicionar Herramientas y Equipos</h4>
                                          </div>
                                          <div class="modal-body">
                                                    <div id="registration-form">
                                                        <form role="form">
                                                            <div class="form-title">
                                                                Elija Equipo o Herramienta
                                                            </div>
                                                            <div class="form-group">
                                                                <!-- vvvvvvvvvvv -->
                                                                  
                                                                        <select id="e4" style="width:100%;">
                                                                            <option value="AL" />Maquina de Soldar 450W
                                                                            <option value="AK" />Equipo Argon
                                                                            <option value="AZ" />Equipo Oxicorte
                                                                            <option value="AR" />Maquina Plasma
                                                                            <option value="CA" />Compresor Portatil
                                                                            <option value="CO" />Ventilador 300W
                                                                            <option value="CT" />Taladro Dewall
                                                                            <option value="PO" />Equipo Oxicorte
                                                                            <option value="PA" />Maquina Plasma
                                                                            <option value="TA" />Compresor Portatil
                                                                            <option value="YE" />Ventilador 300W
                                                                            <option value="CH" />Taladro Dewall
                                                                            
                                                                        </select>
                                                                <!-- vvvvvvvvvvv -->
                                                            </div>
                                                            <div class="form-title">
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <span class="input-icon icon-right">
                                                                            <input type="text" class="form-control" id="emailInput" placeholder="Unidad">
                                                                            <i class="fa fa-line-chart "></i>
                                                                            
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <span class="input-icon ">
                                                                            <input type="text" class="form-control" placeholder="Vr Unitario">
                                                                            <i class="fa fa-dollar circular"></i>
                                                                            
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <span class="input-icon icon-right">
                                                                            <input type="text" class="form-control" placeholder="Cantidad">
                                                                            <i class="fa fa-check-square-o"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <span class="input-icon icon-right">
                                                                            <input type="text" class="form-control" id="emailInput" placeholder="Rendimiento">
                                                                            <i class="fa fa-line-chart "></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            
                                                            </div>
                                                            
                                                            
                                                            
                                                            <button type="submit" class="btn btn-blue">Ingresar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                          
                                          
                                        </div>
                                      </div>
                                    </div>

                                <!-- modal fin -->

                                </div>
                            </div>
                    <!-- fin nombre oportunidad -->
                                        
                </div>
                <!-- fin cuerpo -->

                                        </div><!--Widget Body-->
                                    </div><!--Widget-->
                                </div>
                
            </div>
            <!-- /Page Content -->

        </div>
        <!-- /Page Container -->
        <!-- Main Container -->

    </div>
                                   
    <!--Basic Scripts-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>

    <!--Beyond Scripts-->
    <script src="assets/js/beyond.js"></script>

 <!--Datatable -->
    <script src="http://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="assets/js/datatable/dtn/jquery.dataTables.js"></script>
    <script src="assets/js/datatable/dtn/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function() {
        $('#example').DataTable( {
        "order": [[ 1, "asc" ]]
    } );
    } );
    </script>
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
    <!--Dropzone-->
    <script src="assets/js/dropzone/dropzone.min.js"></script>

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
        $('.input-group.date').datetimepicker({
            widgetPositioning:{
                                horizontal: 'auto',
                                vertical: 'bottom'
                            }
        });
        
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
