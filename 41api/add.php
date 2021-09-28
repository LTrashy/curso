<?php
    include_once 'apipeliculas.php';

    $api = new Apipeliculas();

    if(isset($_POST['nombre']) && isset($_FILES['imagen'])){
        if($api->subirImagen($_FILES['imagen'])){
            //insert data
            $item = array(
                'nombre' => $_POST['nombre'],
                'imagen' => $api->getImagen()
            );

            $api->add($item);
        }else{
            $api->error("error con el archivo : " . $api->getError());
        }
    }else{
        $api->error("error al llamar a la api");
    }