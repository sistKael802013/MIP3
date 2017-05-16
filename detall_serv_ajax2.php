<?php require_once("assets/includes/connection.php"); //Conexion a base de datos ?>




<?php
session_start();
$id_serv=$_SESSION["id_serv"];
$sql_id_serv ="SELECT * FROM  flot_servicios  WHERE  id_serv = $id_serv"; 
$result = $conn->query($sql_id_serv);
$row = mysqli_fetch_row($result);
$numrow = mysqli_num_rows($result);

// buscar equipo
$mx=$row[3];
$equipo = "SELECT * FROM  `flot_mx` WHERE `id_mx` = $mx";
$reseq = $conn->query($equipo);
$row7 = mysqli_fetch_row($reseq);
$numrow2 = mysqli_num_rows($reseq);
setlocale(LC_MONETARY, 'en_US');


echo ' <div class="">
                   
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
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th> <i class="fa fa-gears"></i> Repuesto </th>
                                            <th class="hidden-xs"> <i class="fa fa-reorder"></i> Cant </th>
                                            <th> <i class="fa fa-dollar"></i> Vr Unit </th>
                                            <th class="hidden-xs"> <i class="fa fa-dollar"></i> Tot Rep </th>
                                            <th> <i class="fa fa-user"></i> Vr Mano Obra </th>
                                            <th> <i class="fa fa-dollar"></i> Sub Total </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql4 = "SELECT * FROM flot_srep WHERE `id_dserv` = $id_dserv";
                                            $result4 = $conn->query($sql4);
                                            if ($result4->num_rows > 0) { 
                                            while($row2 = $result4->fetch_assoc()) { 
                                            $id_rep=$row2["id_rep"];
                                            $variable2 ="SELECT * FROM  flot_rep WHERE  `id_rep` = $id_rep LIMIT 0 , 30";
                                            $result2 = $conn->query($variable2);
                                            $row3 = mysqli_fetch_row($result2); 
                                            setlocale(LC_MONETARY, 'en_US');?>
                                            <tr>
                                                <td>
                                                    <a href="#">
                                                        <?php echo $row3[1]; ?>
                                                    </a>
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
                                                <td>
                                                    <?php $tot=$tot+$subtot;?> <a href="#" class="btn btn-default btn-xs purple"><i class="fa fa-edit"></i> Edit</a> 
                                                </td>
                                            </tr>
                                            <?php }} ?>
                                    </tbody>
                                </table>
                                <br>
                                <button class="btn btn-default btn-xs purple" data-toggle="modal" data-target="#myModarep" onclick='$("#DNI").val("<?php echo $id_dserv?>")'><i class="fa fa-edit"></i> Ingresar respuesto</button>
                                <hr class="wide"> <span>Total <?php  echo money_format('%(#5n', $tot);?></span> 
                            </div>
                        </div>
                    </div>
                    <?php }} ?>
                </div>' ;


?>