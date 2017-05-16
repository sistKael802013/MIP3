<?php
include("intro.php");
require_once("assets/includes/connection.php");

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
        $sqla = "SELECT MAX(id_cont) AS id FROM crm_empresas";
        $result2 = $conn->query($sqla);
        
        if ($row = mysql_fetch_row($result2)) {
            $idemp = trim($row[0]);
            header("Location: crm-ve.php?id=".$idemp);  
        }
        
    }  else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>CRM - Cuentas</title>

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
    <link id="beyond-link" href="assets/css/beyond.min.css" rel="stylesheet" type="text/css"/>
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
                            <a href="index.php">Inicio</a>
                        </li>
                        <li class="active">
                            CRM
                        </li>
                        <li class="active">
                            Cuentas
                        </li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                           Cuentas
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
                    <div class="btn-group" style="padding-bottom:10px;">
                        <button type="button" class="btn btn-labeled btn-blue" data-toggle="modal" data-target="#myModa"><i class="btn-label fa fa-plus"></i>Adicionar un Posible Cliente</button>&nbsp;&nbsp;
                         <!--  <button type="button" class="btn btn-labeled btn-blue" data-toggle="modal" data-target="#myModa1"><i class="btn-label fa fa-plus"></i>Adicionar un Cargo</button>
                          -->      
                    <br></div>
                        <?php 
                            if ($exito==on) 
                            {
                                echo "<div style='padding:20px 20px 0 20px' ><div class='alert alert-success fade in'><button class='close' data-dismiss='alert'>x</button>";
                                echo "<i class='fa-fw fa fa-check'></i><strong>Exito</strong> El posible cliente ha sido creado.</div></div>";
                            }
                        ?>
                        <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="widget">
                               
                                <!-- inicio tabla -->
                                  <div class="widget-body">

                                    <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                     <thead>
                                            <tr>
                                                <th>Nombre Cliente </th>
                                                <th class="hidden-xs"> Dirección</th>
                                                <th class="hidden-xs"> Telefono</th>
                                                <th class="hidden-xs"> Sector </th>
                                                
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <?php 
                                            $sql4 = "SELECT * FROM crm_empresas WHERE estado LIKE '0' AND switch = 'on'  ";
                                            $result2 = $conn->query($sql4);
                                            $_SESSION["numrow"] = mysqli_num_rows($result2);

                                            if ($result2->num_rows > 0) { 
                                        ?>

                                        <tbody>
                                            <?php while($row1 = $result2->fetch_assoc()) {
                                            ?>   
                                            <tr class="odd gradeX">
                                                <td>
                                                    <?php echo $row1["nomempresa"]; ?>
                                                </td>
                                                <td class="no-sort">
                                                    <?php echo $row1["direccion"]; ?>
                                                </td>
                                                <td class="no-sort">
                                                    <?php echo $row1["telefono"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row1["sector"]; ?>
                                                </td>
                                                
                                                <td>
                                                    <div class="btn-group"> <a href="crm-ve.php?id=<?php echo $row1["id_emp"];?>" type="button" class="btn btn-default"><i class="fa fa-edit"></i>Ver</a> </div>
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
                <!-- fin cuerpo -->
            </div>
            <!-- /Page Content -->

            <!-- I N I C I O  M O D A L   ADICIONAR NUEVO CLIENTE #################################################-->
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
                                                <input type="text" id="idempresa" name="idempresa" class="form-control" placeholder="NIT" required>
                                                <i class="fa fa-newspaper-o"></i>
                                            </span> 
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                         <div class="form-group"> 
                                            <span class="input-icon icon-right">
                                                <input type="text" id="nomempresa" name="nomempresa" class="form-control" placeholder="Nombre Empresa" required>
                                                <i class="fa fa-id-card-o"></i>
                                            </span> 
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                         <div class="form-group"> 
                                            <span class="input-icon icon-right">
                                                <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Dirección" required>
                                                <i class="fa fa-map-marker"></i>
                                            </span> 
                                        </div>
                                    </div> 
                                    <div class="col-sm-6">
                                         <div class="form-group"> 
                                            <span class="input-icon icon-right">
                                                <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Teléfono" required>
                                                <i class="fa fa-phone"></i>
                                            </span> 
                                        </div>
                                    </div> 
                                    <div class="col-sm-6">
                                         <div class="form-group"> 
                                            <span class="input-icon icon-right">
                                                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                                                <i class="fa fa-envelope-o"></i>
                                            </span> 
                                        </div>
                                    </div> 

                                    <div class="col-sm-6">
                                         <div class="form-group"> 
                                            <span class="input-icon icon-right">
                                                <input type="text" id="ciudad" name="ciudad" class="form-control" placeholder="Ciudad">
                                                <i class="fa fa-map-marker"></i>
                                            </span> 
                                        </div>
                                    </div> <div class="col-sm-6">
                                         <div class="form-group"> 
                                            <span class="input-icon icon-right">
                                                <input type="text" id="dpto" name="dpto" class="form-control" placeholder="Departamento" required>
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
                                <!-- <div > -->
                                    <button type="submit" name="submit1" class="btn btn-blue">Ingresar</button>
                                <!-- </div>  -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- F I N   M O D A L   ADICIONAR EMPLEADO #################################################-->                                
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
