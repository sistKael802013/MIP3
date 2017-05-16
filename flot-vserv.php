<?php include("intro.php"); //pantallazo de carga del sitio ?>
<?php require_once("assets/includes/connection.php"); //Conexion a base de datos ?>
<?php
    session_start();
    $mflot="display: block;"; 
    $id_serv = $_GET["id"];
    $_SESSION["id_serv"] = $id_serv;

    $sql = "SELECT  * FROM flot_servicios, flot_mx 	WHERE flot_servicios.id_serv = $id_serv AND flot_servicios.mx = flot_mx.id_mx";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
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
    <title>Flotas / Servicio: <?php	echo $row["no_serv"]; ?></title>
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
    <style>
			.current-row{background-color:#B24926;color:#FFF;}
			.current-col{background-color:#1b1b1b;color:#FFF;}
			.tbl-qa{width: 100%;font-size:0.9em;background-color: #f5f5f5;}
			.tbl-qa th.table-header {padding: 5px;text-align: left;padding:10px;}
			.tbl-qa .table-row td {padding:10px;background-color: #FDFDFD;}
    </style>
    
</head>
<body>
    <?php 
        //Include para cargar header o encabezado de la pagina
        include("header.php");
        //Include para cargar columna izquierda de la pagina
        include("colizq.php");
    ?>
    <div class="page-content">
        <div class="page-breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i><a href="#">Home</a>
                </li>
                <li class="active">
                    Flotas
                </li>
            </ul>
        </div>
        <div class="page-header position-relative">
            <div class="header-title">
                <h1>
                    Ver Servicio
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
            <!--Header Buttons End-->
        </div>
        <div class="page-body">
            <div class="well with-header  with-footer">
                <div class="header bg-blue">
                    Flotas/ Servicio
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#mod_n_rep"><i class="fa fa-cogs"></i> Nuevo Repuesto</button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#mod_tbl_rep"><i class="glyphicon glyphicon-list"></i>Lista de repuestos</button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#mod_inf_adc"><i class="fa fa-calculator"></i> Información adicional</button>
                    <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Generar Informe</button>
                </div>
                <div class="btn-group"  style="float:right;">
                    <div id="coment_tarea" style="<?php echo $confir ?>">
                        <span id="confirm"></span>
                        <input type="checkbox" id="prioridad" name="prioridad" title="Cambiar estado de la tarea." checked data-toggle="toggle" onclick="return check()" data-width="120" data-on="<?php echo $row[8]; ?>" data-off="Entregado" data-onstyle="<?php echo $c_st?>" data-offstyle="success">
                    </div>
                </div>
                <!-- BOTÓN CAMBIO DE ESTADO -->
                <br>
                <br>
                <!-- TABLA DE INFORMACION ADICIONAL DEL SERVICIO -->
                <section id="tbl_detall_adc"></section>
                <!-- TABLA ACTIVIDAD/ESPECIALIDAD -->
                <div class="">               
                    <div id="list_act_esp"></div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-labeled btn-blue" data-toggle="modal" data-target="#mod_espact" ><i class="btn-label fa fa-plus"></i>Adicionar un elemento</button>
                </div>
                <br> 

                <!-- MODAL CREAR MANO DE OBRA  -->
                <div class="modal fade" id="mod_mo_espact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <h4 class="modal-title" id="myModalLabel">Agregar Mano de Obra</h4> </div>
                            <div class="modal-body">
                                <div id="registration-form">
                                    <form action="flot-vserv.php?id=<?php echo $id_serv?>" method="post" role="form">
                                        <div class="col-sm-12">
                                            <div class="form-group"> Mano de Obra <span class="input-icon ">
                                                <input type="text" id="m_obra" name="m_obra" class="form-control" placeholder="<?php echo $row[5];?>" value="<?php echo $row[5];?>">
                                                <i class="fa fa-user"></i>
                                                </span> 
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="form-group"> Vr mano de Obra <span class="input-icon ">
                                                <input type="hidden" name="id_dserv" id="id_dserv" class="form-control">
                                                <input type="hidden" name="id_tip_mo" id="id_tip_mo" class="form-control" value="1">
                                                <input type="text" id="v_mo" name="v_mo" class="form-control" placeholder="<?php echo $row[5];?>" value="<?php echo $row[5];?>">
                                                <i class="fa fa-dollar"></i>
                                                </span> 
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group"> Horas/Hombre <span class="input-icon ">
                                                <input type="text" id="h_hombre" name="h_hombre" class="form-control" placeholder="<?php echo $row[6];?>" value="<?php echo $row[6];?>">
                                                <i class="fa fa-clock-o"></i>
                                                </span> 
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
                                        <input type="button" href="javascript:;" onclick="n_mo_espact($('#m_obra').val(), $('#id_dserv').val(), $('#id_tip_mo').val(), $('#v_mo').val(), $('#h_hombre').val());return false;" name="sut" id="sut" class="btn btn-blue" value="Ingresar" /> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>            
                <!-- MODAL CREAR MANO DE OBRA  -->

                <!-- MODAL EDITAR MANO DE OBRA  -->
                <div class="modal fade" id="mod_edit_mo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <h4 class="modal-title" id="myModalLabel">Agregar Mano de Obra</h4> </div>
                            <div class="modal-body">
                                <div id="registration-form">
                                    <form action="flot-vserv.php?id=<?php echo $id_serv?>" method="post" role="form">
                                        <div class="col-sm-12">
                                            <div class="form-group"> Mano de Obra <span class="input-icon ">
                                                <input type="text" id="m_obra_mo" name="m_obra_mo" class="form-control" placeholder="Descripcion de mano de obra">
                                                <i class="fa fa-user"></i>
                                                </span> 
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="form-group"> Vr mano de Obra <span class="input-icon ">
                                                <input type="hidden" name="id_srep_mo" id="id_srep_mo" class="form-control">
                                                <input type="hidden" name="id_dserv_mo" id="id_dserv_mo" class="form-control">
                                                <input type="hidden" name="id_tip_mo" id="id_tip_mo" class="form-control" value="1">
                                                <input type="text" id="v_mo_mo" name="v_mo_mo" class="form-control" placeholder="">
                                                <i class="fa fa-dollar"></i>
                                                </span> 
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group"> Horas/Hombre 
                                                <span class="input-icon ">
                                                    <input type="text" id="h_hombre_mo" name="h_hombre_mo" class="form-control" placeholder="Horas laboradas">
                                                    <i class="fa fa-clock-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
                                        <input type="button" href="javascript:;" onclick="ed_mo_espact($('#m_obra_mo').val(), $('#id_srep_mo').val(), $('#id_dserv_mo').val(), $('#id_tip_mo').val(), $('#v_mo_mo').val(), $('#h_hombre_mo').val());return false;" name="sut" id="sut" class="btn btn-blue" value="Ingresar" /> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL EDITAR MANO DE OBRA  -->

                 <!-- INICIO MODAL ELIMINAR MANO DE OBRA -->
                    <form id="form_eliminar" action="" method="POST">
                        <div class="modal fade" id="mod_eliminar_mo" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <input type="hidden" id="id_srep_moel" value="">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="modalEliminarLabel">Eliminar elemento</h4>
                                    </div>
                                    <div class="modal-body">                            
                                        ¿Está seguro de eliminar este elemento?<strong data-name=""></strong>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" href="javascript:;" onclick="eliminar_mo($('#id_srep_moel').val());return false;" name="sut1" id="sut1" class="btn btn-blue" value="Si" /> 
                                        <button type="button" class="btn btn-default"  data-dismiss="modal">No</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                <!-- FIN MODAL ELIMINAR MANO DE OBRA -->

                <!-- INICIO MODAL CREAR ESPECIALIDAD/ACTIVIDAD -->
                <div class="modal fade" id="mod_espact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <h4 class="modal-title" id="myModalLabel">Ingresar Nuevo Elemento</h4> </div>
                            <div class="modal-body">
                                <div id="registration-form">
                                    <form action="#" method="post" role="form" class="modalForm">
                                        <div class="form-title"> Especialidad: </div>
                                        <div class="form-group">
                                            <!-- vvvvvvvvvvv -->
                                            <?php 
                                                $sqla = "SELECT  * FROM flot_dserv_esp";
                                                $resultset1 = $conn->query($sqla);
                                                if ($resultset1->num_rows > 0) { 
                                            ?>
                                            <select id="sel_espc" style="width:100%;" sized="4">
                                                <?php while($row1 = $resultset1->fetch_assoc()) {?>
                                                    <option value="<?php echo $row1["id_esp"]; ?>" /><?php echo $row1["esp"]; ?>
                                                <?php } ?>
                                            </select>
                                            <?php }?>
                                            <!-- vvvvvvvvvvv -->
                                        </div>
                                        <hr>
                                        <div class="form-title"> Actividad: </div>
                                        <div class="form-group">
                                           <!-- vvvvvvvvvvv -->
                                            <?php 
                                                $sqlb = "SELECT  * FROM flot_dserv_act";
                                                $resultset2 = $conn->query($sqlb);
                                                if ($resultset2->num_rows > 0) { 
                                            ?>
                                            <select id="sel_actv" style="width:100%;" sized="4">
                                                <?php while($row2 = $resultset2->fetch_assoc()) {?>
                                                    <option value="<?php echo $row2["id_act"]; ?>" /><?php echo $row2["act"]; ?>
                                                <?php } ?>
                                            </select>
                                            <?php }?>
                                            <!-- vvvvvvvvvvv -->
                                        </div>
                                        <hr>
                                        <input type="button" href="javascript:;" onclick="n_esp_act($('#sel_espc').val(), $('#sel_actv').val());return false;" name="sut" id="sut" class="btn btn-blue" value="Ingresar" /> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN MODAL CREAR ESPECIALIDAD/ACTIVIDAD -->

                <!-- INICIO MODAL EDITAR ESPECIALIDAD/ACTIVIDAD -->
                <div class="modal fade" id="mod_edit_espact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <h4 class="modal-title" id="myModalLabel">Editar Elemento</h4> </div>
                            <div class="modal-body">
                                <div id="registration-form">
                                    <form action="#" method="post" role="form" class="modalForm">
                                        <div class="form-title"> Especialidad: </div>
                                        <div class="form-group">
                                            
                                            <!-- vvvvvvvvvvv -->
                                            <?php 
                                                $sqla = "SELECT  * FROM flot_dserv_esp";
                                                $resultset1 = $conn->query($sqla);
                                                if ($resultset1->num_rows > 0) { 
                                            ?>
                                            <select id="sel_espc_ed" style="width:100%;" sized="4">
                                                <?php while($row1 = $resultset1->fetch_assoc()) {?>
                                                    <option value="<?php echo $row1["id_esp"]; ?>" /><?php echo $row1["esp"]; ?>
                                                <?php } ?>
                                            </select>
                                            <?php }?>
                                            <!-- vvvvvvvvvvv -->
                                        </div>
                                        <input type="hidden" id="id_dservespact">
                                        <hr>
                                        <div class="form-title"> Actividad: </div>
                                        <div class="form-group">
                                            <!-- vvvvvvvvvvv -->
                                            <?php 
                                                $sqlb = "SELECT  * FROM flot_dserv_act";
                                                $resultset2 = $conn->query($sqlb);
                                                if ($resultset2->num_rows > 0) { 
                                            ?>
                                            <select id="sel_actv_ed" style="width:100%;" sized="4">
                                                <?php while($row2 = $resultset2->fetch_assoc()) {?>
                                                    <option value="<?php echo $row2["id_act"]; ?>" /><?php echo $row2["act"]; ?>
                                                <?php } ?>
                                            </select>
                                            <?php }?>
                                            <!-- vvvvvvvvvvv -->
                                        </div>
                                        <hr>
                                        <input type="button" href="javascript:;" onclick="edit_espact($('#id_dservespact').val(), $('#sel_espc_ed').val(), $('#sel_actv_ed').val());return false;" name="sut" id="sut" class="btn btn-blue" value="Ingresar" /> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN MODAL EDITAR ESPECIALIDAD/ACTIVIDAD -->

                 <!-- INICIO MODAL ELIMINAR ESPECIALIDAD/ACTIVIDAD -->
                    <form id="form_eliminar" action="" method="POST">
                        <!-- Modal -->
                        <div class="modal fade" id="mod_elim_espact" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <input type="hidden" id="id_dserv_el" value="">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="modalEliminarLabel">Eliminar elemento</h4>
                                    </div>
                                    <div class="modal-body">                            
                                        ¿Está seguro de eliminar este elemento?<strong data-name=""></strong>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" href="javascript:;" onclick="eliminar_espact($('#id_dserv_el').val());return false;" name="sut1" id="sut1" class="btn btn-blue" value="Aceptar" /> 
                                        <button type="button" class="btn btn-default"  data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                    </form>
                <!-- FIN MODAL ELIMINAR ESPECIALIDAD/ACTIVIDAD -->

                <!-- INICIO MODAL INFORMACION ADICIONAL -->
                <div class="modal fade" id="mod_inf_adc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <h4 class="modal-title" id="myModalLabel">Información Adicional</h4> </div>
                            <div class="modal-body">
                                <div id="registration-form">
                                    <form action="#" method="post" role="form" class="modalForm">
                                        <div class="col-sm-6">
                                            <div class="form-group"> Número de Servicio <span class="input-icon ">
                                                <input type="text" name="n_serv" id="n_serv" class="form-control">
                                                <i class="fa fa-cog"></i>
                                                </span> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> Número de Orden <span class="input-icon ">
                                                <input type="text" name="n_ordn" id="n_ordn" class="form-control" >
                                                <i class="fa fa-cog"></i>
                                                </span> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> Vr. factura <span class="input-icon icon-right">
                                                <input type="text" name="vr_fact" id="vr_fact" class="form-control"  >
                                                <i class="fa fa-dollar circular"></i>
                                                </span> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> Número factura <span class="input-icon icon-right">
                                                <input type="text" name="n_fact" id="n_fact" class="form-control">
                                                <i class="fa fa-check-square-o"></i>
                                                </span> 
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
                                        <!--button type="submit" name="subt2" class="btn btn-blue">Ingresar</button-->
                                        <input type="button" href="javascript:;" onclick="info_adc($('#n_serv').val(), $('#n_ordn').val(), $('#vr_fact').val(), $('#n_fact').val());return false;" name="sut1" id="sut1" class="btn btn-blue" value="Ingresar" /> 
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN MODAL INFORMACION ADICIONAL --> 

                <!-- INICIO MODAL NUEVO REPUESTO -->
                <div class="modal fade" id="mod_n_rep" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <h4 class="modal-title" id="myModalLabel">Ingresar Repuesto</h4> </div>
                            <div class="modal-body">
                                <div id="registration-form">
                                    <form action="flot-vserv.php?id=<?php echo $id_serv?>" method="post" role="form">
                                        <div class="col-sm-12">
                                            <div class="form-group"> <span class="input-icon ">
                                                
                                                <input type="text" id="repuesto" name="repuesto" class="form-control" placeholder="Nombre Repuesto">
                                                <i class="fa fa-cog"></i>
                                                </span> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <span class="input-icon icon-right">
                                                <input type="text" id="vr_unit" name="vr_unit" class="form-control" placeholder="Vr Unitario">
                                                <i class="fa fa-dollar circular"></i>
                                                </span> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <span class="input-icon icon-right">
                                                <input type="text" id="unidad" name="unidad" class="form-control" id="emailInput" placeholder="Unidad">
                                                <i class="fa fa-check-square-o"></i>
                                                </span> 
                                            </div>
                                        </div>
                                        <hr>
                                        <input type="button" href="javascript:;" onclick="n_rep($('#repuesto').val(), $('#vr_unit').val(), $('#unidad').val());return false;" name="sut1" id="sut1" class="btn btn-blue" value="Ingresar" /> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN MODAL NUEVO REPUESTO -->

                <!-- INICIO MODAL TABLA DE REPUESTOS -->
                <div class="modal fade" id="mod_tbl_rep" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <h4 class="modal-title" id="myModalLabel">Repuestos</h4> </div>
                            <div class="modal-body">
                                <section id="tbl_ltsrep"></section>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN MODAL TABLA DE REPUESTOS -->

                <!-- INICIO MODAL ELIMINAR REPUESTO -->
                    <form id="form_eliminar" action="" method="POST">
                        <div class="modal fade" id="mod_eliminar_srep" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <input type="hidden" id="id_srep" name="id_srep" value="">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="modalEliminarLabel">Eliminar repuesto</h4>
                                    </div>
                                    <div class="modal-body">                            
                                        ¿Está seguro de eliminar este repuesto?<strong data-name=""></strong>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" href="javascript:;" onclick="eliminar_rep_actesp($('#id_srep').val());return false;" name="sut1" id="sut1" class="btn btn-blue" value="Si" /> 
                                        <button type="button" class="btn btn-default"  data-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <!-- FIN MODAL ELIMINAR REPUESTO -->

                <!-- MODAL NUEVO REPUESTO EN ACTIVIDAD/ESPECIALIDAD -->
                <div class="modal fade" id="mod_rep_espact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            <div class="modal-body">
                                <div id="registration-form">
                                    <form action="" method="post" role="form">
                                        <div class="form-title"> Elija un Material o Insumo </div>
                                        <div class="form-group">
                                        	<section id="lts_rep"></section>
                                        </div>
                                        <div class="form-title"> </div>
                                        <input type="hidden" name="id_dserv" id="id_dserv" class="form-control">
                                        <input type="hidden" name="id_tip"  id="id_tip_rep" class="form-control" value="0">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group"> <span class="input-icon icon-right">
                                                    <input type="text" id="cant" name="cant" class="form-control" placeholder="Cantidad">
                                                    <i class="fa fa-check-square-o"></i>
                                                    </span> 
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"> 
                                                    <span class="input-icon icon-right">
                                                        <input type="text" name="v_mo" class="form-control" id="vr_mo" placeholder="Vr Mano de Obra">
                                                        <i class="fa fa-dollar circular "></i>
                                                    </span> 
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <input type="button" href="javascript:;" onclick="guardar_repuesto($('#id_tip_rep').val(), $('#id_dserv').val(), $('#id_rep').val(), $('#cant').val(), $('#vr_mo').val());return false;" name="sut1" id="sut1" class="btn btn-blue" value="Ingresar" /> 
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- MODAL NUEVO REPUESTO EN ACTIVIDAD/ESPECIALIDAD -->
                </div>
                </div>

                <!-- MODAL EDITAR REPUESTO EN ACTIVIDAD/ESPECIALIDAD -->
                <div class="modal fade" id="mod_editrep_espact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            <div class="modal-body">
                                <div id="registration-form">
                                    <form action="" method="post" role="form">
                                        <div class="form-title"> Elija un Material o Insumo </div>
                                        <div class="form-group">
                                            <!-- SELECCION DE REPUESTO DESDE UN COMBOBOX -->
                                            <section id="lts_rep_2"></section>
                                            <!-- SELECCION DE REPUESTO DESDE UN COMBOBOX -->
                                        </div>
                                        <div class="form-title"> </div>
                                        <input type="hidden" id="id_dserv_ed" class="form-control">
                                        <input type="hidden" id="id_srep_ed" class="form-control">
                                        <input type="hidden" id="id_tip" class="form-control" value="0">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group"> <span class="input-icon icon-right">
                                                    <input type="text" id="cant_ed" class="form-control" placeholder="Cantidad">
                                                    <i class="fa fa-check-square-o"></i>
                                                    </span> 
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"> <span class="input-icon icon-right">
                                                    <input type="text" id="v_mo_ed" class="form-control"  placeholder="Vr Mano de Obra">
                                                    <i class="fa fa-dollar circular "></i>
                                                    </span> 
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <input type="button" href="javascript:;" onclick="editar_repuesto($('#id_rep_ed').val(), $('#id_dserv_ed').val(), $('#id_srep_ed').val(), $('#id_tip').val(), $('#cant_ed').val(), $('#v_mo_ed').val());return false;" name="sut1" id="sut1" class="btn btn-blue" value="Ingresar" /> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- MODAL EDITAR REPUESTO EN ACTIVIDAD/ESPECIALIDAD -->
                <!-- modal inicio -->
                <div class="modal fade" id="myModanlre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <h4 class="modal-title" id="myModalLabel">Nuevo Repuesto</h4> </div>
                            <div class="modal-body">
                                <div id="registration-form">
                                    <form action="flot-vserv.php?id=<?php echo $id_serv?>" method="post" role="form">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group"> <span class="input-icon icon-right">
                <input type="text" name="repuesto" class="form-control" id="" placeholder="Nombre Repuesto">
                <i class="fa fa-line-chart "></i>

                </span> </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"> <span class="input-icon ">
                <input type="text" name="vr_unit" class="form-control" placeholder="Vr Unitario">
                <i class="fa fa-dollar circular"></i>

                </span> </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"> <span class="input-icon icon-right">
                <input type="text" name="unidad" class="form-control" placeholder="Unidad">
                <i class="fa fa-check-square-o"></i>
                </span> </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"> </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-blue">Ingresar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
<!-- toastr.js para notificaciones push -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

	<script>
        function showEdit(editableObj) {
            $(editableObj).css("background", "#FFF");
        }

        function saveToDatabase(editableObj, column, id) {
            $(editableObj).css("background", "#FFF url(loaderIcon.gif) no-repeat right");
            
            $.ajax({
                url: "saveedit.php", 
                type: "POST", 
                data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id, 
                //data:{'column':column, 'editval':editableObj.innerHTML, 'id':id}, 
                success: function (data) {
                    $(editableObj).css("background", "#FDFDFD");
                }
            });
        }
    </script>
    <script>

    $(document).on("ready", function(){
        listar_info_adc();
        listactesp();
        list_rep();       
        list_tbl_rep();       
    });


    // LISTAR -----------------------------------------------------
    // Listar informacion adicional del servicio
    function listar_info_adc() {
        var tabla = $.ajax({
            url: 'flot-vserv_detlladc.php'
            , dataType: 'text'
            , async: false
        }).responseText;
            document.getElementById("tbl_detall_adc").innerHTML = tabla;
    }

     // Listar repuestos
    function list_rep() {
        var tabla = $.ajax({
            url: 'flot-vserv_listrep.php'
            , dataType: 'text'
            , async: false
        }).responseText;
            document.getElementById("lts_rep").innerHTML = tabla;
            document.getElementById("lts_rep_2").innerHTML = tabla;
    }

    function list_tbl_rep() {
        var tabla = $.ajax({
            url: 'flot-vserv_calltblrep.php'
            , dataType: 'text'
            , async: false
        }).responseText;
            document.getElementById("tbl_ltsrep").innerHTML = tabla;
    }

    // Listar actividades/especialidades del servicio
    function listactesp() {
        var tablaa = $.ajax({
        url: 'flot-vserv_calltbl.php'
        , dataType: 'text'
        , async: false
        }).responseText;
            document.getElementById("list_act_esp").innerHTML = tablaa;
    
    }
    // LISTAR -----------------------------------------------------
    
    //SCRIPT PARA INGRESAR UN NUEVO REPUESTO -- LISTO!!
    function n_rep(repuesto, vr_unit, unidad) {
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
                toastr.info('Espere un momento...','Informacion');
            }, success: function (info) {
                toastr.success('El registro fue creado correctamente.','Operacion');
                $('#mod_n_rep').modal('hide');
                console.log(info);
                listactesp();
                list_rep();
            }
        });
    }

    //SCRIPT PARA GUARDAR INFORMACION ADICIONAL
    function info_adc(n_serv, n_ordn, vr_fact, n_fact) {
        var id_serv = "<?php echo $id_serv; ?>";
        var opcion = "info_adc";
        var param = {
            "n_serv": n_serv
            , "n_ordn": n_ordn
            , "vr_fact": vr_fact
            , "n_fact": n_fact
            , "id_serv": id_serv
            , "opcion": opcion
        };
        $.ajax({
            data: param
            , url: 'flot-vserv_crud.php'
            , type: 'post'
            , beforeSend: function () {
                toastr.info('Espere un momento....','Informacion');
            }, success: function (info) {
                toastr.success('El registro fue editado correctamente.','Operacion');
                $('#mod_inf_adc').modal('hide');
                console.log(info);
                listar_info_adc();
            }
        });
    }

    // SCRIPT PARA ASIGNAR UN REPUESTO A UNA ACTIVIDAD/ESPECIALIDAD
    function guardar_repuesto(id_tip, id_dserv, id_rep, cant, vr_mo) {
        
        var opcion = "guardar_srep";
        var param = {
            "id_tip": id_tip
            , "id_dserv": id_dserv
            , "id_rep": id_rep
            , "cant": cant
            , "vr_mo": vr_mo
            , "opcion": opcion
        };
        $.ajax({
            data: param
            , url: 'flot-vserv_crud.php'
            , type: 'post'
            , beforeSend: function () {
                toastr.info('Espere un momento...','Informacion');
            }, success: function (info) {
                toastr.success('Tarea Asignada correctamente','Operacion');
                // var json_info = JSON.parse( info );
                console.log(info);
                $('#mod_rep_espact').modal('hide');
                listactesp();
            }
        });
    }


    //EDITAR REPUESTO DE UNA ESPECIALIDAD/ACTIVIDAD
    function editar_repuesto(id_rep, id_dserv, id_srep, id_tip, cant, vr_mo) {
       
        var opcion = "editar_rep";
        var param = {
            "id_tip": id_tip
            , "id_srep": id_srep
            , "id_dserv": id_dserv
            , "id_rep": id_rep
            , "cant": cant
            , "vr_mo": vr_mo
            , "opcion": opcion
        };
        $.ajax({
            data: param
            , url: 'flot-vserv_crud.php'
            , type: 'post'
            , beforeSend: function () {
                toastr.info('Espere un momento...','Informacion');
            }, success: function (info) {
                toastr.success('Tarea Asignada correctamente','Operacion');
                // var json_info = JSON.parse( info );
                console.log(info);
                $('#mod_editrep_espact').modal('hide');
                listactesp();
            }
        });
    }

    //SCRIPT PARA ASIGNAR MANO DE OBRA A ESPECIALIDAD/ACTIVIDAD
    function n_mo_espact(m_obra, id_dserv, id_tip, vr_mo, h_hombre) {
        var opcion = "v_mobra";
        var parametros = {
            "m_obra": m_obra
            , "id_dserv": id_dserv
            , "id_tip": id_tip
            , "vr_mo": vr_mo
            , "h_hombre": h_hombre
            , "opcion": opcion
        };
        $.ajax({
            data: parametros
            , url: 'flot-vserv_crud.php'
            , type: 'post'
            , beforeSend: function () {
                toastr.info('Espere un momento...','Informacion');
            }, success: function (info) {
                toastr.success('Tarea Asignada correctamente','Operacion');
                // var json_info = JSON.parse( info );
                console.log(info);
                $('#mod_mo_espact').modal('hide');
                listactesp();
            }
        });
    }

    //SCRIPT PARA ASIGNAR MANO DE OBRA A ESPECIALIDAD/ACTIVIDAD
    function ed_mo_espact(m_obra, id_srep, id_dserv, id_tip, vr_mo, h_hombre) {
        var opcion = "editar_mobra";
        var parametros = {
            "m_obra": m_obra
            , "id_dserv": id_dserv
            , "id_tip": id_tip
            , "vr_mo": vr_mo
            , "h_hombre": h_hombre
            , "opcion": opcion
            , "id_srep": id_srep
        };
        $.ajax({
            data: parametros
            , url: 'flot-vserv_crud.php'
            , type: 'post'
            , beforeSend: function () {
                toastr.info('Espere un momento...','Informacion');
            }, success: function (info) {
                toastr.success('Tarea Asignada correctamente','Operacion');
                // var json_info = JSON.parse( info );
                console.log(info);
                $('#mod_mo_espact').modal('hide');
                listactesp();
            }
        });
    }

   //SCRIPT PARA CREAR UNA NUEVA ESPECIALIDAD/ACTIVIDAD
    function n_esp_act(sel_espc, sel_actv) {
        var id_serv = "<?php echo $id_serv; ?>";
        var opcion = "nespact"
        var parametros = {
            "sel_espc": sel_espc
            , "sel_actv": sel_actv
            , "id_serv": id_serv
            , "opcion": opcion
        };
        $.ajax({
            data: parametros
            , url: 'flot-vserv_crud.php'
            , type: 'post'
            , beforeSend: function () {
                toastr.info('Espere un momento...','Informacion');
            }, success: function (info) {
                toastr.success('Tarea Asignada correctamente','Operacion');
                // var json_info = JSON.parse( info );
                console.log(info);
                $('#mod_espact').modal('hide');
                listactesp();
            }
        });
    }

    //SCRIPT PARA EDITAR UNA NUEVA ESPECIALIDAD/ACTIVIDAD
    function edit_espact(id_dserv, sel_espc, sel_actv) {
        var id_serv = "<?php echo $id_serv; ?>";
        var opcion = "edit_espact"
        var parametros = {
            "sel_espc": sel_espc
            , "sel_actv": sel_actv
            , "id_dserv": id_dserv
            , "opcion": opcion
        };
        $.ajax({
            data: parametros
            , url: 'flot-vserv_crud.php'
            , type: 'post'
            , beforeSend: function () {
                toastr.info('Espere un momento...','Informacion');
            }, success: function (info) {
                toastr.success('Tarea Asignada correctamente','Operacion');
                // var json_info = JSON.parse( info );
                console.log(info);
                $('#mod_edit_espact').modal('hide');
                listactesp();
            }
        });
    }

     function eliminar_espact(id_dserv) {
        var opcion = "eliminar_dserv";
        var parametros = {
            "id_dserv": id_dserv
            ,"opcion": opcion
        };
        $.ajax({
            data: parametros
            , url: 'flot-vserv_crud.php'
            , type: 'post'
            , beforeSend: function () {
                toastr.info('Espere un momento...','Informacion');
            }, success: function (info) {
                toastr.success('Tarea Asignada correctamente','Operacion');
                // var json_info = JSON.parse( info );
                console.log(info);
                $('#mod_elim_espact').modal('hide');
                listactesp();
            }
        });
    }

    function eliminar_mo(id_srep_mo) {
        var opcion = "eliminar_mo";
        var parametros = {
            "id_srep": id_srep_mo
            ,"opcion": opcion
        };
        $.ajax({
            data: parametros
            , url: 'flot-vserv_crud.php'
            , type: 'post'
            , beforeSend: function () {
                toastr.info('Espere un momento...','Informacion');
            }, success: function (info) {
                toastr.success('Tarea Asignada correctamente','Operacion');
                // var json_info = JSON.parse( info );
                console.log(info);
                $('#mod_elim_espact').modal('hide');
                listactesp();
            }
        });
    }

    //SCRIPT PARA ELIMINAR UN REPUESTO DE UNA ESPECIALIDAD/ACTIVIDAD
    function eliminar_rep_actesp(id_srep) {
       
        var opcion = "eliminar_srep"
        var parametros = {
            "id_srep": id_srep
            , "opcion": opcion
        };
        $.ajax({
            data: parametros
            , url: 'flot-vserv_crud.php'
            , type: 'post'
            , beforeSend: function () {
                toastr.info('Espere un momento...','Informacion');
            }, success: function (info) {
                toastr.success('Tarea Asignada correctamente','Operacion');
                // var json_info = JSON.parse( info );
                console.log(info);
                $('#mod_eliminar_mo').modal('hide');
                listactesp();
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
    <script>

    // $(document).on("click", ".open-Modal", function () {
    // var myDNI = $(this).data('id');
    // $(".modal-body #DNI").val( myDNI );
    // });

    </script>
</body>
<!--  /Body -->
</html>
