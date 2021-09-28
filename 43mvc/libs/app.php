<?php
require_once 'controllers/fail.php';
    class App{

        function __construct(){
            //echo "<p>Nueva app</p>";

            $url = isset($_GET['url']) ? $_GET['url'] : NULL;
            $url = rtrim($url,'/');
            $url = explode('/',$url);

            //var_dump($url);
            if(empty($url[0])){
                $archivoController = 'controllers/main.php';
                require_once $archivoController;
                $controller = new Main();
                return false;
            }
            $archivoController = 'controllers/' . $url[0] . '.php';

            if(file_exists($archivoController)){
                require_once $archivoController;
                $controller = new $url[0];

                if(isset($url[1])){
                    $controller->{$url[1]}();
                }

            }else{
                $controller = new Fail();
            }

        }

    }