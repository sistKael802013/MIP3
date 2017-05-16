<?php 
include("assets/includes/connection.php");
session_start();

$sql = "SELECT  * FROM flot_rep";
$resultset = $conn->query($sql);
if(!$resultset){
    echo "Error: ". $conn->error; 
}else{
    echo '<div class="table-responsive">';
    echo '<table id="example" class="tbl-qa table table-striped table-bordered" cellspacing="0" width="100%"> 
            <thead>
                <tr>
                  <th>Repuesto</th>
                  <th>Vr. Unitario</th>
                  <th>Unidad</th>    
                </tr>
            </thead>
        ';
    if ($resultset->num_rows > 0) {
        echo '<tbody>';
        while($row = $resultset->fetch_assoc()) {
            
                echo"
                <tr>
                    <td contenteditable='true' onBlur='saveToDatabase(this,'repuesto','".$row["repuesto"]."')' onClick='showEdit(this);'>
                        '".$row["repuesto"]."'
                    </td>
                    <td  contenteditable='true' onBlur='saveToDatabase(this,'vr_unit','".$row["vr_unit"]."')' onClick='showEdit(this);'>
                        '".$row["vr_unit"]."'
                    </td>
                    <td contenteditable='true' onBlur='saveToDatabase(this,'unidad','".$row["unidad"]."')' onClick='showEdit(this);'>
                        '".$row["unidad"]."'
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