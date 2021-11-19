<?php
include_once 'libs/controller.php';
include_once 'models/expensesmodel.php';
include_once 'models/categorysmodel.php';
class DashBoard extends SessionController{
    
    private $user;

    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
        error_log('DashBoard::construct -> inicio DashBoard');
    }

    function render()
    {
        error_log('DashBoard::render -> carga render de DAshboard');

        $expensesModel = new ExpensesModel();
        $expenses = $this->getExpenses(5);
        $totalThisMonth = $expensesModel->getTotalAmountThisMonth($this->user->getId()); 
        $maxExpensesThisMonth = $expensesModel->getMaxExpensesThisMonth($this->user->getId()); 
        $categories = $this->getCategories();
        $this->view->render('dashboard/index', [
            'user' => $this->user,
            'expenses' => $expenses,
            'totalAmountThisMonth' => $totalThisMonth,
            'maxExpensesThisMonth' => $maxExpensesThisMonth,
            'categories' => $categories,
        ]);
    }

    private function getExpenses($n = 0)
    {
        if($n < 0){
            return null;
        }

        $expenses = new ExpensesModel();
        return $expenses->getByUserIdAndLimit($this->user->getId(), $n);
    }

    private function getCategories()
    {
        $res = [];
        $categoriesModel = new CategorysModel();
        $expensesModel = new ExpensesModel();

        $categories = $categoriesModel->getAll();

        foreach($categories as $category){
            $categoryArray = [];

            $total = $expensesModel->getTotalByCategoryThisMonth($category->getId(), $this->user->getId());
            $numberOfExpenses = $expensesModel->getNumberOfExpensesByCategoryThisMonth($category->getId(), $this->user->getId());

            if($numberOfExpenses > 0){
                $categoryArray['total'] = $total;
                $categoryArray['count'] = $numberOfExpenses;
                $categoryArray['category'] = $category;

                array_push($res, $categoryArray);
            }
        }

        return $res;
    }

    


}
