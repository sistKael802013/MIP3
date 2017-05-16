<?php
include("intro.php");
require_once("assets/includes/connection.php");
?>

<?php
$variable ="SELECT * FROM tareas WHERE id_tarea = $id_tarea";
    $result = $conn->query($variable);
    $row = mysqli_fetch_row($result);
    $numrow = mysqli_num_rows($result);

    if ($row[8] == "Entregado"){
    
        $c_st = "background-color:#008000";
        $sta = "disabled";
    
    }else{

        if ($row[8] == "En Curso") {

            $c_st = "background-color:#f4b400";

        } else {

            $c_st = "background-color:#d73d32";

        }

    }

    $nickusu = $_SESSION["nick"];
    if($row[5] != $nickusu ){
        $confir = "visibility:hidden";
    }else{
        $confir = "visibility:visible";
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
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />

    <!-- Datatable -->
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link href="assets/css/datatable/dataTables.bootstrap.css" rel="stylesheet" />
    
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

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
                            Servicios
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
                <?php //$_SERVER["REQUEST_METHOD"] == "POST")
                if (isset($_POST["submit1"])){
                    $p_creatarea= $_SESSION["nick"];
                    $mx=$_POST["mx"];
                    // $no_serv=$_POST["no_serv"];
                    
                    
                    $sql = "INSERT INTO `flot_servicios` (fecha_ing ,fecha_ent, comentario ,status ,mx, no_serv) " .
                    "VALUES ('$fecha_ing','$fecha_ent', '$comentario', '$status', '$mx', '$no_serv')";
                    if ($conn->query($sql) === TRUE) {
                        // echo "<div style='padding:20px 20px 0 20px' ><div class='alert alert-success fade in'><button class='close' data-dismiss='alert'>x</button>";
                        // echo "<i class='fa-fw fa fa-check'></i><strong>Exito</strong> La tarea ha sido creada.</div></div>";
                    }  else {
                    echo "Error r: " . $sql . "<br>" . $conn->error;
                    }
                }  
                    if (isset($_POST["submit2"])){
                    $no_equipo= $_POST["no_equipo"];
                    $cliente= $_POST["cliente"];
                    $no_placa=$_POST["no_placa"];
                    $sql = "INSERT INTO `flot-mx` (mx ,placa, cliente) " .
                    "VALUES ('$no_equipo', '$no_placa', '$cliente')";
                
                    if ($conn->query($sql) === TRUE) {
                        // echo "<div style='padding:20px 20px 0 20px' ><div class='alert alert-success fade in'><button class='close' data-dismiss='alert'>x</button>";
                        // echo "<i class='fa-fw fa fa-check'></i><strong>Exito</strong> La tarea ha sido creada.</div></div>";
                    }  else {
                    echo "Error r: " . $sql . "<br>" . $conn->error;
                    }
                    }
                ?>
                <!-- inicio cuerpo -->
                <div class="page-body">
                    <div class="btn-group" style="padding-bottom:10px;">
                        <button type="button" class="btn btn-labeled btn-blue" data-toggle="modal" data-target="#mod_agregar_serv"><i class="btn-label fa fa-plus"></i>Adicionar un Servicio</button>&nbsp;&nbsp;
                        <button type="button" class="btn btn-labeled btn-blue" data-toggle="modal" data-target="#mod_agregar_eq"><i class="btn-label fa fa-plus"></i>Adicionar un Equipo</button>       
                    <br></div>

                    
                        <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="widget">
                                <!-- <div class="widget-header ">
                                    <span class="widget-caption">Listado de Tareas</span>
                                    <div class="widget-buttons">
                                        <a href="#" data-toggle="maximize">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                        <a href="#" data-toggle="collapse">
                                            <i class="fa fa-minus"></i>
                                        </a>
                                        
                                    </div>
                                </div> -->
                                <!-- inicio tabla -->
                                  <div class="widget-body">
                                    
                                    <div id="flot_serv_list"></div>
                                  
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin cuerpo -->
            </div>
            <!-- /Page Content -->

            <!-- INICIO MODAL CREAR SERVICIO #################################################-->
            <div class="modal fade" id="mod_agregar_serv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            <h4 class="modal-title" id="myModalLabel">Crear Servicio</h4> </div>
                        <div class="modal-body">
                            <div id="registration-form">
                                <form action="flot-serv.php" method="post" role="form">
                                    <div class="form-title"> Número de Servicio </div>
                                    <div class="form-group"> 
                                        <span class="input-icon icon-right">
                                            <input type="text" id="no_serv" name="no_serv" class="form-control" placeholder="# Servicio">
                                            <i class="fa fa-user"></i>
                                        </span> 
                                    </div>
                                    <div class="form-title"> Equipo </div>
                                    <!-- xxx asignar -->
                                    <div class="">
                                        <?php 
                                            $sql2 = "SELECT * FROM  `flot_mx`";
                                            $result2 = $conn->query($sql2);
                                            if ($result2->num_rows > 0) { 
                                        ?>
                                        
                                            <select  style="width:100%;" id="mx" name="mx"  required>
                                                <option value="">Selecciona # Equipo</option>
                                                <?php while($row2 = $result2->fetch_assoc()) {?>
                                                    <option value="<?php echo $row2["id_mx"]; ?>" />
                                                    <?php echo $row2["mx"]; ?>
                                                        <?php  } ?>
                                            </select><i class="form-control-feedback" data-bv-field="country" style="display: none;"></i> </div>
                                    <?php }?>
                            </div>
                            <br>
                            <!-- xxx fin asignar -->
                             <div class="form-title"> Fecha estimada entrega </div>
                            
                            
                            <div class="input-group">
                                                <input class="form-control date-picker" name="fecha_ent" id="fecha_ent" type="text" data-date-format="dd-mm-yyyy">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                            <div class="form-title"> Comentario Labor </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="comentario" class="form-control" rows="6" id="comentario" placeholder="Su descripción aqui!" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="button" href="javascript:;" onclick="guardar_servicio($('#no_serv').val(), $('#mx').val(), $('#fecha_ent').val(), $('#comentario').val());return false;" name="sut1"  id="sut1" class="btn btn-blue" value="Ingresar"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>		
            <!-- FIN MODAL CREAR SERVICIO #################################################-->

            <!-- INICIO MODAL EDITAR SERVICIO #################################################-->
            <div class="modal fade" id="mod_editar_serv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            <h4 class="modal-title" id="myModalLabel">Editar Servicio</h4> </div>
                        <div class="modal-body">
                            <div id="registration-form">
                                <form action="flot-serv.php" method="post" role="form">
                                    <div class="form-title"> Número de Servicio </div>
                                    <div class="form-group"> 
                                        <span class="input-icon icon-right">
                                        <input type="hidden" name="id_serv_ed" id="id_serv_ed" class="form-control">
                                            <input type="text" id="no_serv_ed" name="no_serv_ed" class="form-control" placeholder="# Servicio">
                                            <i class="fa fa-user"></i>
                                        </span> 
                                    </div>
                                    <div class="form-title"> Equipo </div>
                                    <!-- xxx asignar -->
                                    <div class="">
                                        <?php 
                                            $sql2 = "SELECT * FROM  `flot_mx`";
                                            $result2 = $conn->query($sql2);
                                            if ($result2->num_rows > 0) { 
                                        ?>
                                        
                                            <select  style="width:100%;" id="mx_ed" name="mx"  required>
                                                <option value="">Selecciona # Equipo</option>
                                                <?php while($row2 = $result2->fetch_assoc()) {?>
                                                    <option value="<?php echo $row2["id_mx"]; ?>" /><?php echo $row2["mx"]; ?>
                                                <?php  } ?>
                                            </select><i class="form-control-feedback" data-bv-field="country" style="display: none;"></i> 
                                    </div>
                                    <?php }?>
                            </div>
                            <br>
                            <!-- xxx fin asignar -->
                             <div class="form-title"> Fecha estimada entrega </div>
                            
                            <div class="input-group">
                                
                                <input class="form-control date-picker" name="fecha_ent_ed" id="fecha_ent_ed" type="text" data-date-format="dd-mm-yyyy">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                            <div class="form-title"> Comentario Labor </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="comentario_ed" class="form-control" rows="6" id="comentario_ed" placeholder="Su descripción aqui!" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="button" href="javascript:;" onclick="editar_servicio($('#no_serv_ed').val(), $('#mx_ed').val(), $('#id_serv_ed').val(), $('#fecha_ent_ed').val(), $('#comentario_ed').val());return false;" name="sut1"  id="sut1" class="btn btn-blue" value="Ingresar"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- FIN MODAL EDITAR SERVICIO #################################################-->
            <!-- INICIO MODAL ELIMINAR SERVICIO -->
            <div>
                <form id="form_eliminar" action="" method="POST">
                    <div id="mod_eliminar_ser" class="modal modal-message modal-danger fade" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <input type="hidden" id="id_serv_el" value="">
                                    <i class="fa fa-warning"></i>
                                </div>
                                <div class="modal-title">Confirmación</div>

                                <div class="modal-body">Desea eliminar este servicio? <br><i>NOTA: esta acción no se puede deshacer.</i></div>
                                <div class="modal-footer">
                                    <input type="button" href="javascript:;" onclick="eliminar_servicio($('#id_serv_el').val());return false;" name="sut1" id="sut1" class="btn btn-danger" value="Si" /> 
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                </div>
                            </div> 
                        </div> 
                    </div>    
                </form>
            </div>
            <!-- FIN MODAL ELIMINAR SERVICIO -->
            <!-- I N I C I O   M O D A L   C R E A R   E Q U I P O #################################################-->
            <div class="modal fade" id="mod_agregar_eq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            <h4 class="modal-title" id="myModalLabel">Crear Equipo</h4> 
                        </div>
                        <div class="modal-body">
                            <div id="registration-form">
                                <form action="flot-serv.php" method="post" role="form"> 
                                <div class="form-title"> Número de Equipo </div>
                            	<div class="form-group"> 
                            	<span class="input-icon icon-right">
                                	<input type="text" id="no_equipo" name="no_equipo" class="form-control" placeholder="# Equipo" required>
                               		<i class="fa fa-user"></i>
                            	</span> 
                            	</div>
                                <div class="form-title"> Número Placa </div>
                                <div class="form-group"> 
                                <span class="input-icon icon-right">
                                  	<input type="text" id="no_placa" name="no_placa" class="form-control" placeholder="# Placa" required>
                                    <i class="fa fa-user"></i>
                                </span> </div>
                                <div class="form-title"> Cliente </div>
                                <div class="form-group"> 
                                <span class="input-icon icon-right">
                                    <input type="text" id="cliente" name="cliente" class="form-control" placeholder="Cliente" required>
                                    <i class="fa fa-user"></i>
                                </span> </div>
                            </div>
                            <input type="button" href="javascript:;" onclick="guardar_equipo($('#no_equipo').val(), $('#no_placa').val(), $('#cliente').val());return false;" name="sut1"  id="sut1" class="btn btn-blue" value="Ingresar"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- FIN MODAL CREAR EQUIPO #################################################-->
        </div>
        <!-- /Page Container -->
        <!-- Main Container -->

    </div>


 <!--Basic Scripts-->
<script src="assets/js/jquery-1.12.3.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>

<!--Beyond Scripts-->
<script src="assets/js/beyond.js"></script>
<!--Datatable -->
<script src="assets/js/datatable/dtn/jquery.dataTables.js"></script>
<script src="assets/js/datatable/dtn/dataTables.bootstrap.js"></script>



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
<!-- <script src="assets/js/customizable.js"></script> -->
<!-- toastr.js para notificaciones push -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>

        $(document).on("ready", function(){
            tbl_list();       
        });


       //SCRIPT PARA LISTAR TAREAS
       // -------------------------------
       function tbl_list() {
            var tabla = $.ajax({
                url: 'flot-serv_calltbl.php'
                , dataType: 'text'
                , async: false
            }).responseText;
            document.getElementById("flot_serv_list").innerHTML = tabla;
            $('#example').DataTable( {
            "order": [[ 1, "asc" ]]
            } ); 
        }
        // -------------------------------
        //SCRIPT PARA GUARDAR NUEVA TAREA

        function guardar_equipo(no_equipo, no_placa, cliente) {
            var opcion = "guardareq";
            var param = {
                "no_equipo": no_equipo
                , "no_placa": no_placa
                , "cliente": cliente
                , "guardareq": guardareq
            };
            $.ajax({
                data: param
                , url: 'flot-serv_crud.php'
                , type: 'post'
                , beforeSend: function () {
                    toastr.info('Espere un momento...','Informacion');
                }, success: function (info) {

                    toastr.success('Tarea Asignada correctamente','Operacion');
                    // var json_info = JSON.parse( info );
                    console.log(info);
                    $('#mod_editar').modal('hide');
                    tbl_list();

                }
            });
        }



        function guardar_servicio(no_serv, mx, fecha_ent, comentario) {
            
            var opcion = "guardar";
            var param = {
                "no_serv": no_serv
                , "mx": mx
                , "fecha_ent": fecha_ent
                , "comentario": comentario
                , "opcion": opcion
            };
            $.ajax({
                data: param
                , url: 'flot-serv_crud.php'
                , type: 'post'
                , beforeSend: function () {
                    toastr.info('Espere un momento...','Informacion');
                }, success: function (info) {

                    toastr.success('Tarea Asignada correctamente','Operacion');
                    // var json_info = JSON.parse( info );
                     console.log(info);
                    $('#mod_agregar_serv').modal('hide');
                    tbl_list();

                }
            });           
        }


        //SCRIPT PARA GUARDAR NUEVO COMENTARIO
         function editar_servicio(no_serv, mx, id_serv, fecha_ent, comentario) {
           
            var opcion = "editar";
            var param = {
                "no_serv": no_serv
                , "mx": mx
                , "fecha_ent": fecha_ent
                , "comentario": comentario
                , "opcion": opcion
                , "id_serv": id_serv
            };
            $.ajax({
                data: param
                , url: 'flot-serv_crud.php'
                , type: 'post'
                , beforeSend: function () {
                    toastr.info('Espere un momento...','Informacion');
                }, success: function (info) {

                    toastr.success('Servicio actualizado correctamente','Operacion');
                    // var json_info = JSON.parse( info );
                    console.log(info);
                    $('#mod_editar_serv').modal('hide');
                    tbl_list();
                    
                }
            });
        }

        function eliminar_servicio(id_serv) {
            var opcion = "eliminar";
            
             var param = {
                "opcion": opcion
                ,"id_serv": id_serv
            };
            $.ajax({
                data: param
                , url: 'flot-serv_crud.php'
                , type: 'post'
                , beforeSend: function () {
                    toastr.info('Espere un momento...','Informacion');
                }, success: function (info) {

                    toastr.success('Servicio eliminado correctamente','Operacion');
                    // var json_info = JSON.parse( info );
                    console.log(info);
                    $('#mod_eliminar_mo').modal('hide');
                    tbl_list();
                    
                }
            });
        }

    </script>


    <script>
        //--Jquery Select2--
        $("#e1").select2();
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



</body>
<!--  /Body -->
</html>