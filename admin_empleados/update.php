<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    echo $id = $_POST["id_empleado"].'<br>';
    echo $nombre = $_POST['nombre'].'<br>';
    echo $apellido = $_POST['apellido'].'<br>';
    echo $documento = $_POST['documento'].'<br>';
    echo $telefono = $_POST['telefono'].'<br>';
    echo $correo = $_POST['correo'].'<br>';
    echo $cargo = $_POST['cargo'].'<br>';
    echo $sueldo = $_POST['sueldo'].'<br>';
    echo $horario = $_POST['horario'];
    
    $sql = "UPDATE empleado SET nombre_empleado='$nombre', apellido_empleado='$apellido', documento='$documento', telefono='$telefono', correo='$correo', id_cargo_empleado='$cargo', sueldo='$sueldo', horario_trabajo='$horario' WHERE id_empleado=$id";

    
    if($con->query($sql)===TRUE) {
        header ("Location: actualizar_empleado.php?id=". $id ."&mensaje=actualizado"); 
    }else{
        header ("Location: actualizar_empleado.php?id=". $id ."&mensaje=error"); 
    }

?>