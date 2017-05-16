<?php 
include("assets/includes/connection.php");
$id_srep = $_POST["id_srep"];
$opcion = $_POST["opcion"];
$v_mo = $_POST["v_mo"];
$cant = $_POST["cant"];
$informacion = [];

switch($opcion) {
	case "modificar":
		modificar($id_srep, $v_mo, $cant, $conn);
		break;
	
	case "eliminar":
		eliminar($id_srep, $conn);
		break;
	
}

function modificar($id_srep, $v_mo, $cant, $conn){
	$query= "UPDATE flot_srep SET v_mo='$v_mo' , cant= '$cant' WHERE id_srep=$id_srep";
	$resultado = mysqli_query($conn, $query);
	verificar_resultado( $resultado );
	cerrar( $conn );
}

function eliminar($id_srep, $conn){

	$query = "DELETE FROM flot_srep WHERE id_srep = $id_srep";
	$resultado = mysqli_query($conn, $query);
	verificar_resultado( $resultado );
	cerrar( $conn );

}

function verificar_resultado($resultado){
	if (!$resultado){
		$informacion["respuesta"] = "ERROR";
	} else{
	 $informacion["respuesta"] = "BIEN";
	}
	echo json_encode($informacion);
}

function cerrar($conn){
	mysqli_close($conn);
}

?>