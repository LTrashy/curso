<?php
require_once 'models/expensesmodel.php';
require_once 'models/categorysmodel.php';
class Admin extends SessionController
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $stats = $this->getStatistics();

        $this->view->render('admin/index', [
            'stats' => $stats,
        ]);
    }

    function createCategory()
    {
        $this->view->render('admin/create-category');
    }

    function newCategory()
    {
        if($this->existPOST(['name', 'color'])){
            $name = $this->getPost('name');
            $color = $this->getPost('color');

            $categorysModel = new CategorysModel();
            // var_dump($categorysModel->exists($name));
            // die();
            if(!$categorysModel->exists($name)){
                $categorysModel->setName($name);
                $categorysModel->setColor($color);
                $categorysModel->save();

                $this->redirect('admin', ['success' => Success::SUCCESS_ADMIN_NEWCATEGORY]); //success
                
            }else{
                $this->redirect('admin', ['errors' => Errors::ERROR_ADMIN_NEWCATEGORY_EXISTS]); //error
            }
        }
    }

    private function getMaxAmount($expenses)
    {
        $max = 0;

        foreach($expenses as $expense){
            $max = max($max, $expense->getAmount());
        }

        return $max;
    }

    private function getMinAmount($expenses)
    {
        $min = $this->getMaxAmount($expenses);

        foreach($expenses as $expense){
            $min = min($min, $expense->getAmount());
        }

        return $min;
    } 

    private function getAverageAmount($expenses)
    {
        $suma = 0;

        foreach($expenses as $expense){
            $suma += $expense->getAmount();
        }

        return ($suma / count($expenses));
    }

    private function getCatagoryMostUsed($expenses)
    {
        $repeat = [];
        
        foreach($expenses as $expense){
            if(!array_key_exists($expense->getCategoryId(),$repeat)){
                $repeat[$expense->getCategoryId()] = 0;
            }
            $repeat[$expense->getCategoryId()]++;
        }

        //$categoryMostUsed = max($repeat);
        $categoryMostUsed = 0;
        $maxCategory = max($repeat);
        foreach($repeat as $index => $category){
            if($category == $maxCategory){
                $categoryMostUsed = $index;
            }
        }
        $categorysModel = new CategorysModel();
        $categorysModel->get($categoryMostUsed);

        $category = $categorysModel->getName();

        return $category;
    }

    private function getCatagoryLessUsed($expenses)
    {
        $repeat = [];
        
        foreach($expenses as $expense){
            if(!array_key_exists($expense->getCategoryId(),$repeat)){
                $repeat[$expense->getCategoryId()] = 0;
            }
            $repeat[$expense->getCategoryId()]++;
        }

        //$categoryMostUsed = min($repeat);
        $categoryMostUsed = 0;
        $maxCategory = min($repeat);
        foreach($repeat as $index => $category){
            if($category == $maxCategory){
                $categoryMostUsed = $index;
            }
        }
        $categorysModel = new CategorysModel();
        $categorysModel->get($categoryMostUsed);

        $category = $categorysModel->getName();

        return $category;
    }

    function getStatistics()
    {
        $res = [];

        $userModel = new UserModel();
        $users = $userModel->getAll();

        $expensesModel = new ExpensesModel();
        $expenses = $expensesModel->getAll();

        $categorysModel = new CategorysModel();
        $categorys = $categorysModel->getAll();

        // var_dump($categorys);
        // die();

        $res['count-users'] = count($users);
        $res['count-expenses'] = count($expenses);
        $res['max-expenses'] = $this->getMaxAmount($expenses);
        $res['min-expenses'] = $this->getMinAmount($expenses);
        $res['avg-expenses'] = $this->getAverageAmount($expenses);

        $res['count-categories'] = count($categorys);
        $res['mostused-categories'] = $this->getCatagoryMostUsed($expenses);
        $res['lessused-categories'] = $this->getCatagoryLessUsed($expenses);

        return $res;


    }

    
}