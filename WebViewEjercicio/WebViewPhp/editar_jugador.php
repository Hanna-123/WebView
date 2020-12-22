<?php
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        require_once("conexion.php");

        $emailOld = $_POST['emailold'];
        $emailNew = $_POST['emailnew'];
        $nombre = $_POST['nombre'];
        $posicion = $_POST['posicion'];
        $equipo = $_POST['equipo'];
        $telefono = $_POST['telefono'];
        
        
        $consulta = "UPDATE jugadores SET nombre = '$nombre', email = '$emailNew', posicion = '$posicion', equipo = '$equipo', telefono = '$telefono' WHERE email = '$emailOld'";   
        $result = $conexion->query($consulta);

        if($conexion ->affected_rows > 0) {
            if($result == TRUE){
                echo"Update succesfull!!";
            }else{
                echo "ERROR";
            }
        }
        else {
            echo"Error not found rows";
        }
        $conexion->close();
        
    }
    

   
   
?>