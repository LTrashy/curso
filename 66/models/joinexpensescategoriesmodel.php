<?php
class JoinExpensesCategoriesModel extends Model
{
    private $expenseId;
    private $title;
    private $amount;
    private $categoryId;
    private $date;
    private $userId;
    private $nameCategory;
    private $color;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll($userid)
    {   
        $items = [];
        try{
            $query = $this->prepare('SELECT expenses.id AS expense_id, title, category_id, amount, date, id_user, categories.id, name, color FROM expenses INNER JOIN categories WHERE expenses.category_id = categories.id AND expenses.id_user = :userid ORDER BY date');

            $query->execute(['userid' => $userid]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new JoinExpensesCategoriesModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return null;
        }
    }

    public function from($array){
        $this->expenseId = $array['expense_id'];
        $this->title = $array['title'];
        $this->categoryId = $array['category_id'];
        $this->amount = $array['amount'];
        $this->date = $array['date'];
        $this->userId = $array['id_user'];
        $this->nameCategory = $array['name'];
        $this->color = $array['color'];
    }

    public function toArray()
    {
        $array = [];
        $array['id'] = $this->expenseId;
        $array['title'] = $this->title;
        $array['category_id'] = $this->categoryId;
        $array['amount'] = $this->amount;
        $array['date'] = $this->date;
        $array['id_user'] = $this->userId;
        $array['name' ] = $this->nameCategory;
        $array['color'] = $this->color;

        return $array;
    }

    
    

    /**
     * Get the value of expenseId
     */ 
    public function getExpenseId()
    {
        return $this->expenseId;
    }

    /**
     * Set the value of expenseId
     *
     * @return  self
     */ 
    public function setExpenseId($expenseId)
    {
        $this->expenseId = $expenseId;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
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
     * Get the value of categoryId
     */ 
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set the value of categoryId
     *
     * @return  self
     */ 
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

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
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of nameCategory
     */ 
    public function getNameCategory()
    {
        return $this->nameCategory;
    }

    /**
     * Set the value of nameCategory
     *
     * @return  self
     */ 
    public function setNameCategory($nameCategory)
    {
        $this->nameCategory = $nameCategory;

        return $this;
    }

    /**
     * Get the value of color
     */ 
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */ 
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }
}