<?php
class User extends SessionController{

    private $user;

    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    function render()
    {
        $this->view->render('user/index', [
            'user' => $this->user,
        ]);
    }

    function updateBudget()
    {
        if(!$this->existPOST('budget')){
            $this->redirect('user', ['errors' => Errors::ERROR_USER_UPDATEBUDGET]); //error
            return;
        }

        $budget = $this->getPost('budget');

        if(empty($budget) || $budget == 0 || $budget < 0){
            $this->redirect('user', ['errors' => Errors::ERROR_USER_UPDATEBUDGET_EMPTY]); //error
            return;
        }

        $this->user->setBudget($budget);
        if($this->user->update()){
            $this->redirect('user', ['success' => Success::SUCCESS_USER_UPDATEBUDGET]); //success
        }


    }

    function updateName()
    {
        if(!$this->existPOST('name')){
            $this->redirect('user', ['errors' => Errors::ERROR_USER_UPDATENAME]); //error
            return;
        }

        $name = $this->getPost('name');

        if(empty($name) || $name == null ){
            $this->redirect('user', ['errors' => Errors::ERROR_USER_UPDATENAME_EMPTY]); //error
            return;
        }

        $this->user->setName($name);
        if($this->user->update()){
            $this->redirect('user', ['success' => Success::SUCCESS_USER_UPDATENAME]); //success
        }
    }

    function updatePassword()
    {
        if(!$this->existPOST(['current_password', 'new_password'])){
            $this->redirect('user', ['errors' => Errors::ERROR_USER_UPDATEPASSWORD]); //error
            return;
        }

        $current = $this->getPost('current_password');
        $new = $this->getPost('new_password');

        if(empty($current) || empty($new)){
            $this->redirect('user', ['errors' => Errors::ERROR_USER_UPDATEPASSWORD_EMPTY]); //error
            return;
        }

        if($current === $new){
            $this->redirect('user', ['errors' => Errors::ERROR_USER_UPDATEPASSWORD_ISNOTTHESAME]); //error
            return;
        }

        $newHash = $this->model->comparePasswords($current, $this->user->getId());
        if($newHash){
            $this->user->setPassword($new);

            if($this->user->update()){
                $this->redirect('user', ['success' => Success::SUCCESS_USER_UPDATEPASSWORD]); //success
                return;
            }else{
                $this->redirect('user', ['errors' => Errors::ERROR_USER_UPDATEPASSWORD]); //error
                return;
            }
        }else{
            $this->redirect('user', ['errors' => Errors::ERROR_USER_UPDATEPASSWORD]); //error
            return;
        }
    }

    function updatePhoto()
    {
        if(!isset($_FILES['photo'])){
            $this->redirect('user', ['errors' => Errors::ERROR_USER_UPDATEPHOTO]); //error
            return;
        }

        $photo = $_FILES['photo'];

        $targetDir = 'public/img/photos/';
        $extension = explode('.', $photo['name']);
        $fielName = $extension[sizeof($extension) -2];
        $ext = $extension[sizeof($extension) -1];
        $hash = md5(Date('Ymdgi') . $fielName) . '.' . $ext;
        $targetFile = $targetDir . $hash;
        $uploadOk = false;
        $imageFIleType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($photo['tmp_name']);

        if($check != false){
            $uploadOk = true;
        }else{
            $uploadOk = false;
        }

        if(!$uploadOk){
            $this->redirect('user', ['errors' => Errors::ERROR_USER_UPDATEPHOTO_FORMAT]); //error
            return;
        }else{
            if(move_uploaded_file($photo['tmp_name'], $targetFile)){
                // var_dump($targetFile);
                // die();
                $this->user->setPhoto($hash);
                if($this->user->update()){
                    //$this->model->updatePhoto($hash, $this->user->getId());
                    $this->redirect('user', ['success' => Success::SUCCESS_USER_UPDATEPHOTO]); //success
                    return;
                }else{
                    $this->redirect('user', ['errors' => Errors::ERROR_USER_UPDATEPHOTO]); //error
                    return;
                }
            }else{
                $this->redirect('user', ['errors' => Errors::ERROR_USER_UPDATEPHOTO]); //error
                return;
            }
        }

    }
}