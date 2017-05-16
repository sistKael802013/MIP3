<?php require_once("assets/includes/connection.php"); 

        //Se inicia la sesion
   		session_start();
        //Captura de valores de en variables por método POST, la funciones en 'index.php' (FUNCIONAL)
        $no_serv= $_POST["no_serv"];
        $mx= $_POST["mx"];
        $time= time();
        $fecha_ing= date("d-m-Y", $time);
        $fecha_ent= $_POST["fecha_ent"];
        $comentario = $_POST["comentario"];
        $id_serv = $_POST["id_serv"];
        $opcion = $_POST["opcion"];

        //Ejecucion de funciones segun el caso (guardar, eliminar, editar) FUNCIONAL
        switch($opcion) {
            case "guardar":
            $sql = "INSERT INTO flot_servicios (fecha_ing ,fecha_ent, comentario ,status ,mx, no_serv) " .
                    "VALUES ('$fecha_ing','$fecha_ent', '$comentario', 'Creado', '$mx', '$no_serv')";
            $resultado = mysqli_query($conn, $sql);
            verificar_resultado( $resultado, $sql );
            cerrar( $conn );
            // $var_prioridad = $_POST['prioridad'];
            break;

            case "editar":
            $query_ed= "UPDATE flot_servicios SET fecha_ent = '$fecha_ent', comentario ='$comentario', mx ='$mx', no_serv ='$no_serv' WHERE id_serv=$id_serv";
            $resultado = mysqli_query($conn, $query_ed);
            verificar_resultado( $resultado, $query_ed );
            cerrar( $conn );
            break;


            case "eliminar":
            // Se consulta los id's de las actividades relacionadas con el servicio a eliminar
            $a = "SELECT * FROM flot_dserv WHERE id_serv = $id_serv";
            $r =  $conn->query($a);

            if (!$r) {
                verificar_resultado( $r, $a);
            }else{
                if ($r->num_rows > 0){

                while($ro = $r->fetch_assoc()) {

                    $id_ds = $ro["id_dserv"];
                    // Elimina repuestos relacionados con las actividades del servicio
                    $query_elsrep = "DELETE FROM flot_srep WHERE id_dserv = $id_ds";
                    $conn->query($query_elsrep);
                    verificar_resultado( $r, $query_elsrep);

                }
                
             }
            }
            
            // Elimina el servicio
            $query_el = "DELETE FROM flot_servicios WHERE id_serv = $id_serv";
            $resultado = mysqli_query($conn, $query_el);
            // Elimina actividades del servicio
            $query_elespact = "DELETE FROM flot_dserv WHERE id_serv = $id_serv";
            mysqli_query($conn, $query_elespact);
            verificar_resultado( $resultado, $query_el);
            cerrar( $conn );
            break;





            case "guardareq":
            $sql_eq = "INSERT INTO flot_mx ( mx, placa, cliente)" .
                    "VALUES ('$no_equipo','$no_placa', '$cliente')";
            $resultado = mysqli_query($conn, $sql_eq);
            verificar_resultado( $resultado, $query_ed );
            cerrar( $conn );
            // $var_prioridad = $_POST['prioridad'];
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

        //Cierre de la conexion
        function cerrar($conn){
            mysqli_close($conn);
        }

    ?>