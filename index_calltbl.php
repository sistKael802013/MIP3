<?php 
include("assets/includes/connection.php");
session_start();
$usuario= $_SESSION["nick"];

$sql4 = "SELECT * FROM tareas WHERE switch = 'on' AND p_creatarea='".$usuario."' order by id_tarea ASC";
$resultado = $conn->query($sql4);
$_SESSION["numrow"] = mysqli_num_rows($resultado);
if(!$resultado){
    echo "Error: ". $conn->error; 
}else{
    echo '<div class="table-responsive">';
    echo '<table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
            <thead>
                <tr>
                    <th>Nombre Tarea</th>
                    <th class="hidden-xs"> Fecha Entrega</th>
                    <th class="hidden-xs"> Asignado </th>
                    <th>Status</th>
                    <th>Opciones</th>
                </tr>
            </thead>
        ';
    if ($resultado->num_rows > 0) {
        echo '<tbody>';
        while($row = $resultado->fetch_assoc()) {
            $fecha2 = new DateTime($row["f_entrega"]);
            $fecha1 = new DateTime($f_inicio);
            $sta = $row["status"];
            if($sta == "Entregado"){
                $label = "green";
                
            }else{
                
                if($fecha1 < $fecha2){
                    $label="yellow";
                   
                } else {
                    $id_t = $row["id_tarea"];
                    $label="red";
                    $labelt1="Atrazado";  
                    $sql_status = "UPDATE tareas SET status = 'Atrazado' WHERE id_tarea = $id_t";
                    $conn->query($sql_status);
                }
            }
                echo"
                <tr class=''>
                    <td>
                        ".$row["n_tarea"]."
                    </td>
                    <td class='no-sort'>
                        ".$row["f_entrega"]."
                    </td>
                    <td>
                        ".$row["pasign"]."
                    </td>
                    <td>
                        <div class='task-state'>
                            <span class='label label-".$label."' >".$row["status"]."</span>
                        </div>
                    </td>
                    <td>
                        <div class='btn-group'> 
                            <a href='v_tarea.php?id=".$row["id_tarea"]."' type='button' class='btn btn-default'><i class='fa fa-folder-open-o'></i></a>
                            <button type='button' onclick=\"$('#id_tarea_ed').val(".$row["id_tarea"]."); $('#n_tarea_ed').val('".$row["n_tarea"]."'); $('#f_entrega_ed').val('".$row["f_entrega"]."'); $('#d_tarea_ed').val('".$row["d_tarea"]."'); $('#prioridad_ed').bootstrapToggle('".$row["prioridad"]."');\" class='btn btn-default' data-toggle='modal' data-target='#mod_editar' ><i class='fa fa-edit'></i></button>
                            <button type='button' onclick=\"$('#id_tarea_el').val(".$row["id_tarea"].")\" data-toggle='modal' data-target='#mod_eliminar' name='sut1'  id='sut1' class='btn btn-danger' value=''><i class='fa fa-trash'></i></button>
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

// $arr["data"] = [];
// while( $data = mysqli_fetch_assoc($resultado)){
//     //$arr["data"][] = array_map("utf8_encode", $data);
//     $arr["data"][] = $data;
// }
// echo json_encode($arr);

// mysqli_free_result($resultado);
// mysqli_close($conn);

?>