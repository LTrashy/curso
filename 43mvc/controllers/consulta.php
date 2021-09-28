<?php

    class Consulta extends Controller{
        function __construct(){
            parent::__construct();
            $this->view->alumnos = [];
            //echo "<p> Nuevo controller main</p>";
            
            
        }
        
        function render(){
            $alumnos = $this->model->get();
            $this->view->alumnos = $alumnos;
            $this->view->render('consulta/index');

        }

        
    }