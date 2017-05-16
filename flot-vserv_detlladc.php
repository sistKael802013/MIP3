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


echo '<table class="table" style="margin-bottom:20px;"> 
             <tr>
                <th>
                        #Servicio Kael:
                </th>

                <td>
                    '. $row[0].'         
                </td>
                <th>
                        Fecha Ingreso:
                </th>
                <td>
                    '. $row[1].'  
                </td>
                <th>
                        Fecha Entrega:
                </th>
                <td>
                    '. $row[2].'   
                </td>
                </tr>

                 <tr>
                <th>
                        No Equipo:
                </th>

                <td>
                    '. $row7[1].'        
                </td>
                <th>
                        No Placa:
                </th>
                <td>
                     '. $row7[2].'   
                </td>
                <th>
                        Cliente:
                </th>
                <td>
                    '. $row7[3].'  
                </td>
                </tr>
               <tr>
                <th>
                        No Servicio:
                </th>

                <td>
                    '. $row[5].'         
                </td>
                <th>
                        No factura:
                </th>
                <td>
                    '. $row[8].'   
                </td>
                <th>
                        Vr Facturado:
                </th>
                <td>
                    '.money_format('%(#5n', $row[7]).'   
                </td>
                </tr>

                <tr>
                <th>
                       Comentario:
                </th>
                <td colspan="5">
                    '.$row[10].'
                </td>
                </tr>
        </table>' ;


?>