<?php include("intro.php"); ?>
<?php require_once("assets/includes/connection.php");?>
<?php 
    $mflot="display: block;"; 
    $id_serv = $_GET["id"];       
   if ($_SERVER["REQUEST_METHOD"] == "POST"){
                            
        $coment=$_POST["coment"];
        $time= time();
        $f_coment= date("d-m-Y", $time);
        $usuarioc=$_SESSION["nombre"];
        $sql = "INSERT INTO comentareas (id_tarea, id_usuario, t_comentario, f_coment) " .
        "VALUES ('$id_tarea', '$usuarioc', '$coment', '$f_coment')";

        if ($conn->query($sql) === TRUE) {
        // echo "<div style='padding:20px 20px 0 20px' ><div class='alert alert-success fade in'><button class='close' data-dismiss='alert'>x</button>";
        // echo "<i class='fa-fw fa fa-check'></i><strong>Exito</strong> La tarea ha sido creada.</div></div>";
                                                               
        }  else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        }

    
    
                                    
    $variable ="SELECT * FROM  `flot-servicios` WHERE  `id_serv` = $id_serv LIMIT 0 , 30";
    $result = $conn->query($variable);
    $row = mysqli_fetch_row($result);
    $numrow = mysqli_num_rows($result);
    if ($row[8]== "En Curso") {
        $label="yellow";
    } else{
    if ($row[8]=="Atrazada") {
        $label = "red";
    } else {
        $label = "blue";
                                         
    }}
                                       
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
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href="assets/css/typicons.min.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <!--Page Related styles-->
    <link href="assets/css/dataTables.bootstrap.css" rel="stylesheet" />

    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="assets/js/skins.min.js"></script>
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
                        <li class="active">Flotas</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                            Ver Servicio
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
                                        

                    <div class="well with-header  with-footer">
                                <div class="header bg-blue">
                                    Flotas/ Servicio
                                </div>
                                
                                <div class="btn-group">
                                    
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModa2"><i class="fa fa-cogs"></i> Nuevo Repuesto</button>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal1"><i class="fa fa-calculator"></i> Nuevo Comentario</button>
                                        <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Imprimir Tarea</button>
                                    </div>
                                    <div class="widget-buttons" style="float:right;">
                                                <div class="btn-group">
                                                    <a class="btn btn-<?php echo $label ?> btn-sm " href="javascript:void(0);"><?php echo $row[9];?></a>
                                                    <a class="btn btn-<?php echo $label ?> btn-sm dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-angle-down"></i></a>
                                                    <ul class="dropdown-menu dropdown-<?php echo $label ?> pull-left">
                                                        <li>
                                                            <a href="javascript:void(0);">En Curso</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);">Atrazada</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);">Entregado</a>
                                                        </li>
                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                        <br><br>
                                                             
                                <table class="table " style="margin-bottom:20px;">
                                    
                                        <tr>
                                        <th>
                                                Servicio No:
                                        </th>

                                        <td>
                                            <?php echo $row[5];?>         
                                        </td>
                                        <th>
                                                Fecha Ingreso:
                                        </th>
                                        <td>
                                            <?php echo $row[1];?>   
                                        </td>
                                        <th>
                                                Fecha Entrega:
                                        </th>
                                        <td>
                                            <?php echo $row[2];?>   
                                        </td>
                                        </tr>
                                         
                                         <tr>
                                        <th>
                                                No Orden:
                                        </th>

                                        <td>
                                            <?php echo $row[7];?>         
                                        </td>
                                        <th>
                                                Mixer:
                                        </th>
                                        <td>
                                            <?php echo $row[3];?>   
                                        </td>
                                        <th>
                                                Placa:
                                        </th>
                                        <td>
                                            <?php echo $row[4];?>   
                                        </td>
                                        </tr>
                                       <tr>
                                        <th>
                                                No Orden:
                                        </th>

                                        <td>
                                            <?php echo $row[7];?>         
                                        </td>
                                        <th>
                                                Mixer:
                                        </th>
                                        <td>
                                            <?php echo $row[3];?>   
                                        </td>
                                        <th>
                                                Placa:
                                        </th>
                                        <td>
                                            <?php echo $row[4];?>   
                                        </td>
                                        </tr>

                                        <tr>
                                        <th>
                                               Comentario:
                                        </th>
                                        <td colspan="5">
                                            <?php echo $row[10];?>
                                        </td>
                                        </tr>

                                        
                                    
                                </table>

                                <div class="">
                                    <!-- inicio widget Mano d Obra-->
                                                
                                                   
                                                    
                                                    <!-- fin descripcion -->

                                                     <?php 
                                                        $sql3 = "SELECT * FROM `flot-dserv` WHERE `id_serv` = $id_serv";
                                                        $result3 = $conn->query($sql3);
                                                     ?>
                                                        <?php
                                                              if ($result3->num_rows > 0) { 
                                                              while($row1 = $result3->fetch_assoc()) { 
                                                                if ($colorlabel==0){ 
                                                                   $label= "yellow"; 
                                                                   $colorlabel=1; 
                                                                }else{ 
                                                                   $label="red"; 
                                                                   $colorlabel=0; 
                                                                }
                                                                $id_dserv=$row1["id_dserv"];
                                                      ?>
                                
                                                      <!-- inicio descripcion -->
                                                   <div class="col-lg-12 col-sm-12 col-xs-12">
                                                        <div class="widget">
                                                            <div class="widget-header bordered-left bordered-<?php echo $label?>">
                                                            <span class="widget-caption"><?php echo $row1["especialidad"]; ?></span>
                                                            <div class="widget-buttons buttons-bordered">
                                                                <span class="label label-info">
                                                                    <?php echo $row1["actividad"]; ?>
                                                                </span>
                                                            </div>
                                                   </div><!--Widget Header-->
                                                            <div class="widget-body bordered-left bordered-<?php echo $label?>">
                                                                <table class="table table-striped table-bordered table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                <i class="fa fa-gears"></i> Repuesto
                                                                            </th>
                                                                            <th class="hidden-xs">
                                                                                <i class="fa fa-reorder"></i> Cant
                                                                            </th>
                                                                            <th>
                                                                                <i class="fa fa-dollar"></i> Vr Unit
                                                                            </th>
                                                                            <th class="hidden-xs">
                                                                                <i class="fa fa-dollar"></i> Tot Rep
                                                                            </th>
                                                                            <th>
                                                                                <i class="fa fa-user"></i> Vr Mano Obra
                                                                            </th>
                                                                            <th>
                                                                                <i class="fa fa-dollar"></i> Sub Total
                                                                            </th>
                                                                            <th>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody><?php $sql4 = "SELECT * FROM `flot-srep` WHERE `id_dserv` = $id_dserv";
                                                                                $result4 = $conn->query($sql4);
                                                                               if ($result4->num_rows > 0) { 
                                                                                while($row2 = $result4->fetch_assoc()) { ?>
                                                                        <tr>
                                                                            <td>
                                                                                <a href="#"><?php echo $row2["id_rep"]; ?></a>
                                                                            </td>

                                                                            <td class="hidden-xs">
                                                                                <?php echo $row2["cant"]; ?>                                                               
                                                                            </td>                                                                                                                                                        

                                                                            <td>
                                                                                <?php //echo $row2["especialidad"]; ?>
                                                                            </td>
                                                                            <td>
                                                                                <a href="#"><?php //echo $row2["especialidad"]; ?></a>
                                                                            </td>
                                                                            <td class="hidden-xs">
                                                                                <?php echo $row2["v_mo"]; ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php //echo $row2["especialidad"]; ?>
                                                                            </td>
                                                                            <td>
                                                                                <a href="#" class="btn btn-default btn-xs purple"><i class="fa fa-change"></i>Change
                                                                                </a>
                                                                            </td>
                                                                        </tr> <?php }} ?>






                                                                      


                                                                    </tbody>
                                                                </table>
                                                                
                                                                <hr class="wide">
                                                                <span>Total $xxx.xx</span>
                                                            </div><!--Widget Body-->

                                                        </div><!--Widget-->
                                                    </div>
                                                    <?php }} ?>
                                                    <!-- fin descripcion -->
                                                                   

                                                   
                                                </div><!--Widget Body Personal-->

                                                                      
                                   
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-labeled btn-blue" data-toggle="modal" data-target="#myModal1"><i class="btn-label fa fa-plus"></i>Adicionar un elemento</button>
                                                
                                            </div><br>  
                                                                                  
                                                 <!-- modal inicio -->
                                                            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                  <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                      <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                          <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h4 class="modal-title" id="myModalLabel">Actualizar Tarea</h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                                <div id="registration-form">
                                                                                    <form action="v_tarea.php?id=<?php echo $id_tarea ?>" method="post" role="form">
                                                                                        <div class="form-title">
                                                                                            Comentario Tarea
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <!-- vvvvvvvvvvv -->
                                                                                              
                                                                                        <textarea class="form-control" rows="3" name="coment" placeholder="Content"></textarea>
                                                                                            <!-- vvvvvvvvvvv -->
                                                                                        </div>
                                                                                        <div class="form-title">
                                                                                            
                                                                                        </div>
                                                                                        
                                                                                            <h5 class="row-title before-darkpink"><i class="fa fa-upload darkpink"></i>Gargar Archivos</h5>
                                                                                           <hr>
                                                                                       
                                                                                        <button type="submit" name="subt" class="btn btn-blue">Ingresar</button>
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

 <!--Page Related Scripts-->
    <script src="assets/js/datatable/jquery.dataTables.js"></script>
    <script src="assets/js/datatable/ZeroClipboard.js"></script>
    <script src="assets/js/datatable/dataTables.tableTools.min.js"></script>
    <script src="assets/js/datatable/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/datatable/datatables-init.js"></script>
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
    // <script>
       
    //     InitiateEditableDataTable.init();
    //     InitiateExpandableDataTable.init();
    //     InitiateSearchableDataTable.init();
    // </script>
</body>
<!--  /Body -->
</html>
