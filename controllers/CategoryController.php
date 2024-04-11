<?php

require_once('models/categories.php');

class CategoryController
{
    public static function readAll()
    {
        return Category::readAll();
    }
}

?>
