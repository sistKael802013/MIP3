<?php 
include("assets/includes/connection.php");
session_start();
$idempresa = $_SESSION["idempresa"]; //ID de la empresa
$sql1 = "SELECT 
crm_oport.id, 
crm_oport.propietario AS idprop, 
crm_oport.nombre AS descripcion, 
crm_oport.codigo, 
crm_oport.contacto AS id_con, 
crm_oport.tel, 
crm_oport.id_emp, 
crm_oport.valor, 
crm_oport.fecha_cierre, 
crm_oport.fase, 
crm_oport.probabilidad, 
crm_oport.info, 
crm_oport.status, 
usuarios.id_usr, 
usuarios.nombre AS propietario, 
crm_cont.id_cont, 
crm_cont.nombre AS nom_contacto 
FROM crm_oport, usuarios, crm_cont 
WHERE crm_oport.id_emp = $idempresa AND crm_oport.propietario = usuarios.id_usr AND crm_oport.contacto = crm_cont.id_cont"; //Consulta de contactos por ID de la empresa
$resultset = $conn->query($sql1);
if(!$resultset){
    echo "Error: ". $conn->error; //Mostrar error si la consulta fue fallida.
}else{
    if ($resultset->num_rows > 0) {
    
    echo '<table class="table table-striped table-bordered table-hover" style="margin-bottom:20px;"> 
			<thead>
                <tr>
                    <th>Nombre Oportunidad </th>
                    <th class="hidden-xs"> Contacto </th>
                    <th class="hidden-xs"> Valor</th>
                    <th class="hidden-xs"> Fecha Cierre </th>
                    <th>Opciones</th>     
                </tr>
			</thead>
        ';
        echo "<tbody>";
        while($row = $resultset->fetch_assoc()) {
                echo"
                <tr>
                    <td>
                        ".$row["descripcion"]." 
                    </td>
                    <td class='no-sort'>
                        ".$row["nom_contacto"]."
                    </td>
                    <td>
                        ".$row["valor"]."
                    </td>
                    <td>
                        ".$row["fecha_cierre"]."
                    </td>
                    <td>
                        <div class='btn-group'> 
                            
                            <button type='button' onclick=\"
                            $('#id_opor_ed').val(".$row["id"]."); 
                            $('#sel_prop_ed').val('".$row["idprop"]."'); 
                            $('#n_opor_ed').val('".$row["descripcion"]."'); 
                            $('#c_opor_ed').val('".$row["codigo"]."'); 
                            $('#sel_copor_ed').val('".$row["id_con"]."'); 
                            $('#v_opor_ed').val('".$row["valor"]."'); 
                            $('#fc_opor_ed').val('".$row["fecha_cierre"]."'); 
                            $('#cm_opor_ed').val('".$row["info"]."');
                            $('#f_opor_ed').val('".$row["fase"]."');
                            $('#pro_opor_ed').val('".$row["probabilidad"]."');\" data-toggle='modal' data-target='#mod_editar_opor' class='btn btn-default'><i class='fa fa-tasks'></i></button>
                            <button type='button' onclick=\"$('#id_opor_el').val(".$row["id"].");\" data-toggle='modal' data-target='#mod_el_opor' name='sut1'  id='sut1' class='btn btn-default' value=''><i class='fa fa-trash'></i></button>
                        </div>
                    </td>
                </tr>
                ";
        } 
        echo "</tbody>";
        echo '</table>'; 
    }else{
        echo "<h2>Sin oportunidades registradas aun.</h2>";
    }
}
?>

