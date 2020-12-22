<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jugadores   |    Web</title>
    <?php
        session_start();
        $GLOBALS['ayuda'] = "";
       
    ?>

    <link rel="stylesheet" href="vistas/css/bootstrap.min.css">

    <script src="vistas/js/jquery.min.js"></script>
    <script src="vistas/js/bootstrap.bundle.js"></script>
    <script src="vistas/js/jugador.js"></script>
</head>
<body>
    <div class="container-fluid">
        
        <div class="container m-5">
            
            <div class="row">
                
                <div class="col-md-6">

                    <h2>Añadir Jugador</h2>

                    <form method="post">

                        <div class="form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                Nombre
                                </span>
                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre Completo" onlyread>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Email
                                </span>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Correo Electronico" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                Posicion
                                </span>
                                <input type="text" name="posicion" class="form-control" id="posicion" placeholder="Posicion" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Equipo
                                </span>
                                <input type="text" name="equipo" class="form-control" id="equipo" placeholder="Equipo" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Telefono
                                </span>
                                <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Telefono" required>
                            </div>
                        </div>

                        <?php
                            $registro = ControladorJugador::ctrIngresarUsuario();
                        
                        ?>
                        <input type="submit" class="btn btn-outline-success btn-lg" value="REGISTRAR">
                    </form>

                </div>
                <div class="col-md-6 consulta">
                
                    <h2>Consultar</h2>
                    <form method="post">

                        <div class="form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Email
                                </span>
                                <input type="text" name="consultaEmail" class="form-control" id="consultaEmail" placeholder="Correo Electronico">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-outline-success btn-lg mb-5" value="Consultar">
                        <?php

                            $consulta = ControladorJugador::ctrConsultarUsuario();
                            

                            if(!$consulta) echo '<li class="list-group-item list-group-item-danger">Email no esta registrado</li>';
                            else{
                                
                                
                                $GLOBALS['nombre']=$consulta['nombre'];
                                $GLOBALS['email']=$consulta['email'];
                                $GLOBALS['posicion']=$consulta['posicion'];
                                $GLOBALS['equipo']=$consulta['equipo'];
                                $GLOBALS['telefono']=$consulta['telefono'];
                                $GLOBALS['emailold']=$consulta['email'];
                                
                                echo 
                                '
                                </form>
                                
                                <form method="post">
                                
                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            Nombre
                                            </span>
                                            <input type="text"  class="form-control"  value="'.$consulta['nombre'].'" id="consultaNombre" placeholder="Nombre Completo"  readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Email
                                            </span>
                                            <input type="text" class="form-control"  value="'.$consulta['email'].'" placeholder="Correo Electronico" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            Posicion
                                            </span>
                                            <input type="text" class="form-control   value="'.$consulta['posicion'].'" placeholder="Posicion" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Equipo
                                            </span>
                                            <input type="text"  class="form-control"  value="'.$consulta['equipo'].'" placeholder="Equipo" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Telefono
                                            </span>
                                            <input type="text" name="editTelefono" class="form-control" id="editTelefono" value="'.$consulta['telefono'].'" placeholder="Telefono" readonly>
                                        </div>
                                    </div>
                                </form>';
                            }
                        ?>
                        
                    </form>

                </div>
                <div class="col-md-6">
                    <h2>Editar Usuario</h2>
                    <form method="post">    
                    <?php
                    error_reporting(0);
                       if($GLOBALS['emailold'] == true ) {

                            echo'
                                <input type="hidden" value="'.$GLOBALS['emailold'].'" id="emailOld" name="emailOld">
                                <div class="form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        Nombre
                                        </span>
                                        <input type="text" name="editNombre" class="form-control" id="editNombre" value="'.$GLOBALS['nombre'].'"   required> 
                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Email
                                        </span>
                                        <input type="text" name="editEmail" class="form-control" id="editEmail" value="'.$GLOBALS['email'].'"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        Posicion
                                        </span>
                                        <input type="text" name="editPosicion" class="form-control  id="editPosicion" value="'.$GLOBALS['posicion'].'"  required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Equipo
                                        </span>
                                        <input type="text" name="editEquipo" class="form-control" id="editEquipo" value="'.$GLOBALS['equipo'].'" placeholder="Equipo" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Telefono
                                        </span>
                                        <input type="text" name="editTelefono" class="form-control" id="editTelefono" value="'.$GLOBALS['telefono'].'" placeholder="Telefono" required>
                                    </div>
                                </div>
                            ';


                        }
                  
                        
                        $editar = ControladorJugador::ctrEditarUsuario();
                        if ($editar == "ok"){
                           echo '<li class="list-group-item list-group-item-success">Cambio realizado, consulte de nuevo</li>'; 
                        }
                       
                        ?>                                
                            
                        <input type="submit" class="btn btn-outline-success btn-lg" value="Editar">
                    </form>

                </div>

                <div class="col-sm-6">
                
                <h2>Borrar Usuario por email</h2>
                    <form method="post">

                        <div class="form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Email
                                </span>
                                <input type="text" name="borrarEmail" class="form-control" id="consultaEmail" placeholder="Correo Electronico">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-outline-success btn-lg mb-5" value="Borrar">
                        <?php
                            $borrar = new ControladorJugador();
                            $borrar->ctrBorrarUsuario();
                           
                        ?>
                    </form>
                </div>

            </div>

        </div>

    </div>
   
</body>
</html>