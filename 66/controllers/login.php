<?php
    include_once 'libs/controller.php';
    class Login extends Controller{
        function __construct(){
            parent::__construct();
            error_log('Login::construct -> inicio Login');
        }
    }