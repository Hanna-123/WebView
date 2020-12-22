<?php
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        require_once("conexion.php");

        
        $email = $_POST['email'];
        
        
        $consulta = "DELETE FROM jugadores WHERE email = '$email'";   
        $result = $conexion->query($consulta);

        if($conexion ->affected_rows > 0) {
            if($result == TRUE){
                echo"Jugador eliminado!!";
            }
        }
        else {
            echo"Error not found rows";
        }
        $conexion->close();
        
    }
    

   
   
?>