<?php

class CategorysModel extends Model implements IMOdel
{
    
    private $id ;
    private $name;
    private $color;

    public function __construct()
    {
        parent::__construct();
    }

    public function save()
    {
        try {
            $query = $this->prepare('INSERT INTO categories (name, color) VALUES (:name, :color)');
            $query->execute([
                'name' => $this->name,
                'color' => $this->color,
            ]);

            if($query->rowCount()){
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function getAll()
    {
        $items = [];
        try {
            $query = $this->query('SELECT * FROM categories');
            
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new CategorysModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;

        } catch (PDOException $e) {
            return [];
        }
    }
        
    public function get($id)
    {
        try {
            $query = $this->prepare('SELECT * FROM categories WHERE id = :id');
            $query->execute(['id' => $id]);
            $category = $query->fetch(PDO::FETCH_ASSOC);

            $this->from($category);
            return $this;

        } catch (PDOException $e) {
            return null;
        }
    }
        
    public function delete($id)
    {
        try {
            $query = $this->prepare('DELETE FROM categories WHERE id = :id');
            $query->execute(['id' => $id]);

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }
        
    public function update()
    {
        try {
            $query = $this->prepare('UPDATE categories SET name = :name, color = :color WHERE id = :id');
            $query->execute([
                'name' => $this->name,
                'color' => $this->color,
                'id' => $this->id,
            ]);
            $category = $query->fetch(PDO::FETCH_ASSOC);

            return true;

        } catch (PDOException $e) {
            return null;
        }
    }
        
    public function from($array)
    {
        $this->id = $array['id'];
        $this->name = $array['name'];
        $this->color = $array['color'];
    }

    public function exists($name)
    {
        try {
            $query = $this->prepare('SELECT name FROM categories WHERE name = :name');
            $query->execute([
                'name' => $this->name,
            ]);

            if($query->rowCount()){
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
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
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

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