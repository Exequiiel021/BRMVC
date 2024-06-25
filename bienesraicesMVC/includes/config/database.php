<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'Exe230994', 'bienesraices_crud_24');

    if (!$db) {
        echo "Eror no se pudo conectar";
        exit;
    } 

    return $db;
    
}