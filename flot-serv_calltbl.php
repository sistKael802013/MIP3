<?php 
include("assets/includes/connection.php");
session_start();

$sql1 = "SELECT * FROM  flot_servicios, flot_mx WHERE flot_servicios.mx = flot_mx.id_mx";
$resultset = $conn->query($sql1);
$_SESSION["numrow"] = mysqli_num_rows($resultset);
if(!$resultset){
    echo "Error: ". $conn->error; 
}else{
    echo '<div class="table-responsive">';
    echo '<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
            <thead>
                <tr>
                  <th>Fecha Entrada</th>
                  <th>Fecha Entrega</th>
                  <th>No Servicio</th>
                  <th>Equipo</th>
                  <th>Status</th>
                  <th>Opciones</th>     
                </tr>
            </thead>
        ';
    if ($resultset->num_rows > 0) {
        echo '<tbody>';
        while($row = $resultset->fetch_assoc()) {
            
            $sta = $row["status"];
            if($sta == "Entregado"){
                $label = "green";
            }elseif($sta == "Creado"){
                $label = "yellow";
            }else{
                $label = "red";
            }
                echo"
                <tr>
                    <td>
                        ".$row["fecha_ing"]."
                    </td>
                    <td class='no-sort'>
                        ".$row["fecha_ent"]."
                    </td>
                    <td>
                        ".$row["no_serv"]."
                    </td>
                    <td>
                        ".$row["mx"]."
                    </td>
                    <td>
                        <div class='task-state'>
                            <span class='label label-".$label."' >".$row["status"]."</span>
                        </div>
                    </td>
                    <td>
                        <div class='btn-group'> 
                            <a href='flot-vserv.php?id=".$row["id_serv"]." 'type='button' class='btn btn-default'><i class='fa fa-folder-open'></i></a>
                            <button type='button'  onclick=\"$('#id_serv_ed').val(".$row["id_serv"]."); $('#no_serv_ed').val(".$row["no_serv"]."); $('#mx_ed').val(".$row["id_mx"]."); $('#fecha_ent_ed').val('".$row["fecha_ent"]."'); $('#comentario_ed').val('".$row["comentario"]."');\" data-toggle='modal' data-target='#mod_editar_serv' class='btn btn-default'><i class='fa fa-tasks'></i></button>
                            <button type='button'  onclick=\"$('#id_serv_el').val(".$row["id_serv"].");\" data-toggle='modal' data-target='#mod_eliminar_ser'  name='sut1'  id='sut1' class='btn btn-danger' value=''><i class='fa fa-trash'></i></button>
                        </div>
                    </td>
                </tr>
                ";
           

        }
        echo '</tbody>';    
        echo '</table>';
        echo '</div>';
    }
}
?>