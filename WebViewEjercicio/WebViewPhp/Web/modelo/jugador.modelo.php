<?php

require_once "conexion.php";

class ModeloJugador{

   static public function mdlIngresarUsuario($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, email, posicion, equipo, telefono) 
    VALUES (:nombre, :email, :posicion, :equipo, :telefono)");

    $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
    $stmt->bindParam(":posicion", $datos["posicion"], PDO::PARAM_STR);
    $stmt->bindParam(":equipo", $datos["equipo"], PDO::PARAM_STR);
    $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);


    if($stmt->execute()){

        return "ok";

    }else{

        return "error";
    
    }

    $stmt->close();
    $stmt = null;

   }
   /*===========================================
   CONSULTAR USUARIO
   =============================================*/
   static public function mdlConsultarUsuario($tabla, $email){

    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE email = :email");

    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    
    $stmt -> execute();

    return $stmt -> fetch();

    $stmt-> close();

    $stmt = null;

   }

   /*===========================================
   CONSULTAR USUARIO
   =============================================*/
   static public function mdlEditarUsuario($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, email = :email, posicion = :posicion, equipo = :equipo, telefono = :telefono
        WHERE email = :emailOld");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":posicion", $datos["posicion"], PDO::PARAM_STR);
        $stmt->bindParam(":equipo", $datos["equipo"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":emailOld", $datos["emailOld"], PDO::PARAM_STR);


        if($stmt->execute()){

            return "ok";

        }else{

            return "error";
        
        }

        $stmt->close();
        $stmt = null;

   }
   /*===========================================
   Borrar USUARIO
   =============================================*/
   static public function mdlBorrarUsuario($tabla, $email){

    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE email = :email");

    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    
    if($stmt->execute()){

        return "ok";

    }else{

        return "error";
    
    }

    $stmt->close();
    $stmt = null;
   }
}