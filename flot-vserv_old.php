<?php include("intro.php"); //pantallazo de carga del sitio ?>
<?php require_once("assets/includes/connection.php"); //Conexion a base de datos ?>
<?php
session_start();
$mflot="display: block;"; 
$id_serv = $_GET["id"];
$_SESSION["id_serv"] = $id_serv;

    //INGRESO DE VALORES DE MANO DE OBRA EN UNA ACTIVIDAD
    if (isset($_POST["subtmo"])){
        $id_tip=$_POST["id_tip"];
        $h_hombre=$_POST["h_hombre"];     
        $v_mo=$_POST["v_mo"];
        $id_dserv=$_POST["DNI"];
        $m_obra=$_POST["m_obra"];

        $sql = "INSERT INTO flot_srep (id_tip, id_dserv, h_hombre, v_mo, m_obra)" .
        "VALUES ($id_tip, $id_dserv, $h_hombre, $v_mo, $m_obra)";
        if ($conn->query($sql) === TRUE) {

            #echo "<div style='padding:20px 20px 0 20px' ><div class='alert alert-success fade in'><button class='close' data-dismiss='alert'>x</button>";
            #echo "<i class='fa-fw fa fa-check'></i><strong>Exito</strong> La tarea ha sido creada.</div></div>";

        }  else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }   
    }
	
	//INGRESO DE UNA NUEVA ESPECIALIDAD/ACTIVIDAD
    if (isset($_POST["subt1"])){
    $espc=$_POST['sel_espc'];
    $actvi=$_POST['sel_actv'];
    $sql = "INSERT INTO flot_dserv (id_serv, especialidad, actividad) VALUES ('$id_serv','$espc','$actvi')";

        if ($conn->query($sql) === TRUE) {

            #echo "<div style='padding:20px 20px 0 20px' ><div class='alert alert-success fade in'><button class='close' data-dismiss='alert'>x</button>";
            #echo "<i class='fa-fw fa fa-check'></i><strong>Exito</strong> La tarea ha sido creada.</div></div>";

        }  else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }   
    }

    //INGRESO DE INFORMACION ADICIONAL DEL SERVICIO PARA EL EQUIPO
    if (isset($_POST["subt2"])){
    $n_serv=$_POST['n_serv'];
    $n_ordn=$_POST['n_ordn'];
    $vr_fact=$_POST['vr_fact'];
    $n_fact=$_POST['n_fact'];
    $n_placa=$_POST['n_placa'];
    #$sql = "INSERT INTO flot_servicios (placa, no_serv, no_orden, vr_serv, no_fact ) VALUES ('$n_placa', '$n_serv','$n_ordn','$vr_fact','$n_fact') WHERE id_serv= $id_serv";
    $sql = "UPDATE flot_servicios SET placa = '$n_placa', no_serv='$n_serv', no_orden='$n_ordn', vr_serv='$vr_fact', no_fact='$n_fact'  WHERE id_serv= $id_serv";

        if ($conn->query($sql) === TRUE) {
        #echo "<div style='padding:20px 20px 0 20px' ><div class='alert alert-success fade in'><button class='close' data-dismiss='alert'>x</button>";
        #echo "<i class='fa-fw fa fa-check'></i><strong>Exito</strong> La tarea ha sido creada.</div></div>";

        }  else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>
<?php 

     
	//INGRESO DE UN REPUESTO A UNA ACTIVIDAD/ESPECIALIDAD
    if (isset($_POST['id_rep'])){
        
        $id_rep=$_POST["id_rep"];
        $cant=$_POST["cant"];     
        $v_mo=$_POST["v_mo"];
        $id_tip=$_POST["id_tip"];
        $id_dserv=$_POST["DNI"];
        $time= time();
        $f_coment= date("d-m-Y", $time);

        $sql = "INSERT INTO flot_srep (id_rep, id_dserv, cant, v_mo, id__tip)" .
        "VALUES ($id_rep, $id_dserv, $cant, $v_mo, $id_tip)";

        if ($conn->query($sql) === TRUE) {
            //VACIO
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    //INGRESO DE NUEVO REPUESTO
    if (isset($_POST['repuesto'])){
        
        $repuesto=$_POST["repuesto"];
        $vr_unit=$_POST["vr_unit"];     
        $unidad=$_POST["unidad"];
        $sql = "INSERT INTO flot_rep (repuesto, vr_unit, unidad)" .
        "VALUES ('$repuesto', $vr_unit, '$unidad')";

        if ($conn->query($sql) === TRUE) {

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }


    $variable ="SELECT * FROM  `flot_servicios`  WHERE  `id_serv` = $id_serv ";
    $result = $conn->query($variable);
    $row = mysqli_fetch_row($result);
    $numrow = mysqli_num_rows($result);
    // buscar equipo
    $mx=$row[3];
    $equipo = "SELECT * FROM  `flot_mx` WHERE `id_mx` = $mx";
    $reseq = $conn->query($equipo);
    $row7 = mysqli_fetch_row($reseq);
    $numrow2 = mysqli_num_rows($reseq);
    setlocale(LC_MONETARY, 'en_US');

    // buscar equipo fin
   
   if ($row[9] == "Entregado"){
    
        $c_st = "background-color:#008000";
        $sta = "disabled";
    
    }else{

        if ($row[9] == "Creado") {

            $c_st = "background-color:#f4b400";

        } else {

            $c_st = "background-color:#d73d32";

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
    <style>
                .btn.active {
            display: none;
        }
        .btn hover:nth-of-type(1) {
            display: none;
        }
        
        .btn hover:last-child {
            display: block;
        }
        
        .btn.active hover:nth-of-type(1) {
            display: block;
        }
        
        .btn.active hover:last-child {
            display: none;
        }
        
        .btn-5 {
            color: #fbfbfb;
            min-width: 100px;
            line-height: 17px;
            font-size: 16px;
            overflow: hidden;
            -webkit-backface-visibility: hidden;
            -moz-backface-visibility: hidden;
            backface-visibility: hidden;
            border-radius: 5%;
        }
        
        .btn-5a:hover span {
            -webkit-transform: translateY(300%);
            -moz-transform: translateY(300%);
            -ms-transform: translateY(300%);
            transform: translateY(300%);
        }
        
        .btn-5:active {
            background: #9053a9;
            top: 2px;
        }
        
        .btn-5 span {
            display: inline-block;
            width: 100%;
            height: 100%;
            -webkit-transition: all 0.3s;
            -webkit-backface-visibility: hidden;
            -moz-transition: all 0.3s;
            -moz-backface-visibility: hidden;
            transition: all 0.3s;
            backface-visibility: hidden;
        }
        
        .btn-5:before {
            color: #fbfbfb;
            background: #008000;
            position: absolute;
            height: 100%;
            width: 100%;
            line-height: 17px;
            font-size: 100%;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;
            line-height: 27px;
        }
        
        .btn-5:active:before {
            color: #703b87;
        }
        /* Button 5a */
        
        .btn-5a:hover span {
            -webkit-transform: translateY(300%);
            -moz-transform: translateY(300%);
            -ms-transform: translateY(300%);
            transform: translateY(300%);
        }
        
        .btn-5a:before {
            left: 0;
            top: -100%;
        }
        
        .btn-5a:hover:before {
            top: 0;
        }
        
        .icon-cart:before {
            content: "Entregado?";
        }


    </style>
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
                                    
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModanre"><i class="fa fa-cogs"></i> Nuevo Repuesto</button>
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModaln"><i class="fa fa-calculator"></i> Información cliente</button>
                                    <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Imprimir Tarea</button>
                                        
                                </div>
                                <div class="btn-group"  style="float:right;">
                                    <form name="stat_u" action="" method="post" style="<?php echo $confir ?>">
                                        <button id="stat_us" name="stat_us" class="btn btn-5 btn-5a icon-cart" style="<?php echo $c_st?>"<?php echo $sta ?>><span><?php echo $row[9]; ?></span></button>
                                    </form>
                                </div>
                                
                                
                                <!-- AQUI TRATÉ MOSTRAR EL ESTADO DEL SERVICIO DE OTRA MANERA: USANDO 3 BOTONES AGRUPADOS -->
                                <!--div class="btn-group" style="float:right;">
                                    
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModanre"><i class="fa fa-cogs"></i>Creado</button>
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModaln"><i class="fa fa-calculator"></i>Atrazado</button>
                                    <button type="button" class="btn btn-default"><i class="fa fa-print"></i>Entregado</button>
                                        
                                </div-->
                                
                                    
                                        
                                
                                    
                                    <div class="widget-buttons" style="float:right;">
                                                
                                            </div>
                                        <br><br>
                                                             
                                <table class="table " style="margin-bottom:20px;">
                                    
                                        <tr>
                                        <th>
                                                #Servicio Kael:
                                        </th>

                                        <td>
                                            <?php echo $row[0];?>         
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
                                                No Equipo:
                                        </th>

                                        <td>
                                            <?php echo $row7[1];?>        
                                        </td>
                                        <th>
                                                No Placa:
                                        </th>
                                        <td>
                                             <?php echo $row7[2];?>   
                                        </td>
                                        <th>
                                                Cliente:
                                        </th>
                                        <td>
                                            <?php echo $row7[3];?>  
                                        </td>
                                        </tr>
                                       <tr>
                                        <th>
                                                No Servicio:
                                        </th>

                                        <td>
                                            <?php echo $row[5];?>         
                                        </td>
                                        <th>
                                                No factura:
                                        </th>
                                        <td>
                                            <?php echo $row[8];?>   
                                        </td>
                                        <th>
                                                Vr Facturado:
                                        </th>
                                        <td>
                                            <?php echo money_format('%(#5n', $row[7]);?>   
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
                                                            <?php 
                                                                $sql4 = "SELECT * FROM flot_srep WHERE `id_dserv` = $id_dserv";
                                                                $result4 = $conn->query($sql4);
                                                               
                                                            ?>
                                                            

                                                            <!-- INICIO TABLA REPUESTO -->
                                                                <table class="table table-striped table-bordered table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                <i class="fa fa-gears"></i><?php echo  id_dserv;?> Repuesto
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
                                                                    <tbody><?php 
                                                                                if ($result4->num_rows > 0) { 
                                                                                while($row2 = $result4->fetch_assoc()) { 
                                                                                    $id_rep=$row2["id_rep"];
                                                                                    $variable2 ="SELECT * FROM  flot_rep WHERE  `id_rep` = $id_rep LIMIT 0 , 30";
                                                                                    $result2 = $conn->query($variable2);
                                                                                    $row3 = mysqli_fetch_row($result2); 
                                                                                    setlocale(LC_MONETARY, 'en_US');?>
                                                                        <tr>
                                                                            <td>
                                                                                <a href="#"><?php echo $row3[1]; ?></a>
                                                                            </td>
                                                                            <td class="hidden-xs">
                                                                                <?php echo $row2["cant"]; ?>
                                                                            </td>
                                                                            <?php $totrep=$row2["cant"]*$row3[2]; ?>
                                                                            <td>
                                                                                <?php echo money_format('%(#5n', $row3[2]); ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo money_format('%(#5n',$totrep); ?>                                                                            
                                                                            </td>
                                                                            <td class="hidden-xs">
                                                                                <?php echo money_format('%(#5n',$row2["v_mo"]); ?>
                                                                            </td>
                                                                            <?php $subtot= $totrep+$row2["v_mo"];?>
                                                                            <td>
                                                                                <?php echo money_format('%(#5n', $subtot); ?>
                                                                            </td>
                                                                            <td><?php $tot=$tot+$subtot;?>
                                                                                <a href="#" class="btn btn-default btn-xs purple"><i class="fa fa-edit"></i> Edit</a>
                                                                            </td>
                                                                        </tr> <?php }} ?>


                                                                        <!-- FIN TABLA REPUESTO -->
                                                                        
                                                                    </tbody>
                                                                </table><br>
                                                                 <button class="btn btn-default btn-xs purple" data-toggle="modal" data-target="#myModarep" onclick='$("#DNI").val("<?php echo $id_dserv?>")'><i class="fa fa-edit"></i> Ingresar respuesto</button>
                                                                <button class="btn btn-default btn-xs purple" data-toggle="modal" data-target="#myModamo" onclick='$("#DNI").val("<?php echo $id_dserv?>")'><i class="fa fa-users"></i> Ingresar mano de obra</button>
                                                            
                                                                
                                                                <hr class="wide">
                                                                <span>Total <?php  echo money_format('%(#5n', $tot);?></span>
                                                            </div><!--Widget Body-->
                                                                        
                                                        </div><!--Widget-->
                                                    </div>
                                                    <?php }} ?>
                                                    <!-- fin descripcion -->
                                                                   

                                                   
                                                </div><!--Widget Body Personal-->

                                                                      
                                   
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-labeled btn-blue" data-toggle="modal" data-target="#myModal1" ><i class="btn-label fa fa-plus"></i>Adicionar un elemento</button>
                                                
                                            </div><br> 
                                            <!-- modal inicio -->
                                            <div class="modal fade" id="myModamo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <h4 class="modal-title" id="myModalLabel">Información Mano de Obra</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="registration-form">
                                                                <form action="flot-vserv.php?id=<?php echo $id_serv?>" method="post" role="form">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            Mano de Obra
                                                                            <span class="input-icon ">

                                                                            <input type="text" name="m_obra" class="form-control" placeholder="<?php echo $row[5];?>" value="<?php echo $row[5];?>">
                                                                            <i class="fa fa-user"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-7">
                                                                        <div class="form-group">
                                                                            Vr mano de Obra
                                                                            <span class="input-icon ">
                                                                            <input type="hidden" name="DNI" id="DNI" class="form-control">
                                                                            <input type="hidden" name="id_tip" class="form-control" value="1">
                                                                            <input type="text" name="v_mo" class="form-control" placeholder="<?php echo $row[5];?>" value="<?php echo $row[5];?>">
                                                                            <i class="fa fa-dollar"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <div class="form-group">
                                                                            Horas/Hombre
                                                                            <span class="input-icon ">
                                                                                <input type="text" name="h_hombre" class="form-control" placeholder="<?php echo $row[6];?>" value="<?php echo $row[6];?>">
                                                                                <i class="fa fa-clock-o"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <hr>
                                                                    
                                                                    <br>
                                                                    <button type="submit" name="subtmo" class="btn btn-blue">Ingresar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>               
                                            <!-- fin modal  --> 

                                            <!-- modal inicio -->
                                                            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                  <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                      <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                          <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h4 class="modal-title" id="myModalLabel">Ingresar Nuevo Elemento</h4>
                                                                      </div>
                                                                      <!-- I N I C I O   MODAL CREAR ESPECIALIDAD/ACTIVIDAD #################################################-->
                                                                      <div class="modal-body">
                                                                                <div id="registration-form">
                                                                                    <form action="flot-vserv.php?id=<?php echo $id_serv ?>" method="post" role="form">
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
                                                                                       
                                                                                        <button type="submit" name="subt1" id="subt1" class="btn btn-blue">Ingresar</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                            <!-- F I N   MODAL CREAR ESPECIALIDAD/ACTIVIDAD #################################################-->
                                                                      
                                                                    </div>
                                                                  </div>
                                                                </div>

                                                            <!-- modal fin -->
                                             <!-- modal inicio -->
                                            <div class="modal fade" id="myModaln" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                                <form action="flot-vserv.php?id=<?php echo $id_serv?>" method="post" role="form">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            Número de Servicio
                                                                            <span class="input-icon ">

                                                                            <input type="text" name="n_serv" class="form-control" placeholder="<?php echo $row[5];?>" value="<?php echo $row[5];?>">
                                                                            <i class="fa fa-cog"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            Número de Orden
                                                                            <span class="input-icon ">
                                                                                <input type="text" name="n_ordn" class="form-control" placeholder="<?php echo $row[6];?>" value="<?php echo $row[6];?>">
                                                                                <i class="fa fa-cog"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            Vr. factura
                                                                            <span class="input-icon icon-right">
                                                                                    <input type="text" name="vr_fact" class="form-control" placeholder="<?php echo $row[7];?>" value="<?php echo $row[7];?>">
                                                                                    <i class="fa fa-dollar circular"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            Número factura
                                                                            <span class="input-icon icon-right">
                                                                                <input type="text" name="n_fact" class="form-control" id="emailInput" placeholder="<?php echo $row[8];?>" value="<?php echo $row[8];?>">
                                                                                <i class="fa fa-check-square-o"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- <div class="form-group">
                                                                            <span class="input-icon icon-right">
                                                                                <input type="text" name="n_placa" class="form-control"  placeholder="Numero de Placa">
                                                                                <i class="fa fa-check-square-o"></i>
                                                                            </span>
                                                                        </div> -->
                                                                    </div>
                                                                    <hr>
                                                                    <div class="col-sm-6"><span> </span></div>
                                                                    <br>
                                                                    <button type="submit" name="subt2" class="btn btn-blue">Ingresar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>               
                            <!-- fin modal  -->  
                            
                                                                                  
                                                 <!-- modal inicio -->
                                                            <div class="modal fade" id="myModanre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                  <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                      <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                          <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h4 class="modal-title" id="myModalLabel">Ingresar Repuesto</h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                                <div id="registration-form">
                                                                                    <form action="flot-vserv.php?id=<?php echo $id_serv?>" method="post" role="form">
                                                                                        <div class="col-sm-12">
                                                                                            <div class="form-group">
                                                                                                <span class="input-icon ">
                                                                                                    <input type="hidden" name="id_tip" class="form-control" value="0">
                                                                                                    <input type="text" name="repuesto" class="form-control" placeholder="Nombre Repuesto">
                                                                                                    <i class="fa fa-cog"></i>
                                                                                                    
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <div class="form-group">
                                                                                                <span class="input-icon icon-right">
                                                                                                    <input type="text" name="vr_unit" class="form-control" placeholder="Vr Unitario">
                                                                                                    <i class="fa fa-dollar circular"></i>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <div class="form-group">
                                                                                                <span class="input-icon icon-right">
                                                                                                    <input type="text" name="unidad" class="form-control" id="emailInput" placeholder="Unidad">
                                                                                                    <i class="fa fa-check-square-o"></i>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div><hr>
                                                                                       
                                                                                        <button type="submit" name="subt" class="btn btn-blue">Ingresar</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                      
                                                                      
                                                                    </div>
                                                                  </div>
                                                                </div>

                                                            <!-- modal fin -->
                                            <!-- modal inicio -->
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

                                <!-- modal fin -->
                                 
                                                
                     <!-- modal inicio -->
                               <div class="modal fade" id="myModanlre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Nuevo Repuesto</h4>
                                          </div>
                                          <div class="modal-body">
                                                    <div id="registration-form">
                                                        <form action="flot-vserv.php?id=<?php echo $id_serv?>" method="post" role="form">
                                                         <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <span class="input-icon icon-right">
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
                                                                    <div class="form-group">
                                                                        <span class="input-icon icon-right">
                                                                            <input type="text" name="unidad" class="form-control" placeholder="Unidad">
                                                                            <i class="fa fa-check-square-o"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        
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
                                  
                                  
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-*.min.js"></script>


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
     <script>
       
            // $(document).on("click", ".open-Modal", function () {
            // var myDNI = $(this).data('id');
            // $(".modal-body #DNI").val( myDNI );
            // });

     </script>
</body>
<!--  /Body -->
</html>
