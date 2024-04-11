<?php

require_once('models/databases.php');

class Category
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function readAll()
    {
        $database = new Database();
        $connection = $database->getConnection();
        $query = "SELECT * FROM category";
        $result = $connection->query($query);
    
        $categories = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
    
        $connection->close();
        return $categories;
    }
    

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}
?>