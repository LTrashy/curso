<?php

    class Main extends Controller{
        function __construct(){
            parent::__construct();
            //echo "<p> Nuevo controller main</p>";
            
            
        }
        function render(){
            $this->view->render('main/index');

        }

        function saludo(){
            echo "<p> hola cara de bola</p>";
        }
    }