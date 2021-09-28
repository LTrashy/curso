<?php

    class Main extends Controller{
        function __construct(){
            parent::__construct();
            $this->view->render('main/index');
            //echo "<p> Nuevo controller main</p>";

            
        }

        function saludo(){
            echo "<p> hola cara de bola</p>";
        }
    }