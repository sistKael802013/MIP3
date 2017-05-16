<?php require_once("assets/includes/connection.php"); 

        //Se inicia la sesion
   		session_start();
        $saludo= $_POST["saludo"];
        $nombre=$_POST["nombre"];
        $tel=$_POST["tel"];
        $cargo= $_POST["cargo"];
        $cel=$_POST["cel"];
        $email= $_POST["email"];
        $email2 = $_POST["email2"];
        $f_nac=$_POST["f_nac"];
        $fuente=$_POST["fuente"];
        $id_emp= $_SESSION["idempresa"];
        $id_cont = $_POST["id_cont"];

        $id = $_POST["id"];
        $propietario = $_POST["propietario"];
        $nombre = $_POST["nombre"];
        $codigo = $_POST["codigo"];
        $contacto = $_POST["contacto"];
        $valor = $_POST["valor"];
        $fecha_cierre = $_POST["fecha_cierre"];
        $info = $_POST["info"];
        $fase = $_POST["fase"];
        $probabilidad = $_POST["probabilidad"];

        $opcion = $_POST["opcion"];

        switch($opcion) {
            // CONTACTO
            case "guardar_cont":
                $sql = "INSERT INTO crm_cont (saludo, nombre, tel, cargo, cel, email, email2, f_nac, id_emp) " .
                            "VALUES ('$saludo','$nombre', '$tel', '$cargo', '$cel', '$email', '$email2', '$f_nac', '$id_emp')";
                $resultado = mysqli_query($conn, $sql);
                verificar_resultado( $resultado, $sql );
                cerrar( $conn );
                
            break;

            case "editar_cont":
                $query_ed= "UPDATE crm_cont SET saludo = '$saludo', nombre = '$nombre', tel = '$tel', cargo = '$cargo', cel = '$cel', email = '$email', email2 = '$email2', f_nac = '$f_nac', id_emp = '$id_emp' WHERE id_cont=$id_cont";
                $resultado = mysqli_query($conn, $query_ed);
                verificar_resultado( $resultado, $query_ed );
                cerrar( $conn );
            break;


            case "eliminar_cont":         
                // Elimina el servicio
                $query_el = "DELETE FROM crm_cont WHERE id_cont=$id_cont";
                $resultado = mysqli_query($conn, $query_el);
                verificar_resultado( $resultado, $query_el);
                cerrar( $conn );
            break;
            // ################################

            // OPORTUNIDAD
            case "guardar_opor":
                $query_opor_add = "INSERT INTO crm_oport(propietario, nombre, codigo, contacto, id_emp, valor, fecha_cierre, fase, probabilidad, info, status)" .
                            "VALUES ('$propietario','$nombre', '$codigo', '$contacto', '$id_emp', '$valor', '$fecha_cierre', '$fase', '$probabilidad', '$info', 'on')";
                $resultado = mysqli_query($conn, $query_opor_add);
                verificar_resultado( $resultado, $query_opor_add );
                cerrar( $conn );
                
            break;

            case "editar_opor":
                $query_opor_edit= "UPDATE crm_oport SET propietario= '$propietario',nombre='$nombre',codigo='$codigo',contacto=$contacto, id_emp = '$id_emp' ,valor=$valor,fecha_cierre='$fecha_cierre',fase='$fase',probabilidad=$probabilidad,info='$info', WHERE id = $id";
                $resultado = mysqli_query($conn, $query_opor_edit);
                verificar_resultado( $resultado, $query_opor_edit );
                cerrar( $conn );
            break;


            case "eliminar_opor":         
                // Elimina el servicio
                $query_opor_del = "DELETE FROM crm_oport WHERE id=$id";
                $resultado = mysqli_query($conn, $query_opor_del);
                verificar_resultado( $resultado, $query_opor_del);
                cerrar( $conn );
            break;
            // ########################################
           
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