<?php

    class Fail extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->mensaje = "Solicitud fallida o No existe la pagina"; 
            $this->view->render('fail/index');
            //echo "<p> Error al cargar REcurso </p>";
        }
        
    }