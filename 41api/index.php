<?php
    include_once 'apipeliculas.php';

    $api = new Apipeliculas(); 

    if(isset($_GET['id'])){
        if(is_numeric($_GET['id'])){
            $api->getById($_GET['id']);
        }else{
            $api->error("los paramentros son incorrectos");
        }
    }else{

        $api->getAll();
    }