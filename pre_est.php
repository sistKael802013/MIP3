<?php include("intro.php"); ?>
<?php require_once("assets/includes/connection.php");?>
<?php 
session_start();
$id_oport = $_GET["id"]; 
$_SESSION["id_oport"] = $id_oport;     

// Consulta datos de la oportunidad
$sql1 = "SELECT * FROM `crm_oport` WHERE id = $id_oport";
$result = $conn->query($sql1);
$row = mysqli_fetch_row($result);

// Consulta datos de la empresa
$id_emp = $row[6];
$sql2 = "SELECT * FROM `crm_empresas` WHERE id_emp = $id_emp";
$result2 = $conn->query($sql2);
$row2 = mysqli_fetch_row($result2);

// Query para ingresar un nuevo item
if (isset($_POST["sub_item"])){
	$no_nivel = $_POST["no_nivel"];
	$nom_item = $_POST["nom_item"];
	$id_madre = $_POST["id_madre"];
	// El id de la oportunidad se obtiene a traves de $_GET["id"];
	$sql = "INSERT INTO pre_apu_est (id_oport, nivel, nombre, id_madre) " .
                "VALUES ($id_oport, $no_nivel, '$nom_item', $id_madre)";
    mysqli_query($conn, $sql);
}

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>MIP: Presupuesto </title>
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
                    Presupuesto
                </li>
            </ul>
        </div>
        <div class="page-header position-relative">
            <div class="header-title">
                <h1>
                   Estructura Propuesta
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
            <div class="well with-header  with-footer">
                <div class="header bg-blue">
                    Actividad x/ Sub actividad y
                </div>
                <div class="btn-group">
                    <a href="presup-tot.html" type="button" class="btn btn-default"><i class="fa fa-calculator"></i> Ver Propuesta</a>
                    <div class="btn-group">
                        <a class="btn btn-default " href="javascript:void(0);">Estado Propuesta</a>
                        <a class="btn btn-default  dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" ><i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="javascript:void(0);">Elaboracion</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Presentada</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">No presentada</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Perdida</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);">Ganada</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <br>
                <br>

                <table class="table" style="margin-bottom:20px;">
                    <tr>
                        <th>Empresa</th>
                        <td><?php echo $row2[2]; ?></td>
                        <th>Código</th>
                        <td><?php echo $row[3]; ?></td>
                    </tr>
                    <tr>
                        <th>Nombre Oportunidad</th>
                        <td colspan="3"><?php echo $row[2]; ?></td>
                    </tr>
                </table>
                <!-- WIDGET -->
                <div class="widget">
                	<!-- WIDGET HEADER -->
                    <div class="widget-header bordered-left bordered-blueberry">
                        <span class="widget-caption">Crear la estructura del Proyecto</span>
                    </div>
					<!-- WIDGET HEADER -->
                    <!-- WIDGET ACORDION ITEMS -->
                    <div class="widget-body bordered-left bordered-blue">
                        <button class="btn btn-default btn-xs" onclick="lvl1();" data-toggle="modal" data-target="#mod_lvl"><i class="fa fa-plus"></i>Crear item de Nivel 1</button>
                        <a class="btn btn-default btn-xs" href="presup-apu.html">APU<i class="fa fa-plus right"></i></a><br><br>
                        <div class="panel-group accordion" id="accordion">
                            <?php 
                                $sql3 = "SELECT * FROM  pre_apu_est WHERE nivel = 1 AND id_oport = $id_oport";
                                $resultset3 = $conn->query($sql3);

                                if(!$resultset3){
                                    echo "Ocurrió el siguiente error en el sistema: ". $conn->error; 
                                }else{  
                                    if ($resultset3->num_rows > 0){ 
                                        while($row3 = $resultset3->fetch_assoc()){
                                            $href_rand_a = rand(1, 9999); 
                                            $id_est=$row3["id_est"];
                                            $sql4 = "SELECT MAX(nivel) FROM  pre_apu_est WHERE id_oport = $id_oport";
                                            $result4 = $conn->query($sql4);
                                            $row4 = mysqli_fetch_row($result4);
                                            $j= $row4[0];
                                            $i= 2;
                                            if ($i > 1){
                                                while($i <= $j){

                                                    $sql5 = "SELECT * FROM  pre_apu_est WHERE nivel = $i AND id_oport = $id_oport AND id_madre = $id_est";
                                                    $resultset5 = $conn->query($sql5);
                                                    if(!$resultset5){
                                                        echo "Ocurrió el siguiente error en el sistema: ". $conn->error; 
                                                    }else{  
                                                        if ($resultset5->num_rows > 0){ 
                                                            while($row5 = $resultset5->fetch_assoc()){
                                                                echo $row5["nombre"];

                                                            
                                                            }
                                                            $id_est= $row5["id_est"];
                                                        }

                                                    }
                                                    $i++;

                                                }
                                            }   
                            ?>
                    		<!-- items de primer nivel -->
                            <div class="panel panel-default">
                                <div class="panel-heading ">
                                    <h4 class="panel-title">

                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                            <?php echo $row3["nombre"]; ?>
                                        </a>
                                    </h4>
                                </div>
                                <!-- items de segundo nivel en adelante -->
                                <!-- HAY QUE ENCONTRAR LA FORMA DE MOSTRAR LOS SUB ITEMS  -->
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body border-red">
                                        <div class="buttons-preview">
                                            <button class="btn btn-default btn-xs" onclick="lvl2();" data-toggle="modal" data-target="#mod_lvl"><i class="fa fa-plus"></i>Crear item de Nivel 2</button> 
                                            <a class="btn btn-default btn-xs" href="presup-apu.html">APU<i class="fa fa-plus right"></i></a>
                                        </div>
                                        <div class="panel-group accordion" id="accordion1">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse12">
                                                            <?php echo $row3["nombre"]; ?>
                                                        </a>
                                                    </h4>
                                                </div>  
                                                <div id="collapse12" class="panel-collapse collapse">
                                                    <div class="panel-body border-palegreen">
                                                        <div class="buttons-preview">
                                                            <button class="btn btn-default btn-xs" onclick="lvl3();" data-toggle="modal" data-target="#mod_lvl"><i class="fa fa-plus"></i> Crear item de Nivel 3</button>
                                                            <a class="btn btn-default btn-xs" href="presup-apu.html">APU<i class="fa fa-plus right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                                <!-- items de segundo nivel en adelante -->
                            </div>
                    		<!-- items de primer nivel -->

                                <?php } ?>
                            <?php }else{ ?>
                                   <h2 style="text-align:center;">Sin items en esta oportunidad.</h2> 
                            <?php } ?>
                            <?php } ?>

                        </div>
                        <!-- !NIVEL 1 -->
                    </div>
                    <!-- WIDGET ACORDION ITEMS -->
                </div>
                <!-- !!WIDGET -->
                <!-- VENTANAS MODALES, INGRESO DE ITEMS -->
                <div class="modal fade" id="mod_lvl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <!-- el titulo cambia segun el caso -->
                                <h4 class="modal-title" id="mod_label"></h4>
                                <!-- el titulo cambia segun el caso -->
                            </div>
                            <div class="modal-body">
                                <form action="pre_est.php?id=<?php echo $id_oport; ?>" method="post" role="form">
                                    <div id="registration-form">
                                        <div class="form-title"></div>
                                        <div class="form-group">
                                        	<input type="hidden" id="no_item" name="no_nivel" value="0">
                                            <input type="hidden" id="id_madre" name="id_madre" value="0">
                                            <span class="input-icon icon-right">    
                                                <input type="text" class="form-control" id="nom_item" name="nom_item" placeholder="Nombre del item.">
                                                <i class="fa fa-bars"></i>
                                            </span>
                                        </div>
                                        <button type="submit" name="sub_item" class="btn btn-blue">Ingresar</button>
                                    </div>
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- !!VENTANAS MODALES, INGRESO DE ITEMS -->
                <!-- MODAL ELIMINAR ITEMS -->
                <div>
                    <form id="form_eliminar" action="" method="POST">
                        <div id="mod_eliminar" class="modal modal-message modal-danger fade" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <input type="hidden" id="id_item_el" name="id_item_el" value="">
                                        <i class="fa fa-warning"></i>
                                    </div>
                                    <div class="modal-title">Confirmación</div>

                                    <div class="modal-body">Desea eliminar este? <br><i>NOTA: esta acción no se puede deshacer.</i></div>
                                    <div class="modal-footer">
                                        <button type="button" onclick="eliminar_tarea($('#id_tarea_el').val())" class="btn btn-danger" data-dismiss="modal">Si</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    </div>
                                </div> 
                            </div> 
                        </div>    
                    </form>
                </div>
                <!-- MODAL ELIMINAR ITEMS -->
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

    // $(document).on("ready", function(){
    //    list_est();
    // });

    // function list_est(){
    //     var tabla = $.ajax({
    //         url: 'pre_est_calltbl.php'
    //         , dataType: 'text'
    //         , async: false
    //     }).responseText;
    //     document.getElementById("list_items").innerHTML = tabla;
    // } 


    function lvl1(){
        document.getElementById("mod_label").innerHTML = "Crear item de nivel 1";
        $('#no_item').val(1);
    }

    function lvl2(){
        document.getElementById("mod_label").innerHTML = "Crear item de nivel 2";
        $('#no_item').val(2);
    }

    function lvl3(){
        document.getElementById("mod_label").innerHTML = "Crear item de nivel 3";
        $('#no_item').val(3);
    }
    
    
    // function guardar_item(item, nivel, id_madre, id_oport) {
        
    //     var opcion = "guardar_item";
    //     var param = {
    //         "item": item
    //         , "opcion": opcion
    //     };
    //     $.ajax({
    //         data: param
    //         , url: 'pre_est_crud.php'
    //         , type: 'post'
    //         , beforeSend: function () {
    //             Notify('Procesando...', 'bottom-left', '5000', 'info', 'fa-clock-o', false);
    //         }, success: function (info) {
    //             Notify('Registro ingresado correctamente.', 'bottom-left', '5000', 'success', 'fa-check', true);
    //             $('#mod_n_cont').modal('hide');
    //             console.log(info);
    //             list_tbl_contact();

    //         }   
    //     });
    // }

    // function editar_item(id_est, item, nivel, id_madre, id_oport){
    //     // El id de la empresa se ingresa en el archivo 'crm-ve_crud.php' con $_SESSION[].
    //     var opcion = "editar_item";
    //     var param = {
    //        "id_est": id_est 
    //         , "item": item
    //         , "opcion": opcion
    //     };
    //     $.ajax({
    //         data: param
    //         , url: 'pre_est_crud.php'
    //         , type: 'post'
    //         , beforeSend: function () {
    //             Notify('Procesando...', 'bottom-left', '5000', 'info', 'fa-clock-o', false);
    //         }, success: function (info) {
    //             Notify('Registro actualizado correctamente.', 'bottom-left', '5000', 'success', 'fa-check', true);
    //             $('#mod_editar_contact').modal('hide');
    //             console.log(info);
    //             list_tbl_contact();
    //         }   
    //     });
    // }

    // function eliminar_item(id_est) {
    //     var opcion = "eliminar_item";
    //     var param = {
    //         "id_est": id_est
    //         , "opcion": opcion
    //     };
    //     $.ajax({
    //         data: param
    //         , url: 'pre_est_crud.php'
    //         , type: 'post'
    //         , beforeSend: function () {
    //             Notify('Procesando...', 'bottom-left', '5000', 'info', 'fa-clock-o', false);
    //         }, success: function (info) {
    //             Notify('Registro ingresado correctamente.', 'bottom-left', '5000', 'success', 'fa-check', true);
    //             $('#mod_el_contact').modal('hide');
    //             console.log(info);
    //             list_tbl_contact();

    //         }   
    //     });
    // }
    
   
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