<?php

    $hostname = 'localhost';
    $database = 'webview';
    $username = 'root';
    $password = '';

    $conexion = new mysqli($hostname, $username, $password, $database);

    if($conexion->connect_errno) echo 'lo sentimos,m el sitio web esta presentando problemas';
    
?>