<?php
include("intro.php");
require_once("assets/includes/connection.php");
$id_tarea = $_GET["id"];
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

<div class="page-content">
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="#">Home</a> </li>
            <li class="active">Tareas </li>
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
    
    <?php 
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $p_creatarea= $_SESSION["nick"];
        $n_tarea=$_POST["n_tarea"];
        $time= time();
        $f_inicio= date("d-m-Y", $time);
        $f_entrega = $_POST["f_entrega"];
        $prioridad = $_POST["prioridad"];
        $d_tarea = $_POST["d_tarea"];
        
        if ($_POST['prioridad'] =='on'){
            $var_prioridad= "Normal";
        } else {
            $var_prioridad= "Urgente";
        }

        // $var_prioridad = $_POST['prioridad'];
        $insertar = "'" . implode(',', $_POST['e2']) . "'";
        $sql = "INSERT INTO tareas (n_tarea, pasign, f_inicio, p_creatarea, f_entrega, d_tarea, prioridad, status, switch) " .
        "VALUES ('$n_tarea', $insertar, '$f_inicio', '$p_creatarea', '$f_entrega', '$d_tarea', '$var_prioridad',  'En Curso', 'on')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<div style='padding:20px 20px 0 20px' ><div class='alert alert-success fade in'><button class='close' data-dismiss='alert'>x</button>";
            echo "<i class='fa-fw fa fa-check'></i><strong>Exito</strong> La tarea ha sido creada.</div></div>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error; 
        }

        $pasignado = explode(",", $insertar);
        $cant= count($pasignado);
        
        for($i=0; $i<$cant;$i++){ 
            $to = $pasignado[$i];
            $pas ="SELECT  * FROM  `usuarios` WHERE  `user` =  $to LIMIT 0 , 30 ";
            $rpas = $conn->query($pas);
            $rowpas = mysqli_fetch_row($rpas);
            $mailpass=$rowpas[4];
            $name = "MIPproject";
            $email="info@mipproject.com";
            $headers .= "From: ". $name ." <". $email .">\r\n"; 
            $cuerpo .= "Hola " . $to . "\r\n"; 
            $cuerpo .= "Se le ha asignado una tarea en MIPproject por favor ingresa para verificarla \r\n"; 
            $cuerpo .= "http://www.mipproject.com \n\n";
            $cuerpo .= "Soporte Mipproject \n\n";
            @mail($mailpass, "Se te asigno una tarea", $cuerpo, $headers);
        } 
    }
    ?>
