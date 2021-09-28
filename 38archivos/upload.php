<?php
    //var_dump($_FILES["file"]);
    $directorio= "uploads/";
    $archivo = $directorio . basename($_FILES["file"]["name"]);

    $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

    $checarSi = getimagesize($_FILES["file"]["tmp_name"]);

    if($checarSi != false){
        $size = $_FILES["file"]["size"];

        if($size > 500000){
            echo "el archivo teine que ser menos a 500 k";
        }else{
            if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg"){
                
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $archivo)){
                    echo "el archivo se subio correctamente";
                }else{
                    echo "hubo un error";
                }
            }else{
                echo "solo se acepta jpg/jpeg";
            }
        }
    }else{
        echo "el doc no es una imagen ";
    }
