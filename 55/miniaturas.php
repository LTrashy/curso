<?php
    crearMiniatura($_FILES['imagen']['name']);

    function crearMiniatura($nombreArchivo){
        $finalWidth = 100;
        $dirFullImage = 'imagenes/full/';
        $dirThumbImage = 'imagenes/thumbs/';
        $tmpName = $_FILES['imagen']['tmp_name'];
        $finalName = $dirFullImage . $_FILES['imagen']['name'];

        copiarImagen($tmpName, $finalName);

        $im = null;

        if(preg_match('/[.](jpg)$/', $nombreArchivo)){
            $im = imagecreatefromjpeg($finalName);
        }elseif(preg_match('/[.](gif)$/', $nombreArchivo)){
            $im = imagecreatefromgif($finalName);
        }elseif(preg_match('/[.](png)$/', $nombreArchivo)){
            $im = imagecreatefrompng($finalName);
        }

        $width = imagesx($im);
        $heigth = imagesy($im);

        $minWidth = $finalWidth;
        $minHeigth = floor($heigth * ($finalWidth / $width));

        $imageTrueColor = imagecreatetruecolor($minWidth,$minHeigth);

        imagecopyresized($imageTrueColor, $im, 0, 0, 0, 0, $minWidth, $minHeigth, $width, $heigth);

        if(!file_exists($dirThumbImage)){
            if(!mkdir($dirThumbImage)){
                die("ErRoR");
            }
        }

        imagejpeg($imageTrueColor, $dirThumbImage . $nombreArchivo);

    }

    function copiarImagen($origen, $destino){
        move_uploaded_file($origen, $destino);
    }