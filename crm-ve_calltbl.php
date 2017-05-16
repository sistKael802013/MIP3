<?php 
include("assets/includes/connection.php");
session_start();
$idempresa = $_SESSION["idempresa"]; //ID de la empresa
$sql1 = "SELECT * FROM  `crm_cont` WHERE  id_emp = $idempresa"; //Consulta de contactos por ID de la empresa
$resultset = $conn->query($sql1);
if(!$resultset){
    echo "Error: ". $conn->error; //Mostrar error si la consulta fue fallida.
}else{
    if ($resultset->num_rows > 0) {
    
    echo '<table class="table table-striped table-bordered table-hover" style="margin-bottom:20px;"> 
                <tr>
                  <th>Nombre</th>
                  <th>Cargo</th>
                  <th>Telefono</th>
                  <th>e-mail</th>
                  <th>Opciones</th>     
                </tr>
        ';
        while($row = $resultset->fetch_assoc()) {
                echo"
                <tr>
                    <td>
                        ".$row["saludo"]." ".$row["nombre"]."
                    </td>
                    <td class='no-sort'>
                        ".$row["cargo"]."
                    </td>
                    <td>
                        ".$row["tel"]."
                    </td>
                    <td>
                        ".$row["email"]."
                    </td>
                    <td>
                        <div class='btn-group'> 
                            <button type='button' onclick=\"ver_dat_cont('".$row["saludo"]."','".$row["nombre"]."', '".$row["cargo"]."', '".$row["tel"]."', '".$row["cel"]."', '".$row["email"]."', '".$row["email2"]."', '".$row["f_nac"]."')\" data-toggle='modal' data-target='#mod_ver_contact' class='btn btn-default'><i class='glyphicon glyphicon-eye-open'></i></button>
                            <button type='button' onclick=\"$('#id_cont_ed').val(".$row["id_cont"]."); $('#saludo_ed').val('".$row["saludo"]."'); $('#nombre_ed').val('".$row["nombre"]."'); $('#cargo_ed').val('".$row["cargo"]."'); $('#tel_ed').val('".$row["tel"]."'); $('#cel_ed').val('".$row["cel"]."'); $('#email_ed').val('".$row["email"]."'); $('#email2_ed').val('".$row["email2"]."'); $('#f_nac_ed').val('".$row["f_nac"]."');\" data-toggle='modal' data-target='#mod_editar_contact' class='btn btn-default'><i class='fa fa-tasks'></i></button>
                            <button type='button' onclick=\"$('#id_cont_el').val(".$row["id_cont"].");\" data-toggle='modal' data-target='#mod_el_contact' name='sut1'  id='sut1' class='btn btn-default' value=''><i class='fa fa-trash'></i></button>
                        </div>
                    </td>
                </tr>
                ";
        } 
        echo '</table>'; 
    }else{
        echo "<h2>Sin contactos registrados aún.</h2>";
    }
}
?>
