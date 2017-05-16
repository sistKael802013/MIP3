<?php 
include("assets/includes/connection.php");
session_start();
$id_serv = $_SESSION["id_serv"];

$sql1 = "SELECT * FROM  `flot_dserv`, flot_dserv_esp, flot_dserv_act  WHERE  flot_dserv.id_serv = $id_serv AND flot_dserv_esp.id_esp = flot_dserv.especialidad AND flot_dserv_act.id_act = flot_dserv.actividad";
$resultset1 = $conn->query($sql1);


if(!$resultset1){
    echo "Error: ". $conn->error; 
}else{
   
	if ($resultset1->num_rows > 0) { 
		while($row1 = $resultset1->fetch_assoc()) { 
			

			$tot_rep=0;
			$totmo=0;
			if ($colorlabel==0){ 
			   $label= "yellow"; 
			   $colorlabel=1; 
			}else{ 
			   $label="red"; 
			   $colorlabel=0; 
			}
			$id_dserv=$row1["id_dserv"];

			echo "<div class='col-lg-12 col-sm-12 col-xs-12'>";
				echo "<div class='widget'>";
					// Widget header
					echo "<div class='widget-header bordered-left bordered-".$label."'>";
							echo "<span class='widget-caption'>
								".$row1["esp"].' / '.$row1["act"]."";
							echo "</span>";
							echo "<div class='widget-buttons buttons-bordered'>";
								echo"<button type='button' style='border:none; outline:none;' data-toggle='modal' data-target='#mod_edit_espact' onclick=\"$('#id_dservespact').val(".$row1["id_dserv"]."); $('#sel_espc').val(".$row1["especialidad"]."); $('#sel_actv').val(".$row1["actividad"].");\" class='btn btn-default'><i class='fa fa-edit'></i></button>";
								echo"<button type='button' style='border:none; outline:none;' data-toggle='modal' data-target='#mod_elim_espact' onclick=\"$('#id_dserv_el').val(".$id_dserv.");\" name='sut1'  id='sut1' class='btn btn-default' value=''><i class='fa fa-close'></i></button>";
							echo "</div>";
					echo "</div>";
					// Widget header
					echo "<div class='widget-body bordered-left bordered-".$label."'>";
					$sql2 = "SELECT * FROM flot_srep WHERE `id_dserv` = $id_dserv AND id__tip = 0";
                    $resultset2 = $conn->query($sql2);
                    	// Tabla de repuestos
						echo "<table class='table table-striped table-bordered table-hover'>
								<thead>
                                    <tr>
                                        <th>
                                            <i class='fa fa-gears'></i> Repuesto
                                        </th>
                                        <th class='hidden-xs'>
                                            <i class='fa fa-reorder'></i> Cant
                                        </th>
                                        <th>
                                            <i class='fa fa-dollar'></i> Vr Unit
                                        </th>
                                        <th class='hidden-xs'>
                                            <i class='fa fa-dollar'></i> Tot Rep
                                        </th>
                                        <th>
                                            <i class='fa fa-user'></i> Vr Mano Obra
                                        </th>
                                        <th>
                                            <i class='fa fa-dollar'></i> Sub Total
                                        </th>
                                        <th>
                                        	<i class='fa fa-gears'></i> Acciones
                                        </th>
                                    </tr>
                                </thead>
						";
						
							echo "<tbody>";
							if ($resultset2->num_rows > 0) {
								while ($row2 = $resultset2->fetch_assoc()) {
									$id_rep=$row2["id_rep"];
									$sql3 ="SELECT * FROM  flot_rep WHERE  `id_rep` = $id_rep";
                                    $resultset3 = $conn->query($sql3);
                                    $row3 = mysqli_fetch_row($resultset3); 
                                    setlocale(LC_MONETARY, 'en_US');

                                   	echo "<tr>
											<td>
											    <a href='#'>".$row3[1]."</a>
											</td>
											<td class='hidden-xs'>
											    ".$row2["cant"]."
											</td>
											
											<td>
												".money_format('%(#5n', $row3[2])."
											</td>
											<td>
											   	".money_format('%(#5n', $totrep=$row2["cant"]*$row3[2])."
											</td>
											<td>
											    ".money_format('%(#5n', $row2["v_mo"])."                                                                          
											</td>
										
											<td class='hidden-xs'>
											    ".money_format('%(#5n', $subtot= $totrep+$row2["v_mo"])."
											</td>
											<td id ='".$tot_rep=$tot_rep+$subtot."'>
												<div class='btn-group'> 
						                            <button type='button' data-toggle='modal' data-target='#mod_editrep_espact' onclick=\"$('#id_srep_ed').val(".$row2["id_srep"]."); $('#id_dserv_ed').val(".$id_dserv."); $('#id_rep_ed').val(".$row3[0]."); $('#cant_ed').val(".$row2["cant"]."); $('#v_mo_ed').val(".$row2["v_mo"].");\" class='btn btn-default'><i class='fa fa-edit'></i></button>
						                            <button type='button' data-toggle='modal' data-target='#mod_eliminar_srep' onclick=\"$('#id_srep').val(".$row2["id_srep"].");\" name='sut1'  id='sut1' class='btn btn-default' value=''><i class='fa fa-trash-o'></i></button>
						                        </div>
											</td>
                                        </tr>";
								}
							}

						echo "</table>";
						// Tabla de repuestos
						// Tabla mano de obra
						$sql4 = "SELECT * FROM flot_srep WHERE `id_dserv` = $id_dserv AND id__tip = 1";
                    	$resultset4 = $conn->query($sql4);
                    	
                    		echo "<hr class='wide'>";
                    		echo "<table class='table table-striped table-bordered table-hover'>
								<thead>
                                    <tr>
                                        <th>
                                            <i class='fa fa-gears'></i> Mano de obra
                                        </th>
                                        <th class='hidden-xs'>
                                            <i class='fa fa-dollar'></i> Valor
                                        </th>
                                        <th>
                                            <i class='fa fa-clock-o'></i> Horas/hombre
                                        </th>
                                        <th class='hidden-xs'>
                                            <i class='fa fa-dollar'></i> Subtotal
                                        </th>
                                        <th>
                                        	<i class='fa fa-gears'></i> Acciones
                                        </th>
                                    </tr>
                                </thead>
						";
						
							echo "<tbody>";
							if ($resultset4->num_rows > 0) {
								while ($row4 = $resultset4->fetch_assoc()) {
									$id_rep2=$row4["id_rep"];
                                    setlocale(LC_MONETARY, 'en_US');

                                   	echo "<tr>
											<td>
											    <a href='#'>".$row4["m_obra"]."</a>
											</td>
											<td class='hidden-xs'>
											    ".money_format('%(#5n', $row4["v_mo"])."
											</td>
											<td>
												".$row4["h_hombre"]."
											</td>
											<td>
												".money_format('%(#5n', $subtotmo=$row4["v_mo"]*$row4["h_hombre"])."
											</td>
											<td id ='".$totmo=$totmo+$subtotmo."'>
												<div class='btn-group'> 
						                            <button type='button' data-toggle='modal' data-target='#mod_edit_mo' onclick=\"$('#m_obra_mo').val('{".$row4["m_obra"]."}'); $('#id_srep_mo').val(".$row4["id_srep"]."); $('#id_dserv_mo').val(".$row4["id_dserv"]."); $('#id_tip_mo').val(".$row4["id__tip"]."); $('#v_mo_mo').val(".$row4["v_mo"]."); $('#h_hombre_mo').val(".$row4["h_hombre"].");\" class='btn btn-default'><i class='fa fa-tasks'></i></button>
						                            <button type='button' data-toggle='modal' data-target='#mod_eliminar_mo' onclick=\"$('#id_srep_moel').val(".$row4["id_srep"].");\" name='sut1'  id='sut1' class='btn btn-default' value=''><i class='fa fa-trash'></i></button>
						                        </div>
											</td>
                                        </tr>";
								}
							}

						echo "</table>";
                    	
						
						echo "<br>";
						echo "<button class='btn btn-default btn-xs purple' data-toggle='modal' data-target='#mod_rep_espact' onclick=\"$('#id_dserv').val(".$id_dserv.");\"><i class='fa fa-edit'></i> Ingresar respuesto</button>";
                        echo "<button class='btn btn-default btn-xs purple' data-toggle='modal' data-target='#mod_mo_espact' onclick=\"$('#id_dserv').val(".$id_dserv.");\"><i class='fa fa-users'></i> Ingresar mano de obra</button>";
                        echo "<hr class='wide'>";
                        echo "<span>Total: ".money_format('%(#5n', $totsrep = $totmo + $tot_rep)."</span>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		}
	}
}
?>