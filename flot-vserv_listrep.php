<?php 
require_once("assets/includes/connection.php"); 


    $sql2 = "SELECT  * FROM flot_rep";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) { 

echo "<select id='id_rep' style='width:100%;' sized='4'>";
    while($row2 = $result2->fetch_assoc()){
       echo "<option value='".$row2["id_rep"]."'/>".$row2["repuesto"]."";
    } 
echo "</select>";
}
?>