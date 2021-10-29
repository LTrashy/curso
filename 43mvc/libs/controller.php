<?php
    class Controller{
        function __construct(){
            //echo "<p> COntroller base</p>";

            $this->view = new Views();
        }

        function loadModel($model){
            $url = 'models/'.$model.'model.php';

            if(file_exists($url)){
                require $url;

                $modelName = $model.'Model';
                $this->model = new $modelName();
            }
        }
    }