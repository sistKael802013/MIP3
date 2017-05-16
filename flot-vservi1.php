<!--############################## INICIO PHP ######################################-->
<?php include("intro.php"); //pantallazo de carga del sitio ?>
<?php require_once("assets/includes/connection.php"); //Conexion a base de datos ?>
<?php 

session_start();
$mflot="display: block;"; 
$id_serv = $_GET["id"];      
$_SESSION['id_serv'] = $id_serv;

/*
/Ingresar 
if (isset($_POST['id_rep'])){

$id_rep=$_POST["id_rep"];
$cant=$_POST["cant"];     
$v_mo=$_POST["v_mo"];
$id_dserv=$_POST["DNI"];
$time= time();
$f_coment= date("d-m-Y", $time);

$sql_id_rep = "INSERT INTO flot_srep (id_rep, id_dserv, cant, v_mo)" .
"VALUES ($id_rep, $id_dserv, $cant, $v_mo)";

if ($conn->query($sql_id_rep) === TRUE) {
//VACIO
} else {
echo "Error: " . $sql_id_rep . "<br>" . $conn->error;
}
}
//Codigo para ingresar Repuestos a DB
if (isset($_POST['repuesto'])){

$repuesto=$_POST["repuesto"];
$vr_unit=$_POST["vr_unit"];     
$unidad=$_POST["unidad"];
$sql_repuesto = "INSERT INTO flot_rep (repuesto, vr_unit, unidad)" .
"VALUES ('$repuesto', $vr_unit, '$unidad')";

if ($conn->query($sql_repuesto) === TRUE) {

} else {
echo "Error: " . $sql_repuesto . "<br>" . $conn->error;
}
}
*/
//Consultar e imprimir detalles del servicio solicitado
$sql_id_serv ="SELECT * FROM  flot_servicios  WHERE  id_serv = $id_serv"; 
$result = $conn->query($sql_id_serv);
$row = mysqli_fetch_row($result);
$numrow = mysqli_num_rows($result);


if ($row[8]== "En Curso") {
$label="yellow";
} else{
if ($row[8]=="Atrazada") {
$label = "red";
} else {
$label = "blue";

}
}

?>

<!--############################## FIN PHP ######################################-->  

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
    <title>Dashboard - Flotas</title>
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
    <!-- archivos jQuery -->
    <link href="http://hayageek.github.io/jQuery-Upload-File/4.0.10/uploadfile.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://hayageek.github.io/jQuery-Upload-File/4.0.10/jquery.uploadfile.min.js"></script>
    <!--Page Related styles-->
    <link href="assets/css/dataTables.bootstrap.css" rel="stylesheet" />
    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="assets/js/skins.min.js"></script>
    
   
    
