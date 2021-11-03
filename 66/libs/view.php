<?php
    class View{
        function __construct(){
            
        }

        function render($nombre, $data = []){
            $this->d = $data;

            $this->handleMessages();

            require 'views/' . $nombre . '.php';
        }

        private function handleMessages(){
            if(isset($_GET['success']) && isset($_GET['errors']) ){
                //error
            }else if(isset($_GET['success'])){
                $this->handleSuccess();
            }else if(isset($_GET['errors'])){
                $this->handleErrors();
            }
        }

        private function handleErrors(){
            $hash = $_GET['errors'];
            $error = new Errors();

            if($error->existsKey($hash)){
                $this->d['errors'] = $error->get($hash);
            }
        }

        private function handleSuccess(){
            $hash = $_GET['success'];
            $success = new Success();

            if($success->existsKey($hash)){
                $this->d['success'] = $success->get($hash);
            }
        }

        public function showMessages(){
            $this->showErrors();
            $this->showSuccess();

        }

        public function showErrors(){
            if(array_key_exists('errors', $this->d)){
                echo '<div class="error">'.$this->d['errors'].'</div>';
            }
        }
        public function showSuccess(){
            if(array_key_exists('success', $this->d)){
                echo '<div class="success">'.$this->d['success'].'</div>';
            }
        }
    }