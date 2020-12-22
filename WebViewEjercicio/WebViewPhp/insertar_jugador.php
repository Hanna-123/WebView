<?php
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        require_once("conexion.php");

        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $posicion = $_POST['posicion'];
        $equipo = $_POST['equipo'];
        $telefono = $_POST['telefono'];
        
        $consulta = "INSERT INTO jugadores (nombre, email, posicion, equipo, telefono) values('$nombre','$email', '$posicion', '$equipo', '$telefono')";   
        $result = $conexion->query($consulta);

        if($result == TRUE) {
            echo "The usar was creater succesfully";
        }
        else {
            echo"Error";
        }

        $conexion->close();
        
    }
    

   
   
?>