</head>
<!-- /Head -->
<!-- Body -->
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
                <li> <i class="fa fa-home"></i> <a href="#">Home</a> </li>
                <li class="active">Flotas</li>
            </ul>
        </div>
        <div class="page-header position-relative">
            <div class="header-title">
                <h1>
                    Ver Servicio
                </h1> 
            </div>
            <div class="header-buttons">
                <a class="sidebar-toggler" href="#"> <i class="fa fa-arrows-h"></i> </a>
                <a class="refresh" id="refresh-toggler" href=""> <i class="glyphicon glyphicon-refresh"></i> </a>
                <a class="fullscreen" id="fullscreen-toggler" href="#"> <i class="glyphicon glyphicon-fullscreen"></i> </a>
            </div>
        </div>
        <div class="page-body">
            <div class="well with-header  with-footer">
                <div class="header bg-blue">
                Flotas/Servicio
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModanre"><i class="fa fa-cogs"></i> Nuevo Repuesto</button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#mod_inf_adc"><i class="fa fa-calculator"></i> Información adicional del cliente</button>
                    <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Imprimir Tarea</button>
                </div>
                <div class="widget-buttons" style="float:right;">
                    <div class="btn-group">
                        <a class="btn btn-<?php echo $label ?> btn-sm " id="sizevalue" href="javascript:void(0);">
                            <?php echo $row[9];?>
                        </a> <a class="btn btn-<?php echo $label ?> btn-sm dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-angle-down"></i></a>
                        <ul id="stadolist" class="dropdown-menu dropdown-<?php echo $label ?> pull-left">
                            <li> <a datavalue="En Curso" href="javascript:;">En Curso</a> </li>
                            <li> <a datavalue="Atrazada" href="javascript:void(0);">Atrazada</a> </li>
                            <li> <a datavalue="Entregado" href="javascript:void(0);">Entregado</a> </li>
                        </ul>
                    </div>
                </div>
                <br>
                <br>
                <!-- LLAMADO DE TABLA CON DETALLES DEL SERVICIO IMPLEMENTANDO FUNCION 'tiempoReal' -->
                <section id="miTabla"></section>
                <div class="">
                   
                    <?php 
                    $sql3 = "SELECT * FROM `flot_dserv` WHERE `id_serv` = $id_serv";
                    $result3 = $conn->query($sql3);
                    ?>
                    <?php
                    if ($result3->num_rows > 0) { 
                    while($row1 = $result3->fetch_assoc()) { 
                    $tot=0;
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
                                <span class="widget-caption">
                                    <?php echo $row1["especialidad"]; ?> / <?php echo $row1["actividad"]; ?> 
                                </span>
                                <div class="widget-buttons buttons-bordered">
                                    <span class="label label-info">
                                        <?php echo $row1["actividad"]; ?>
                                    </span>
                                </div>
                            </div><!--Widget Header-->
                            <div class="widget-body bordered-left bordered-<?php echo $label?>">
                            <!-- INICIO TABLA REPUESTOS -->
                                <table id="tabl" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th> <i class="fa fa-gears"></i> Repuesto </th>
                                            <th class="hidden-xs"> <i class="fa fa-reorder"></i> Cant </th>
                                            <th> <i class="fa fa-dollar"></i> Vr Unit </th>
                                            <th class="hidden-xs"> <i class="fa fa-dollar"></i> Tot Rep </th>
                                            <th> <i class="fa fa-user"></i> Vr Mano Obra </th>
                                            <th> <i class="fa fa-dollar"></i> Sub Total </th>
                                            <th> <i class="fa fa-wrench"></i> Acciones </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <br>
                                <button class="btn btn-default btn-xs purple" data-toggle="modal" data-target="#myModarep" onclick='$("#DNI").val("<?php echo $id_dserv?>")'><i class="fa fa-edit"></i> Ingresar respuesto</button>
                                <hr class="wide"> <span>Total <?php echo money_format('%(#5n', $tot);?></span> 
                            </div>
                        </div>
                    </div>
                    <?php }} ?>
                </div>
                <!-- FIN TABLA DE REPUESTOS -->
                <div class="btn-group">
                    <button type="button" class="btn btn-labeled btn-blue" data-toggle="modal" data-target="#myModal1" ><i class="btn-label fa fa-plus"></i>Adicionar un elemento</button>
                </div>
                <br> 

                <!-- INICIO MODAL CREAR ESPECIALIDAD/ACTIVIDAD -->
                <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                            <select name="sel_espc" id="sel_espc" style="width:100%;">
                                                <option value="Engrase">Engrase</option>
                                                <option value="Mecánico">Mecánico</option>
                                                <option value="Metalmecánico">Metalmecánico</option>
                                                <option value="Eléctrico">Eléctrico</option>
                                                <option value="Latonería">Latonería</option>
                                                <option value="Muelles y Suspensión">Muelles y Suspensión</option>
                                                <option value="Neumático">Neumático</option>
                                                <option value="Hidráulio">Hidráulio</option>
                                                <option value="Cauchos">Cauchos</option>
                                                <option value="Valvulas">Valvulas</option>
                                                <option value="Pintura">Pintura</option>
                                                <option value="Trabajos Mayor">Trabajos Mayor</option>
                                            </select>
                                            <!-- vvvvvvvvvvv -->
                                        </div>
                                        <hr>
                                        <div class="form-title"> Actividad: </div>
                                        <div class="form-group">
                                            <!-- vvvvvvvvvvv -->
                                            <select name="sel_actv" id="sel_actv" style="width:100%;">
                                                <option value="Suministro">Suministro</option>
                                                <option value="Instalacion">Instalacion</option>
                                                <option value="Suministro y Instalación">Suministro e Instalación</option>
                                                <option value="Reparación">Reparación</option>
                                                <option value="Mantenimiento">Mantenimiento</option>
                                            </select>
                                            <!-- vvvvvvvvvvv -->
                                        </div>
                                        <hr>
                                        <input type="button" href="javascript:;" onclick="realizaProceso($('#sel_espc').val(), $('#sel_actv').val());return false;" name="sut" id="sut" class="btn btn-blue" value="Ingresar" /> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- F I N   MODAL CREAR ESPECIALIDAD/ACTIVIDAD -->


                <!-- I N I C I O MODAL INFORMACION ADICIONAL -->
                <div class="modal fade" id="mod_inf_adc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Información Adicional</h4>
                            </div>
                            <div class="modal-body">
                                <div id="registration-form">
                                    <form action="#" method="post" role="form" class="modalForm">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            Número de Servicio
                                                <span class="input-icon ">
                                                    <input type="text" name="n_serv" id="n_serv" class="form-control" placeholder="<?php echo $row[5];?>" >
                                                    <i class="fa fa-cog"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            Número de Orden
                                                <span class="input-icon ">
                                                    <input type="text" name="n_ordn" id="n_ordn" class="form-control" placeholder="<?php echo $row[6];?>" >
                                                    <i class="fa fa-cog"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                Vr. factura
                                                <span class="input-icon icon-right">
                                                    <input type="text" name="vr_fact" id="vr_fact" class="form-control" placeholder="<?php echo $row[7];?>" >
                                                    <i class="fa fa-dollar circular"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            Número factura
                                                <span class="input-icon icon-right">
                                                    <input type="text" name="n_fact" id="n_fact" class="form-control" placeholder="<?php echo $row[8];?>" >
                                                    <i class="fa fa-check-square-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
                                        <!--button type="submit" name="subt2" class="btn btn-blue">Ingresar</button-->
                                        <input type="button" href="javascript:;" onclick="guardaDetllAdc($('#n_serv').val(), $('#n_ordn').val(), $('#vr_fact').val(), $('#n_fact').val());return false;" name="sut1"  id="sut1" class="btn btn-blue" value="Ingresar"/>
                                    </form>
                                </div>
                            </div>
                            <div  class="modal-footer well">
                                <div id="resultado" style="float:left;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- F I N MODAL INFORMACION ADICIONAL --> 

                <!-- modal inicio -->
                <div class="modal fade" id="myModanre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <h4 class="modal-title" id="myModalLabel">Ingresar Repuesto</h4> 
                            </div>
                            <div class="modal-body">
                                <div id="registration-form">
                                    <form action="flot-vserv.php?id=<?php echo $id_serv?>" method="post" role="form">
                                        <div class="col-sm-12">
                                            <div class="form-group"> <span class="input-icon ">
                                                <input type="text" name="repuesto" class="form-control" placeholder="Nombre Repuesto">
                                                <i class="fa fa-cog"></i>
                                                </span> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <span class="input-icon icon-right">
                                                <input type="text" name="vr_unit" class="form-control" placeholder="Vr Unitario">
                                                <i class="fa fa-dollar circular"></i>
                                                </span> 
                                           </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <span class="input-icon icon-right">
                                                <input type="text" name="unidad" class="form-control" id="emailInput" placeholder="Unidad">
                                                <i class="fa fa-check-square-o"></i>
                                                </span> 
                                            </div>
                                        </div>
                                        <hr>
                                        <button type="submit" name="subt" class="btn btn-blue">Ingresar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal fin -->

                <!-- INICIO MODAL PARA EDICION DE REPUESTO -->
				<div>
                <form id="form_editar" action="#" method="post" role="form">
	                <div class="modal fade" id="mod_edit_rep" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	                    <div class="modal-dialog" role="document">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
	                                <h4 class="modal-title" id="myModalLabel">Editar Informacion del Repuesto</h4> 
	                            </div>
	                            <input type="hidden" id="id_srep" name="id_srep" value="0">
	                            <input type="hidden" id="opcion" name="opcion" value="modificar">
	                            <div class="modal-body">
	                                <div id="registration-form">
	                                    
	                                        <div class="col-sm-6">
	                                        Valor mano de obra:
	                                            <div class="form-group"> <span class="input-icon icon-right">
	                                                <input type="text" id="v_mo" name="v_mo" class="form-control" placeholder="Vr Unitario">
	                                                <i class="fa fa-dollar circular"></i>
	                                                </span> 
	                                           </div>
	                                        </div>
	                                        <div class="col-sm-6">
	                                        Cantidad:
	                                            <div class="form-group"> <span class="input-icon icon-right">
	                                                <input type="text" id="cant" name="cant" class="form-control" placeholder="Unidad">
	                                                <i class="pie-chart"></i>
	                                                </span> 
	                                            </div>
	                                        </div>
	                                        <hr>
	                                        <button type="submit" id="subt_edit" name="subt_edit" class="btn btn-blue">Ingresar</button>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </form>
				</div>
                <!-- INICIO MODAL PARA EDICION DE REPUESTO -->

                <!-- INICIO MODAL ELIMINAR REPUESTO -->
                <div>
                    <form id="form_eliminar" action="" method="POST">
                        <input type="hidden" id="id_srep" name="id_srep" value="">
                        <input type="hidden" id="opcion" name="opcion" value="eliminar">
                        <!-- Modal -->
                        <div class="modal fade" id="mod_eliminar_rep" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="modalEliminarLabel">Eliminar repuesto</h4>
                                    </div>
                                    <div class="modal-body">                            
                                        ¿Está seguro de eliminar este repuesto?<strong data-name=""></strong>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="eliminar_repuesto" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                    </form>
                </div>
                <!-- FIN MODAL ELIMINAR REPUESTO -->

                <!-- INICIO MODAL PARA INGRESAR REPUESTO A SERVICIO ############# -->
                <div class="modal fade" id="myModarep" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="modal-body">
                                    <div id="registration-form">
                                        <form action="flot-vserv.php?id=<?php echo $id_serv?>" method="post" role="form">
                                            <div class="form-title">
                                            Elija un Material o Insumo
                                            </div>
                                            <div class="form-group">
                                            <!-- vvvvvvvvvvv -->
                                            <?php 
                                            $sql2 = "SELECT  * FROM flot_rep";
                                            $result2 = $conn->query($sql2);
                                            if ($result2->num_rows > 0) { ?>
                                            <select name="id_rep" style="width:100%;" sized="4">
                                            <?php while($row2 = $result2->fetch_assoc()) {?>
                                            <option value="<?php echo $row2["id_rep"]; ?>" /><?php echo $row2["repuesto"]; ?>
                                            <?php  } ?> 
                                            </select>
                                            <?php }?>
                                            <!-- vvvvvvvvvvv -->
                                            </div>
                                            <div class="form-title">
                                            </div>
                                            <input type="hidden" name="DNI" id="DNI" class="form-control">
                                            <div class="row">
                                                <!-- <div class="col-sm-6">
                                                <div class="form-group">
                                                <span class="input-icon ">
                                                <input type="text" name="vrrep" class="form-control" placeholder="Vr Unitario">
                                                <i class="fa fa-dollar circular"></i>
                                                </span>
                                                </div>
                                                </div> -->
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <span class="input-icon icon-right">
                                                            <input type="text" name="cant" class="form-control" placeholder="Cantidad">
                                                            <i class="fa fa-check-square-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <span class="input-icon icon-right">
                                                            <input type="text" name="v_mo" class="form-control" id="emailInput" placeholder="Vr Mano de Obra">
                                                            <i class="fa fa-dollar circular "></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="repuestos" class="btn btn-blue">Ingresar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FINAL MODAL PARA INGRESAR REPUESTO A SERVICIO ############# -->
                    <!-- INICIO MODAL PARA INGRESAR NUEVO REPUESTO ############# -->                    
                    <div class="modal fade" id="myModanlre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                    <h4 class="modal-title" id="myModalLabel">Nuevo Repuesto</h4> 
                                </div>
                                <div class="modal-body">
                                    <div id="registration-form">
                                        <form action="flot-vserv.php?id=<?php echo $id_serv?>" method="post" role="form">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group"> <span class="input-icon icon-right">
                                                        <input type="text" name="repuesto" class="form-control" id="" placeholder="Nombre Repuesto">
                                                            <i class="fa fa-line-chart "></i>
                                                        </span> 
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group"> 
                                                    <span class="input-icon ">
                                                        <input type="text" name="vr_unit" class="form-control" placeholder="Vr Unitario">
                                                        <i class="fa fa-dollar circular"></i>
                                                    </span> 
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group"> <span class="input-icon icon-right">
                                                        <input type="text" name="unidad" class="form-control" placeholder="Unidad">
                                                            <i class="fa fa-check-square-o"></i>
                                                        </span>
                                                    </div>
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
                    <!-- FINAL MODAL PARA INGRESAR NUEVO REPUESTO ############# -->
                </div>
            </div>
        </div>  
    </div>




