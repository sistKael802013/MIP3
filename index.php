<?php
include("intro.php");
require_once("assets/includes/connection.php");
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
    <link href="assets/css/demo.min.css" rel="stylesheet"/>
    <link href="assets/css/typicons.min.css" rel="stylesheet"/>
    <link href="assets/css/animate.min.css" rel="stylesheet"/>
    <link href="assets/css/custom.css" rel="stylesheet"/>
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

<div class="page-content">
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="#">Inicio</a> </li>
            <li class="active">Tareas</li>
        </ul>
    </div>
    <div class="page-header position-relative">
        <div class="header-title">
            <h1>Tareas</h1> 
        </div>
        <div class="header-buttons">
            <a class="sidebar-toggler" href="#"> <i class="fa fa-arrows-h"></i> </a>
            <a class="refresh" id="refresh-toggler" href=""> <i class="glyphicon glyphicon-refresh"></i> </a>
            <a class="fullscreen" id="fullscreen-toggler" href="#"> <i class="glyphicon glyphicon-fullscreen"></i> </a>
        </div>
    </div>

    
<!-- inicio cuerpo -->
    <div class="page-body">
        <div class="btn-group" style="padding-bottom:10px;">
            <button type="button" class="btn btn-labeled btn-blue" data-toggle="modal" data-target="#mod_crear"><i class="btn-label fa fa-plus"></i>Crear una Tarea</button><br>
        </div>
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
                    <!-- inicio acordion -->
                    <div class="tabbable " style="">
                    <ul class="nav nav-tabs " id="myTab10">
                        <li class="active"> 
                            <a data-toggle="tab" href="#home10">Mis Tareas</a>
                        </li>
                        <li class="tab-red"> 
                            <a data-toggle="tab" href="#profile10">Tareas que asigné</a> 
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="home10" class="tab-pane in active">
                        <!-- inicio tabla -->
                            <div class="widget-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                                        <thead>
                                            <tr>
                                                <th>Nombre Tarea </th>
                                                <th class="hidden-xs"> Fecha Entrega</th>
                                                <th class="hidden-xs"> Prioridad</th>
                                                <th class="hidden-xs"> Propietario </th>
                                                <th>Status</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <?php 
                                            $sql4 = "SELECT * FROM tareas WHERE pasign LIKE '%".$usuari."%' AND switch = 'on'  ORDER BY id_tarea DESC";
                                            $result2 = $conn->query($sql4);
                                            $_SESSION["numrow"] = mysqli_num_rows($result2);

                                            if ($result2->num_rows > 0) { 
                                        ?>

                                        <tbody>
                                            <?php while($row1 = $result2->fetch_assoc()) {

                                                $fecha2 = new DateTime($row1["f_entrega"]);
                                                $fecha1 = new DateTime($f_inicio);
                                                $sta = $row1["status"];

                                                if($sta == "Entregado"){
                                                    $label1 = "green";
                                                    $labelt1= "Entregado";
                                                }else{

                                                    if($fecha1 < $fecha2){
                                                        $label1="yellow";
                                                        $labelt1="En Curso";
                                                    } else {
                                                        $id_t = $row1["id_tarea"];
                                                        $label1="red";
                                                        $labelt1="Atrazado";  
                                                        $sql_status = "UPDATE tareas SET status = 'Atrazado' WHERE id_tarea = $id_t";
                                                        $conn->query($sql_status);
                                                    }
                                                }
                                            ?>   
                                            <tr class="odd gradeX">
                                                <td>
                                                    <?php echo $row1["n_tarea"]; ?>
                                                </td>
                                                <td class="no-sort">
                                                    <?php echo $row1["f_entrega"]; ?>
                                                </td>
                                                <td class="no-sort">
                                                    <?php  if($row1["prioridad"] == "on"){
                                                       echo "Urgente";
                                                    }else{
                                                       echo "Normal";
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php echo $row1["p_creatarea"]; ?>
                                                </td>
                                                <td>
                                                    <div class="task-state"><span class="label label-<?php echo $label1 ?>"><?php echo $labelt1; ?></span></div>
                                                </td>
                                                <td>
                                                    <div class="btn-group"> <a href="v_tarea.php?id=<?php echo $row1["id_tarea"];?>" type="button" class="btn btn-default"><i class="fa fa-folder-open-o"></i>Ver</a> </div>
                                                </td>
                                            </tr>
                                            <?php } }?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="profile10" class="tab-pane">
                            <div class="">
                                <div class="widget-body">
                                    <div id="listar_tarea"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- fin cuerpo -->
</div>
<!-- /Page Content -->
<!-- modal inicio -->
<div class="modal fade" id="mod_crear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <h4 class="modal-title" id="myModalLabel">Crear tarea</h4> </div>
            <div class="modal-body">
                <div id="registration-form">
                    <form id="form_editar" action="" method="post" role="form">
                        <div class="form-title"> Nombre Tarea </div>
                        <div class="form-group"> 
                            <span class="input-icon icon-right">
                                <input type="text" id="n_tarea" name="n_tarea" class="form-control" placeholder="Titulo de la tarea" required>
                                <i class="fa fa-user"><?php echo $row["n_tarea"]; ?></i>
                            </span> 
                        </div>
                        <div class="form-title"> Asignar Responsable </div>
                        <div>
                            <?php 
                                $sql2 = "SELECT  * FROM usuarios";
                                $result2 = $conn->query($sql2);
                                if ($result2->num_rows > 0) 
                            {?>
                                <select id="e2" name="e2[]" multiple="multiple" style="width: 100%;" required>
                                    <?php while($row2 = $result2->fetch_assoc()) {?>
                                        <option value="<?php echo $row2["user"]; ?>" />
                                        <?php echo $row2["user"]; ?>
                                    <?php  } ?>
                                </select>
                               
                                <?php $pasig ='<script languaje="JavaScript"> document.write(e2) </script>';?>

                            <?php }?>
                        </div>
                        <!-- xxx fin asignar -->
                        <div class="form-title"> Fecha de entrega </div>
                        <div class="row">
                            <div class="col-sm-8 col-xs-12">
                                <div class="input-group">
                                    <input id="f_entrega" name="f_entrega" class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" required> <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </span> 
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <input type="checkbox" id="prioridad" name="prioridad" checked data-toggle="toggle" data-width="120" data-on="Es Urgente?" data-off="Urgente" data-onstyle="success" data-offstyle="danger"> </div>
                        </div>
                        <br>
                        <div class="form-title"> Descripción de la Tarea </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea id="d_tarea" name="d_tarea" class="form-control" rows="6" id="form-field-8" placeholder="Su descripción aqui!"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="button" href="javascript:;" onclick="guardar_tarea($('#n_tarea').val(), $('#e2').val(), $('#f_entrega').val(), $('#prioridad').val(), $('#d_tarea').val());return false;" name="sut1"  id="sut1" class="btn btn-blue" value="Ingresar"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL EDITAR TAREA -->
<div class="modal fade" id="mod_editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <h4 class="modal-title" id="myModalLabel">Editar tarea</h4> </div>
            <div class="modal-body">
                <div id="registration-form">
                    <form id="form_editar" action="" method="post" role="form">
                        
                       
                        <div class="form-title"> Nombre Tarea </div>
                        <div class="form-group"> 
                            <span class="input-icon icon-right">
                                <input type="hidden" id="id_tarea_el" name="id_tarea" value="">
                                <input type="text" id="n_tarea_ed" class="form-control" placeholder="Titulo de la tarea" required>
                                <i class="fa fa-text-width"><?php echo $row["n_tarea"]; ?></i>
                            </span> 
                        </div>
                        <div class="form-title"> Asignar Responsable </div>
                        <div>
                            <?php 
                                $sql2 = "SELECT  * FROM usuarios";
                                $result2 = $conn->query($sql2);
                                if ($result2->num_rows > 0) 
                            {?>
                                <input type="hidden" id="id_tarea_ed"value="">
                                <select id="e2_ed" name="e2[]" multiple="multiple" style="width: 100%;" required>
                                    <?php while($row2 = $result2->fetch_assoc()) {?>
                                        <option value="<?php echo $row2["user"]; ?>" />
                                        <?php echo $row2["user"]; ?>
                                    <?php  } ?>
                                </select>
                               
                                <?php $pasig ='<script languaje="JavaScript"> document.write(e2) </script>';?>

                            <?php }?>
                        </div>
                        <!-- xxx fin asignar -->
                        <div class="form-title"> Fecha de entrega </div>
                        <div class="row">
                            <div class="col-sm-8 col-xs-12">
                                <div class="input-group">
                                    <input id="f_entrega_ed"  class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" required> <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </span> 
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <input type="checkbox" id="prioridad_ed" checked data-toggle="toggle" data-width="120" data-on="Es Urgente?" data-off="Urgente" data-onstyle="success" data-offstyle="danger"> 
                            </div>
                        </div>
                        <br>
                        <div class="form-title"> Descripción de la Tarea </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea id="d_tarea_ed" class="form-control" rows="6" id="form-field-8" placeholder="Su descripción aqui!"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="button" href="javascript:;" onclick="editar_tarea($('#id_tarea_ed').val(), $('#n_tarea_ed').val(), $('#e2_ed').val(), $('#f_entrega_ed').val(), $('#prioridad_ed').val(), $('#d_tarea_ed').val());return false;" name="sut1"  id="sut1" class="btn btn-blue" value="Ingresar"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL EDITAR TAREA -->
<!-- INICIO MODAL ELIMINAR TAREA -->
<div>
    <form id="form_eliminar" action="" method="POST">
        <div id="mod_eliminar" class="modal modal-message modal-danger fade" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="hidden" id="id_tarea_el" name="id_tarea" value="">
                        <i class="fa fa-warning"></i>
                    </div>
                    <div class="modal-title">Confirmación</div>

                    <div class="modal-body">Desea eliminar la tarea? <br><i>NOTA: esta acción no se puede deshacer.</i></div>
                    <div class="modal-footer">
                        <button type="button" onclick="eliminar_tarea($('#id_tarea_el').val())" class="btn btn-danger" data-dismiss="modal">Si</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div> 
            </div> 
        </div>    
    </form>
</div>
<!-- FIN MODAL ELIMINAR TAREA -->
</div>
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
<script src="assets/js/toastr/toastr.js"></script>

<script>

    $(document).on("ready", function(){
        tiempoReal();

        $('#example').DataTable( {
        "order": [[ 1, "asc" ]]
        } );
   
    } );


   //SCRIPT PARA LISTAR TAREAS
   function tiempoReal() {
        var tabla = $.ajax({
            url: 'index_calltbl.php'
            , dataType: 'text'
            , async: false
        }).responseText;
        document.getElementById("listar_tarea").innerHTML = tabla;
        $('#example1').DataTable( {
        "order": [[ 1, "asc" ]]
        } ); 
    }

    //SCRIPT PARA GUARDAR NUEVA TAREA
    function guardar_tarea(n_tarea, e2, f_entrega, prioridad, d_tarea) {
    	var opcion = "guardar";
        var param = {
            "n_tarea": n_tarea
            , "e2": e2
            , "f_entrega": f_entrega
            , "prioridad": prioridad
            , "d_tarea": d_tarea
            , "opcion": opcion
        };
        $.ajax({
            data: param
            , url: 'index_crud.php'
            , type: 'post'
            , beforeSend: function () {
                Notify('Procesando...', 'bottom-left', '5000', 'info', 'fa-clock-o', false);
            }, success: function (info) {

                Notify('Registro ingresado correctamente.', 'bottom-left', '5000', 'success', 'fa-check', true);
                // var json_info = JSON.parse( info );
                 console.log(info);
                $('#mod_crear').modal('hide');
                tiempoReal();

            }
        });
    }


    //SCRIPT PARA GUARDAR NUEVA TAREA
    function editar_tarea(id_tarea, n_tarea, e2, f_entrega, prioridad, d_tarea) {
    	var opcion = "editar";
        var param = {
            "n_tarea": n_tarea
            , "e2": e2
            , "f_entrega": f_entrega
            , "prioridad": prioridad
            , "d_tarea": d_tarea
            , "id_tarea": id_tarea
            , "opcion": opcion
        };
        $.ajax({
            data: param
            , url: 'index_crud.php'
            , type: 'post'
            , beforeSend: function () {
                Notify('Procesando...', 'bottom-left', '5000', 'info', 'fa-clock-o', false);
            }, success: function (info) {

                Notify('Registro actualizado correctamente.', 'bottom-left', '5000', 'success', 'fa-check', true);
                var json_info = JSON.parse( info );
                console.log(json_info);
                $('#mod_editar').modal('hide');
                tiempoReal();
                
            }
        });
    }

    function eliminar_tarea(id_tarea) {
    	var opcion = "eliminar";
    	
    	 var param = {
            "opcion": opcion
            ,"id_tarea": id_tarea
        };
        $.ajax({
            data: param
            , url: 'index_crud.php'
            , type: 'post'
            , beforeSend: function () {
                Notify('Procesando...', 'bottom-left', '5000', 'info', 'fa-clock-o', false);
            }, success: function (info) {

                Notify('Registro eliminado correctamente.', 'bottom-left', '5000', 'success', 'fa-check', true);
                var json_info = JSON.parse( info );
                console.log(json_info);
                $('#mod_eliminar').modal('hide');
                tiempoReal();
                
            }
        });
    }

</script>


<script>

//--Jquery Select2--
$("#e1").select2();
$("#e2_ed").select2();
$("#e2").select2({
placeholder: "Selecciona",
allowClear: true

});
$("#e3").select2({
placeholder: "Selecciona",
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