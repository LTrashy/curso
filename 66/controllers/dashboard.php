<?php
include_once 'libs/controller.php';
class DashBoard extends SessionController{
    
    function __construct()
    {
        parent::__construct();
        error_log('DashBoard::construct -> inicio DashBoard');
    }

    function render()
    {
        error_log('DashBoard::render -> carga render de DAshboard');
        $this->view->render('dashboard/index');
    }

    function getExpenses()
    {

    }

    public function getCategories()
    {
        
    }

    


}