</body>

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
        
    //SCRIPT PARA CREAR UNA NUEVA ESPECIALIDAD/ACTIVIDAD
    function realizaProceso(valorCaja1, valorCaja2) {
        var parametros = {
            "valorCaja1": valorCaja1
            , "valorCaja2": valorCaja2
        };
        $.ajax({
            data: parametros
            , url: 'saveedit.php'
            , type: 'post'
            , beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
            }
            , success: function (response) {
                $("#resultado").html(response);
            }
        });
    }
        
</script>
    
    <!-- SCRIPT PARA DATATABLE ACTIVIDAD/ESPECIALIDAD -->
    <script>
    
        $(document).on("ready", function(){
            listar();
            listar();
            guardar();
            eliminar();
            tiempoReal();

        });        

       $("#4").on("click", function(){
        listar();
       });
        
    //SCRIPT PARA CARGAR LA TABLA CON LOS DETALLES DEL SERVICIO 
       function tiempoReal() {
            var tabla = $.ajax({
                url: 'flot-vserv_detlladc.php'
                , dataType: 'text'
                , async: false
            }).responseText;
            document.getElementById("miTabla").innerHTML = tabla;
        }

        //SCRIPT PARA GUARDAR INFORMACION ADICIONAL
        function guardaDetllAdc(n_serv, n_ordn, vr_fact, n_fact) {
            var param = {
                "n_serv": n_serv
                , "n_ordn": n_ordn
                , "vr_fact": vr_fact
                , "n_fact": n_fact
            };
            $.ajax({
                data: param
                , url: 'saveedit2.php'
                , type: 'post'
                , beforeSend: function () {
                    toastr.info('Espere un momento....','Informacion');
                }, success: function (response) {
                    toastr.success('El registro fue editado correctamente.','Operacion');
                    $('#mod_inf_adc').modal('hide');
                    tiempoReal();

                }
            });
        }

        var guardar = function(){
            $("form").on("submit", function(e){
                e.preventDefault();
                var frm = $("#form_editar").serialize();
                $.ajax({
                    method: "POST",
                    url: "guardar.php",
                    data: frm
                }).done( function( info ){
                	var json_info = JSON.parse( info );

                    console.log( json_info );
                    limpiar_datos();
                    listar();
                    toastr.options = {
                        "positionClass": "toast-bottom-right",
                    }
                    $('#mod_edit_rep').modal('hide');
                    toastr.success('El registro fue editado correctamente.','Operacion');
                });
            });
        }

        var eliminar = function(){
            $("#eliminar_repuesto").on("click", function(){
                var id_srep = $("#form_eliminar #id_srep").val(),
                    opcion = $("#form_eliminar #opcion").val();
                $.ajax({
                    method:"POST",
                    url: "guardar.php",
                    data: {"id_srep": id_srep, "opcion": opcion}
                }).done( function( info ){
                    var json_info = JSON.parse( info );
                    console.log(json_info);
                    listar();
                    toastr.success('Repuesto eliminado correctamente.','Operacion');
                });
            });
        }
       

        //FUNCION 'listar' IMPRIME LOS REGISTROS (REPUESTOS) DE UNA ACTIVIDAD/ESPECIALIDAD
        var listar = function(){
            var table = $("#tabl").DataTable({
                "paging":   false,
                "ordering": false,
                "info":     false,
                "searching": false,
                "autoWidth": false,
                "destroy":true,
                "ajax":{
                  "method":"POST",
                    "url": "listar.php"
                },
                "columns":[


                    {"data":"repuesto"},
                    {"data":"cant"},
                    {"data":"vr_unit", render: $.fn.dataTable.render.number( ',', '.', 0, '$' )},
                    {"data":"totrep",  render: $.fn.dataTable.render.number( ',', '.', 0, '$' )},
                    {"data":"v_mo",  render: $.fn.dataTable.render.number( ',', '.', 0, '$' )},
                    {"data":"subtot",  render: $.fn.dataTable.render.number( ',', '.', 0, '$' )},
                    {"defaultContent": "<button type='button' class='editar btn btn-default' data-toggle='modal' data-target='#mod_edit_rep'><i class='fa fa-edit'></i></button>  <button type='button' class='eliminar btn btn-default' data-toggle='modal' data-target='#mod_eliminar_rep'><i class='fa fa-trash-o'></i></button>"}
                   
                ]
                                
            });
            obtener_data_editar("#tabl tbody", table);
            obtener_id_eliminar("#tabl tbody", table);
        }
        
        //LA VARIABLE 'obtener_data_editar' CAPTURA LOS VALORES DEL REGISTRO SELECCIONADO
        var obtener_data_editar = function(tbody, table){
            $(tbody).on("click","button.editar", function(){
                var data = table.row( $(this).parents("tr") ).data();
                var id_srep = $("#id_srep").val(data.id_srep), 
                    repuesto = $("#repuesto").val(data.repuesto), 
                    v_mo = $("#v_mo").val(data.v_mo), 
                    cant = $("#cant").val(data.cant),
                    opcion = $("#opcion").val("modificar");
                    console.log(data);
                  
            });
        }

        //LA VARIABLE 'obtener_id_eliminar' SELECCIONA EL id (REPUESTO) A ELIMINAR
        var obtener_id_eliminar = function(tbody, table){
            $(tbody).on("click","button.eliminar", function(){
                var data = table.row( $(this).parents("tr") ).data();
                var id_srep = $("#form_eliminar #id_srep").val(data.id_srep);
                
                console.log(id_srep);
            });
        }

        var limpiar_datos = function(){
            $("#opcion").val("modificar");
            $("#id_srep").val("");
            $("#v_mo").val("")
            $("#cant").val("");
        }


    </script>
    