<!-- inicio cuerpo -->
    <div class="page-body">
        <div class="btn-group" style="padding-bottom:10px;">
            <button type="button" class="btn btn-labeled btn-blue" data-toggle="modal" data-target="#myModa"><i class="btn-label fa fa-plus"></i>Adicionar una Tarea</button><br>
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
                                                    <?php echo $row1["prioridad"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row1["p_creatarea"]; ?>
                                                </td>
                                                <td>
                                                    <div class="task-state"><span class="label label-<?php echo $label1 ?>"><?php echo $labelt1; ?></span></div>
                                                </td>
                                                <td>
                                                    <div class="btn-group"> <a href="v_tarea.php?id=<?php echo $row1["id_tarea"];?>" type="button" class="btn btn-default"><i class="fa fa-edit"></i>Ver</a> </div>
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
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                                            <thead>
                                                <tr>
                                                    <th>Nombre Tarea</th>
                                                    <th class="hidden-xs"> Fecha Entrega</th>
                                                    <th class="hidden-xs"> Asignado </th>
                                                    <th>Status</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>
                                            <?php 
                                                $sql4 = "SELECT * FROM tareas WHERE switch = 'on' AND p_creatarea='".$usuari."' order by id_tarea ASC";
                                                $result2 = $conn->query($sql4);
                                                $_SESSION["numrow"] = mysqli_num_rows($result2);
                                            ?>
                                            <?php
                                                if ($result2->num_rows > 0) { 
                                            ?>
                                            <tbody>
                                                <?php 
                                                    while($row = $result2->fetch_assoc()) { 
                                                        $fecha3 = new DateTime($row["f_entrega"]);
                                                        $fecha4 = new DateTime($f_inicio);
                                                        // Colocamos el color al status
                                                        if($row["status"] == "En Curso"){
                                                            $label="yellow";
                                                        } elseif($row["status"] == "Atrazado"){
                                                            $label="red";  
                                                        } else {
                                                            $label="green";
                                                        }
                                                        
                                                ?>     
                                                <tr class="">
                                                    <td>
                                                        <?php echo $row["n_tarea"]; ?>
                                                    </td>
                                                    <td class="no-sort">
                                                        <?php echo $row["f_entrega"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["pasign"]; ?>
                                                    </td>
                                                    <td>
                                                        <div class="task-state"><span class="label label-<?php echo $label ?>"><?php echo $row["status"]; ?></span></div>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group"> <a href="v_tarea.php?id=<?php echo $row["id_tarea"];?>" type="button" class="btn btn-default"><i class="fa fa-edit"></i>Ver</a>
                                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModale" onclick='$("#idt").val("<?php echo $row["id_tarea"]?>")'><i class="fa fa-tasks"></i> Actualizar</button>
                                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModax" onclick='$("#idt").val("<?php echo $row["id_tarea"]?>")'><i class="fa fa-times"></i> Borrar</button>
                                                        </div>
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- fin cuerpo -->
</div>
<!-- /Page Content -->

<!-- modal inicio -->
<div class="modal fade" id="myModa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <h4 class="modal-title" id="myModalLabel">Crear tarea</h4> </div>
            <div class="modal-body">
                <div id="registration-form">
                    <form action="index.php" method="post" role="form">
                        <div class="form-title"> Nombre Tarea </div>
                        <div class="form-group"> 
                            <span class="input-icon icon-right">
                                <input type="text" name="n_tarea" class="form-control" placeholder="Nombre tarea" required>
                                <i class="fa fa-user"></i>
                            </span> 
                        </div>
                        <div class="form-title"> Asignar Responsable </div>
                        <div>
                            <?php 
                                $sql2 = "SELECT  * FROM usuarios";
                                $result2 = $conn->query($sql2);
                                if ($result2->num_rows > 0) { ?>
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
                        <div class="form-title"> Fecha entrega </div>
                        <div class="row">
                            <div class="col-sm-8 col-xs-12">
                                <div class="input-group">
                                    <input name="f_entrega" class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" required> <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </span> 
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <input type="checkbox" name="prioridad" checked data-toggle="toggle" data-width="120" data-on="Es Urgente?" data-off="Urgente" data-onstyle="success" data-offstyle="danger"> </div>
                        </div>
                        <br>
                        <div class="form-title"> Descripción Tarea </div>
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
<div class="modal fade" id="myModale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="myModalLabel">Editar tarea</h4>
</div>
<?php 
echo $itar= "<script>document.write(idt)</script>";
$tar ="SELECT  * FROM  `tareas` WHERE  `id_tarea` =  $itar LIMIT 0 , 30 ";
$rtar = $conn->query($tar);
$rowtar = mysqli_fetch_row($rtar);
echo $tarea=$rowtar[4];
?>
<div class="modal-body">
<div id="registration-form">

<form action="index.php" method="post" role="form">
<div class="form-title">
Nombre Tarea
</div>
<div class="form-group">
<span class="input-icon icon-right">
<input type="text" name="n_tarea" class="form-control" placeholder="<?php echo $rowtar[4]?>">
<i class="fa fa-user"></i>
</span>
</div>
<div class="form-title">
Asignar Responsable
</div>
<!-- xxx asignar -->
<div>
<?php 
$sql2 = "SELECT  * FROM usuarios";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) { ?>
<select id="e3" name="e3[]" multiple="multiple"  style="width: 100%;">
<?php while($row2 = $result2->fetch_assoc()) {?>
<option value="<?php echo $row2["user"]; ?>" /><?php echo $row2["user"]; ?>
<?php  } ?> 
</select>
<?php $pasig ='<script languaje="JavaScript"> document.write(e3) </script>';?>


<?php }?>
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
<input type="checkbox" name="prioridad" checked data-toggle="toggle" data-width="120" data-on="Es Urgente?" data-off="Urgente" data-onstyle="success" data-offstyle="danger">                                                               
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
$('#example1').DataTable( {
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
