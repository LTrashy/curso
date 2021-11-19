<?php

class ExpensesModel extends Model implements IModel{
    private $id;
    private $title;
    private $amount;
    private $categoryid;
    private $date;
    private $userid;

    public function __construct()
    {
        parent::__construct();
    }

    public function save()
    {
        try{
            $query = $this->prepare('INSERT INTO expenses (title, amount, category_id, date, id_user) VALUES (:title,   :amount, :category_id, :date, :id_user)');

            $query->execute([
                'title' => $this->title,
                'amount' => $this->amount,
                'category_id' => $this->categoryid,
                'date' => $this->date,
                'id_user' => $this->userid
            ]);

            if($query->rowCount()) return true;
            return false;
        }catch(PDOException $e){

            return false;
        }
    }

    public function getAll()
    {
        $items = [];
        try{
            $query = $this->query('SELECT * FROM expenses');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ExpensesModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;
            
        }catch(PDOException $e){

            return false;
        }
    }
    public function get($id)
    {
        try{
            $query = $this->prepare('SELECT * FROM expenses WHERE id = :id');

            $query->execute([
                'id' => $id
            ]);

            $expense = $query->fetch(PDO::FETCH_ASSOC);
            $this->from($expense);

            return $this;

        }catch(PDOException $e){

            return false;
        }
    }
    public function delete($id)
    {
        try{
            
            $query = $this->prepare('DELETE FROM expenses WHERE id = :id');

            $query->execute([
                'id' => $id
            ]);

            return true;

        }catch(PDOException $e){

            return false;
        }
    }
    public function update()
    {
        try{
            $query = $this->prepare('UPDATE expenses SET title = :title, amount = :amount, category_id = :category, date = :date, id_user = :id_user WHERE id = :id');

            $query->execute([
                'title' => $this->title,
                'amount' => $this->amoint,
                'category' => $this->categoryid,
                'date' => $this->date,
                'id_user' => $this->userid,
                'id' => $this->id
            ]);

            if($query->rowCount()) return true;
            return false;
        }catch(PDOException $e){

            return false;
        }

    }
    public function from($array)
    {
        $this->id = $array['id'];
        $this->title = $array['title'];
        $this->amount = $array['amount'];
        $this->categoryid = $array['category_id'];
        $this->date = $array['date'];
        $this->userid = $array['id_user'];
    }

    public function getAllByUserId($userid)
    {
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM expenses WHERE id_user = :id_user');

            $query->execute([
                'id_user' => $userid
            ]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ExpensesModel();
                $item->from($p);

                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            return [];
        }
    }

    public function getByUserIdAndLimit($userid, $n)
    {
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM expenses WHERE id_user = :id_user ORDER BY expenses.date DESC LIMIT 0,:n');

            $query->execute([
                'id_user' => $userid,
                'n' => $n,
            ]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ExpensesModel();
                $item->from($p);

                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            return [];
        }
    }

    public function getTotalAmountThisMonth($userid)
    {
        try{
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT SUM(amount) AS total FROM expenses WHERE YEAR(date) = :year AND MONTH(date) = :month AND id_user = :id_user');

            $query->execute([
                'id_user' => $userid,
                'year' => $year,
                'month' => $month,
            ]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];

            if($total == null) $total = 0;

            return $total;

        }catch(PDOException $e){
            return null;
        }
    }
    
    public function getMaxExpensesThisMonth($userid)
    {
        try{
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT MAX(amount) AS total FROM expenses WHERE YEAR(date) = :year AND MONTH(date) = :month AND id_user = :id_user');

            $query->execute([
                'id_user' => $userid,
                'year' => $year,
                'month' => $month,
            ]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];

            if($total == null) $total = 0;

            return $total;

        }catch(PDOException $e){
            return null;
        }
    }

    public function getTotalByCategoryThisMonth($categoryid, $userid)
    {
        try{
            $total = 0;
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT SUM(amount) AS total FROM expenses WHERE category_id = :category_id AND YEAR(date) = :year AND MONTH(date) = :month AND id_user = :id_user');

            $query->execute([
                'id_user' => $userid,
                'year' => $year,
                'month' => $month,
                'category_id' =>$categoryid,
            ]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];

            if($total == null) $total = 0;

            return $total;

        }catch(PDOException $e){
            return null;
        }
    }

    function getTotalByMonthAndCategory($date, $categoryId, $idUser)
    {
        try{
            $total = 0;
            $year = substr($date, 0, 4);
            $month = substr($date, 5, 7);

            $query = $this->prepare('SELECT SUM(amount) AS total FROM expenses WHERE category_id = :categoryId AND id_user = :user AND YEAR(date) = :year AND MONTH(date) = :month');

            $query->execute([
                'categoryId' => $categoryId,
                'user' => $idUser,
                'year' => $year,
                'month' => $month,
            ]);

            if($query->rowCount() > 0){
                $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            }else{
                return 0;
            }

            return $total;
        }catch(PDOException $e){
            return null;
        }
    }

    public function getNumberOfExpensesByCategoryThisMonth($categoryid, $userid)
    {
        try{
            $total = 0;
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT COUNT(amount) AS total FROM expenses WHERE category_id = :category_id AND YEAR(date) = :year AND MONTH(date) = :month AND id_user = :id_user');

            $query->execute([
                'id_user' => $userid,
                'year' => $year,
                'month' => $month,
                'category_id' =>$categoryid,
            ]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];

            if($total == null) $total = 0;

            return $total;

        }catch(PDOException $e){
            return null;
        }
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function gettitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function settitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of amount
     */ 
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */ 
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of categoryid
     */ 
    public function getCategoryid()
    {
        return $this->categoryid;
    }

    /**
     * Set the value of categoryid
     *
     * @return  self
     */ 
    public function setCategoryid($categoryid)
    {
        $this->categoryid = $categoryid;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of userid
     */ 
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set the value of userid
     *
     * @return  self
     */ 
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }
}