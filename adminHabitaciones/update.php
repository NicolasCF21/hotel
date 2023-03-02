<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id=$_POST["id_habitacion"];
    $nombre=$_POST['nombre'];
    $tipo=$_POST['categoria'];
    $descripcion=$_POST['descripcion'];
    $personas=$_POST["cantidad"];
    $estadoH=$_POST["estado"];   
    $precio=$_POST["precio"];
    $estado=0;

    if($_FILES["imagen"]["error"] == 0){ //Verificar si el archivo se envio (0) sino lo omite
        $fileName = basename($_FILES["imagen"]["name"]); 
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); 

        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){
            if($_FILES["imagen"]["size"] > 1000000){
                $estado=1;
                $error = "El peso del archivo excede el tamaño permitido";
                header ("Location: actualizar.php?id=".$id."&error=" . $error . ""); 
            } else {
                $directorio = "../imgHabitaciones/";
                $archivo = $directorio . basename($_FILES["imagen"]["name"]);
                if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $archivo)){
                    echo "<br>El archivo ".basename($_FILES["archivoSubir"]["name"]." ha sido subido exitosamente!");
                }else{
                    echo "Ha ocurrido un error.";
                }
            }      
        } else{
            $estado=1;
            $error = "Tipo de archivo no es el adecuado";
            header ("Location: actualizar.php?id=".$id."&error=" . $error . ""); 
        }
        $sql = "UPDATE HABITACION SET nombre_habitacion='$nombre', id_tipo_habitacion='$tipo', descripcion_habitacion='$descripcion', cantidad_personas='$personas',
        estado_habitacion='$estadoH', precio_habitacion='$precio', imagen_habitacion='$archivo'  WHERE id_habitacion=$id";
    }else{
        $sql = "UPDATE HABITACION SET nombre_habitacion='$nombre', id_tipo_habitacion='$tipo', descripcion_habitacion='$descripcion', cantidad_personas='$personas',
        estado_habitacion='$estadoH', precio_habitacion='$precio'  WHERE id_habitacion=$id";
    }

    if($estado === 0 && $con->query($sql) === TRUE) {
        header ("Location: actualizar.php?id=". $id . "&mensaje=correcto"); 
    }else{
        header ("Location: actualizar.php?id=" . $id . "&mensaje=error"); 
    }

?>