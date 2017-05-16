<?php 
require_once("assets/includes/connection.php");

session_start();
$id_tarea = $_SESSION["id_tarea"];
$response = [];
$est = "Entregado";

 $sql_sta = "UPDATE tareas SET status = 'Entregado' WHERE id_tarea = $id_tarea";
 $resultado = $conn->query($sql_sta);

if (!$resultado){
	$informacion["respuesta"] = $conn->error;
} else {
	$informacion["respuesta"] = "Entregado";
}
echo json_encode($informacion);

?>