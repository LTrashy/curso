<?php

include_once 'models/usermodel.php';
class Signup extends SessionController
{
    function __construct()
    {
        error_log('Signup::construct -> inicio Signup');
        parent::__construct();
    }
    
    function render()
    {
        error_log('Signup::render -> render Signup');
        $this->view->render('login/signup', []);
    }

    function newUser()
    {
        if($this->existPOST(['username', 'password'])){
            
            $username = $this->getPost('username');
            $password = $this->getPost('password');
            if(empty($username) || empty($password)){
                $this->redirect('signup', ['errors' => Errors::ERROR_SIGNUP_NEWUSER_EMPTY]);
            }
            
            $user = new UserModel();
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setRole('user');
            
            if($user->exists($username)){
                $this->redirect('signup', ['errors' => Errors::ERROR_SIGNUP_NEWUSER_EXISTS]);
            }else if($user->save()){
                $this->redirect('', ['success' => Success::SUCCESS_SIGNUP_NEWUSER]);
            }else{
                $this->redirect('signup', ['errors' => Errors::ERROR_SIGNUP_NEWUSER]);
            }


        }else{
            $this->redirect('signup', ['errors' => Errors::ERROR_SIGNUP_NEWUSER]);
        }
    }
}