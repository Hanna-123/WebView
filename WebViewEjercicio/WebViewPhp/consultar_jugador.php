<?php
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        require_once("conexion.php");

        
        $email = $_GET['email'];
        
        
        $consulta = "SELECT * FROM jugadores WHERE email = '$email'";   
        $result = $conexion->query($consulta);

        if($conexion ->affected_rows > 0) {
            while($row = $result->fetch_assoc()){
                $array = $row;
            }
            echo json_encode($array);
        }
        else {
            echo"Error not found rows";
        }
        $result->close();
        $conexion->close();
        
    }
    

   
   
?>