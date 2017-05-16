<?php 
require_once("assets/includes/connection.php"); 
?>
<?php
        session_start();

        $repuesto=$_POST["repuesto"];
        $vr_unit=$_POST["vr_unit"];     
        $unidad=$_POST["unidad"];
        $opcion = $_POST["opcion"];

        $n_serv=$_POST['n_serv'];
        $n_ordn=$_POST['n_ordn'];
        $vr_fact=$_POST['vr_fact'];
        $n_fact=$_POST['n_fact'];
        $n_placa=$_POST['n_placa'];

        $id_serv = $_POST["id_serv"];

        $id_tip=$_POST["id_tip"];
        $v_mo=$_POST["vr_mo"];
        $id_rep=$_POST["id_rep"];
        $cant=$_POST["cant"];     
        $id_dserv=$_POST["id_dserv"];

        $h_hombre=$_POST["h_hombre"];     
        $m_obra=$_POST["m_obra"];
        $espc=$_POST['sel_espc'];
        $actvi=$_POST['sel_actv'];        
                
        $id_srep = $_POST["id_srep"];      
        
        $informacion = [];
       
        switch($opcion) {

            case "n_rep":
            $query = "INSERT INTO flot_rep (repuesto, vr_unit, unidad)". 
            "VALUES ('$repuesto', '$vr_unit', '$unidad')";
            $resultado = mysqli_query($conn, $query);
            verificar_resultado($query);
            cerrar( $conn );
            break;

            case "info_adc":
            $sql_detll = "UPDATE flot_servicios SET no_serv='$n_serv', no_orden='$n_ordn', vr_serv='$vr_fact', no_fact='$n_fact'  WHERE id_serv= '$id_serv'";
            $resultado = $conn->query($sql_detll);
            verificar_resultado($sql_detll);
            cerrar($conn);
            break;

            case "guardar_srep":
            $sql_srep = "INSERT INTO flot_srep (id_rep, id_dserv, cant, v_mo, id__tip)" .
            "VALUES ($id_rep, $id_dserv, $cant, $v_mo, $id_tip)";
            $resultado = $conn->query($sql_srep);
            verificar_resultado($resultado, $sql_srep);
            cerrar( $conn );
            break;
            
            case "editar_rep":
            $sqleditar_srep = "UPDATE flot_srep SET id_rep = '$id_rep', id_dserv='$id_dserv', cant='$cant', v_mo='$v_mo', id__tip='$id_tip'  WHERE id_srep = $id_srep";
            $resultado = $conn->query($sqleditar_srep);
            verificar_resultado( $resultado, $sqleditar_srep );
            cerrar( $conn );
            break;

            case "v_mobra":
            $query_mo = "INSERT INTO flot_srep (id__tip, id_dserv, h_hombre, v_mo, m_obra)" .
            "VALUES ($id_tip, $id_dserv, $h_hombre, $v_mo, '$m_obra')";
            $resultado = mysqli_query($conn, $query_mo);
            verificar_resultado( $resultado, $query_mo );
            cerrar( $conn );
            break;

            case "editar_mobra":
            $sqleditar_mo = "UPDATE flot_srep SET m_obra = '$m_obra', id_srep='$id_srep', id_dserv='$id_dserv', id__tip='$id_tip', v_mo='$v_mo', h_hombre='$h_hombre' WHERE id_srep = $id_srep";
            $resultado = $conn->query($sqleditar_mo);
            verificar_resultado( $resultado, $sqleditar_mo );
            cerrar( $conn );
            break;

            case "nespact":
            $sqlf = "INSERT INTO flot_dserv (id_serv, especialidad, actividad) VALUES ('$id_serv','$espc','$actvi')";
            $conn->query($sqlf);
            verificar_resultado( $sqlf );
            cerrar( $conn );
            break;

            case "edit_espact":
            $query = "UPDATE flot_dserv SET especialidad = '$espc', actividad = '$actvi' WHERE id_dserv= $id_dserv";
            $resultado = mysqli_query($conn, $query);
            verificar_resultado( $resultado, $query );
            cerrar( $conn );
            break;

            case "eliminar_srep":
            $query = "DELETE FROM flot_srep WHERE id_srep = $id_srep";
            $resultado = mysqli_query($conn, $query);
            verificar_resultado($resultado);
            cerrar($conn);
            break;

            case "eliminar_dserv":
            $query = "DELETE FROM flot_dserv WHERE id_dserv = $id_dserv";
            $query_srep = "DELETE FROM flot_srep WHERE id_dserv = $id_dserv";
            $resultado = $conn->query($query);
            $conn->query($query_srep);
            verificar_resultado( $resultado, $query );
            cerrar( $conn );
            break;

            case "eliminar_mo":
            $querydel_mo = "DELETE FROM flot_srep WHERE id_srep = $id_srep";
            $resultado = mysqli_query($conn, $querydel_mo);
            verificar_resultado($resultado, $querydel_mo);
            cerrar($conn);
            break;
        }

        //Verificacion de la consulta
        function verificar_resultado($resultado, $sqlquery){
            if (!$resultado){
                $informacion["respuesta"] = "Error: " . $sqlquery . "<br>" . $conn->error;
            } else{
                $informacion["respuesta"] = "Exito en la consulta: ".$sqlquery;
            }
                echo json_encode($informacion);
        }

        function cerrar($conn){
            mysqli_close($conn);
        }

    ?>