<?php
    include_once 'libs/controller.php';
    class Login extends Controller{
        function __construct(){
            parent::__construct();
            error_log('Login::construct -> inicio Login');
        }
        function render(){
            error_log('Login::render -> carga render de login');
            $this->view->render('login/index');
        }
    }