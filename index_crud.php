<?php require_once("assets/includes/connection.php"); //Conexion a base de datos ?>
<?php 


        //Se inicia la sesion
   		session_start();
        //Captura de valores de en variables por método POST, la funciones en 'index.php' (FUNCIONAL)
        $p_creatarea= $_SESSION["nick"];
        $id_tarea = $_POST["id_tarea"];
        $n_tarea=$_POST["n_tarea"];
        $time= time();
        $f_inicio= date("d-m-Y", $time);
        $f_entrega = $_POST["f_entrega"];
        $prioridad = $_POST["prioridad"];
        $d_tarea = $_POST["d_tarea"];
        $opcion = $_POST["opcion"];
        $insertar = "'" . implode(',', $_POST['e2']) . "'";
        if ($_POST['prioridad'] =='on'){
            $var_prioridad= "on";
        } else {
            $var_prioridad= "off";
        }
        $switch = $_POST["switch"];
        
        //Ejecucion de funciones segun el caso (guardar, eliminar, editar) FUNCIONAL
        switch($opcion) {

            // TAREAS
            case "guardar":

				$sql = "INSERT INTO tareas (n_tarea, pasign, f_inicio, p_creatarea, f_entrega, d_tarea, prioridad, status, switch) " .
				        "VALUES ('$n_tarea', $insertar, '$f_inicio', '$p_creatarea', '$f_entrega', '$d_tarea', '$var_prioridad',  'En Curso', 'on')";
	            $resultado = mysqli_query($conn, $sql);
	            verificar_resultado( $resultado, $sql );

	            $pasignado = explode(",", $insertar);
	            $cant= count($pasignado);
	        
	            for($i=0; $i<$cant;$i++){ 

	                $to = $pasignado[$i];
	                $pas ="SELECT  * FROM  `usuarios` WHERE  `user` =  $to ";
	                $rpas = $conn->query($pas);
	                $rowpas = mysqli_fetch_row($rpas);
	                $mailpass=$rowpas[4];
	                $name = "MIPproject";
	                $email="info@mipproject.com";
	                $headers .= "From: ". $name ." <". $email .">\r\n"; 
	                $cuerpo .= "Hola " . $to . "\r\n"; 
	                $cuerpo .= "Se le ha asignado una tarea en MIPproject, por favor ingresa para verificarla \r\n"; 
	                $cuerpo .= "http://www.mipproject.com/dashboard/ \n\n";
	                $cuerpo .= "Soporte Mipproject \n\n";
	                @mail($mailpass, "Se te asigno una tarea", $cuerpo, $headers);

	            }
	            cerrar( $conn );  

            break;

            case "editar":

	 			$query= "UPDATE tareas SET n_tarea = '$n_tarea', pasign =$insertar, p_creatarea ='$p_creatarea', f_entrega ='$f_entrega', d_tarea ='$d_tarea', prioridad ='$var_prioridad', status = 'En Curso', switch = 'on' WHERE id_tarea=$id_tarea";
	            $resultado = mysqli_query($conn, $query);
	            verificar_resultado( $resultado, $query);
	            cerrar( $conn );      

            break;
        
            case "eliminar":
            
	            $query1 = "DELETE FROM tareas WHERE id_tarea = $id_tarea";
	            $query2 = "DELETE FROM comentareas WHERE id_tarea = $id_tarea";

	            $resultado = mysqli_query($conn, $query1);
	            $resultado = mysqli_query($conn, $query2);
	            verificar_resultado( $resultado, $query1 );
	            cerrar( $conn );

            break;


            case "show_hide":
                $querysh = "UPDATE tareas SET switch = $switch WHERE id_tarea = $id_tarea";
                $resultado = mysqli_query($conn, $querysh);
                verificar_resultado( $resultado, $querysh );
	            cerrar( $conn );
            break;
            // TAREAS

            // COMENTARIOS 
            case "guardar_coment":

                $sql = "INSERT INTO comentareas (id_tarea, id_usuario, t_comentario, f_coment, cotar) " .
        "VALUES ('$id_tarea', '$usuarioc', '$coment', '$f_coment', '$cotar')";
                $resultado = mysqli_query($conn, $sql);
                verificar_resultado( $resultado, $sql );

                $to = $row[5];
                $pas ="SELECT  * FROM  `usuarios` WHERE  `user` =  $to ";
                $rpas = $conn->query($pas);
                $rowpas = mysqli_fetch_row($rpas);
                $mailpass=$rowpas[4];
                $name = "MIPproject";
                $email="info@mipproject.com";
                $headers .= "From: ". $name ." <". $email .">\r\n"; 
                $cuerpo .= "Hola " . $to . "\r\n"; 
                $cuerpo .= "Se le ha asignado una tarea en MIPproject, por favor ingresa para verificarla \r\n"; 
                $cuerpo .= "http://www.mipproject.com/dashboard/ \n\n";
                $cuerpo .= "Soporte Mipproject \n\n";
                @mail($mailpass, "El usuario ".$nickusu." ha creado un nuevo comentario", $cuerpo, $headers);

            break;

            case "editar_coment":

                $query= "UPDATE tareas SET n_tarea = '$n_tarea', pasign =$insertar, p_creatarea ='$p_creatarea', f_entrega ='$f_entrega', d_tarea ='$d_tarea', prioridad ='$var_prioridad', status = 'En Curso', switch = 'on' WHERE id_tarea=$id_tarea";
                $resultado = mysqli_query($conn, $query);
                verificar_resultado( $resultado, $query);
                cerrar( $conn );      

            break;
        
            case "eliminar_coment":
            
                $query2 = "DELETE FROM comentareas WHERE id_cotar = $id_cotar";
                $resultado = mysqli_query($conn, $query1);
                verificar_resultado( $resultado, $query1 );
                cerrar( $conn );

            break;
            // COMENTARIOS

            // LOGIN MIP
            case 'log_in':
                $variable = "SELECT * FROM  usuarios WHERE user= '".$user."' AND clave = '".$clave."'";
                $result = $conn->query($variable);
                $row = mysqli_fetch_row($result);
                $dbemail=$row[2];
                $dbclave=$row[3];
                if($user == $dbemail && $clave == $dbclave){
                    $_SESSION["nombre"]= $row[1];
                    $_SESSION["foto"]= $row[7];
                    $_SESSION["email"]= $row[4];
                    $_SESSION["nick"]= $user;
                    $_SESSION["id_usr"] = $row[0];
                    echo '<script type="text/javascript"> 
                            window.location="index.php?id='. $user. '"; 
                          </script>';
                }else{

                }
            break;
            // LOGIN MIP
        }


	    //Verificacion de la consulta
        function verificar_resultado($resultado, $sqlquery){
            if (!$resultado){
                $informacion["respuesta"] = "Error: " . $sqlquery . "" . $conn->error;
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