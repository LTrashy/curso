<?php
class Logout extends SessionController{

    function __construct()
    {
        parent::__construct();

    }

    function render()
    {
        $this->logout();
        $this->redirect('',[]);
    }
}

?>