<script>
    //--Jquery Select2--
    $("#e1").select2();
    $("#e3").select2();
    $("#e4").select2();
    $("#e2").select2({
        placeholder: "Select a State"
        , allowClear: true
    });
    //--Bootstrap Date Picker--
    $('.date-picker').datepicker();
    //--Bootstrap Time Picker--
    $('#timepicker1').timepicker();
    //--Bootstrap Date Range Picker--
    $('#reservation').daterangepicker();
    //--JQuery Autosize--
    $('#textareaanimated').autosize({
        append: "\n"
    });
    //--Fuelux Spinbox--
    $('.spinbox').spinbox();
    //--jQuery MiniColors--
    $('.colorpicker').each(function () {
        $(this).minicolors({
            control: $(this).attr('data-control') || 'hue'
            , defaultValue: $(this).attr('data-defaultValue') || ''
            , inline: $(this).attr('data-inline') === 'true'
            , letterCase: $(this).attr('data-letterCase') || 'lowercase'
            , opacity: $(this).attr('data-opacity')
            , position: $(this).attr('data-position') || 'bottom left'
            , change: function (hex, opacity) {
                if (!hex) return;
                if (opacity) hex += ', ' + opacity;
                try {
                    console.log(hex);
                }
                catch (e) {}
            }
            , theme: 'bootstrap'
        });
    });
    //---Jquery Knob--
    $(".knob").knob();
    //---noUiSlider--
    $("#sample-minimal").noUiSlider({
        range: [0, 100]
        , start: [20, 80]
        , connect: true
        , serialization: {
            mark: ','
            , resolution: 0.1
            , to: [[$("#minimal-label1"), 'html']
                   , [$('#minimal-label2'), 'html']]
        }
    });
    $("#sample-onehandle").noUiSlider({
        range: [20, 100]
        , start: 40
        , step: 20
        , handles: 1
        , connect: "lower"
        , serialization: {
            to: [$("#low"), 'html']
        }
    });
    $("#sample-onehandle-upper").noUiSlider({
        range: [20, 100]
        , start: 70
        , step: 20
        , handles: 1
        , connect: "upper"
        , serialization: {
            to: [$("#low"), 'html']
        }
    });
    $('.slider').noUiSlider({
        range: [0, 255]
        , start: 127
        , handles: 1
        , connect: "lower"
        , orientation: "vertical"
        , serialization: {
            resolution: 1
        }
        , slide: function () {
            var color = 'rgb(' + $("#red").val() + ',' + $("#green").val() + ',' + $("#blue").val() + ')';
            $(".result").css({
                background: color
                , color: color
            });
        }
    });
    $(".sized-slider").noUiSlider({
        range: [0, 100]
        , start: 50
        , handles: 1
        , connect: "lower"
        , serialization: {
            to: [$("#low"), 'html']
        }
    });
    $(".colored-slider").noUiSlider({
        range: [0, 100]
        , start: 30
        , handles: 1
        , connect: "lower"
        , serialization: {
            to: [$("#low"), 'html']
        }
    });
    //--jQRangeSlider--
    $(".sized-rangeslider").rangeSlider();
    $(".colored-rangeslider").rangeSlider();
    $("#rangeslider").rangeSlider();
    $("#editrangeslider").editRangeSlider();
    $("#daterangeslider").dateRangeSlider();
    $("#noarrowsrangeslider").rangeSlider({
        arrows: false
    });
    $("#boundsrangeslider").rangeSlider({
        bounds: {
            min: 10
            , max: 90
        }
    });
    $("#dvrangeslider").rangeSlider({
        defaultValues: {
            min: 13
            , max: 66
        }
    });
    $("#delayrangeslider").rangeSlider({
        valueLabels: "change"
        , delayOut: 4000
    });
    $("#durationrangeslider").rangeSlider({
        valueLabels: "change"
        , durationIn: 1000
        , durationOut: 1000
    });
    $("#disabledrangeslider").rangeSlider({
        enabled: false
    });
    $("#steprangeslider").rangeSlider({
        step: 10
    });
    $("#labelsrangeslider").rangeSlider({
        valueLabels: "hide"
    });
    $("#simlescalesrangeslider").rangeSlider({
        scales: [
            // Primary scale
            {
                first: function (val) {
                    return val;
                }
                , next: function (val) {
                    return val + 10;
                }
                , stop: function (val) {
                    return false;
                }
                , label: function (val) {
                    return val;
                }
                , format: function (tickContainer, tickStart, tickEnd) {
                    tickContainer.addClass("myCustomClass");
                }
            }
            , // Secondary scale
            {
                first: function (val) {
                    return val;
                }
                , next: function (val) {
                    if (val % 10 === 9) {
                        return val + 2;
                    }
                    return val + 1;
                }
                , stop: function (val) {
                    return false;
                }
                , label: function () {
                    return null;
                }
            }]
    });
    var months = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sept", "Oct", "Nov", "Dic"];
    $("#dateRulersExample").dateRangeSlider({
        bounds: {
            min: new Date(2012, 0, 1)
            , max: new Date(2012, 11, 31, 12, 59, 59)
        }
        , defaultValues: {
            min: new Date(2012, 1, 10)
            , max: new Date(2012, 4, 22)
        }
        , scales: [{
            first: function (value) {
                return value;
            }
            , end: function (value) {
                return value;
            }
            , next: function (value) {
                var next = new Date(value);
                return new Date(next.setMonth(value.getMonth() + 1));
            }
            , label: function (value) {
                return months[value.getMonth()];
            }
            , format: function (tickContainer, tickStart, tickEnd) {
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


<!--  /Body -->
</html>