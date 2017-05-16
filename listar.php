<?php 
include("assets/includes/connection.php");
session_start();
$id_dserv=$_SESSION["id_dserv"];

$sql_srep = "SELECT flot_srep.id_srep, flot_rep.id_rep, flot_rep.repuesto, flot_rep.vr_unit, flot_srep.id_dserv, flot_srep.id_rep, flot_srep.cant, flot_srep.v_mo, flot_srep.cant * flot_rep.vr_unit AS totrep, (flot_srep.cant * flot_rep.vr_unit) + flot_srep.v_mo AS subtot FROM flot_srep, flot_rep WHERE id_dserv =3 AND flot_srep.id_rep = flot_rep.id_rep"; 
$resultado = mysqli_query($conn, $sql_srep);

if(!$resultado){
    die("Error");
}else{
    $arr["data"] = [];
    while( $data = mysqli_fetch_assoc($resultado)){
        //$arr["data"][] = array_map("utf8_encode", $data);
        $arr["data"][] = $data;
    }
    echo json_encode($arr);
}

mysqli_free_result($resultado);
mysqli_close($conn);
?>