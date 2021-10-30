<?php
    class Errores extends Controller{
        function __construct(){
            parent::__construct();
            error_log('Errores::construct -> inicio Errores');
        }
        function render(){
            error_log('Errores::render -> Render Errores');
            $this->view->render('errores/index');
        }
    }