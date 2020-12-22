<?php

class ControladorJugador{
    public function ctrIngresarUsuario(){

        if(isset($_POST["nombre"])){
            

            $datos=array("nombre"=>$_POST["nombre"],
                        "email"=>$_POST["email"],
                        "posicion"=>$_POST["posicion"],
                        "equipo"=>$_POST["equipo"],
                        "telefono"=>$_POST["telefono"]);

            $tabla = "jugadores";
            $respuesta = ModeloJugador::mdlIngresarUsuario($tabla, $datos);
            return $respuesta;
            
        }

    }
    /*===========================================
   CONSULTAR USUARIO
   =============================================*/
    public function ctrConsultarUsuario(){

        if(isset($_POST["consultaEmail"])){
        
            $email=$_POST["consultaEmail"];
            $tabla = "jugadores";
            $respuesta = ModeloJugador::mdlConsultarUsuario($tabla, $email);
            return $respuesta;
           
            
            
        }
        

    }
    /*===========================================
   CONSULTAR USUARIO
   =============================================*/
    public function ctrEditarUsuario(){

        if(isset($_POST["editNombre"])){
            
            $datos=array("nombre"=>$_POST["editNombre"],
                        "email"=>$_POST["editEmail"],
                        "posicion"=>$_POST["editPosicion"],
                        "equipo"=>$_POST["editEquipo"],
                        "telefono"=>$_POST["editTelefono"],
                        "emailOld"=>$_POST["emailOld"]);
                        
            $tabla = "jugadores";
            $respuesta = ModeloJugador::mdlEditarUsuario($tabla, $datos);
            return $respuesta;
            
        }
    
        
    }

    public function ctrBorrarUsuario(){

        if(isset($_POST["borrarEmail"])){
        
            $email=$_POST["borrarEmail"];
            $tabla = "jugadores";
            $respuesta = ModeloJugador::mdlBorrarUsuario($tabla, $email);
            return $respuesta;
            if($respuesta == "ok") echo '<li class="list-group-item list-group-item-success">Se borro usuario con email'.$email.'</li>'; 
           
            
            
        }

    }
}

