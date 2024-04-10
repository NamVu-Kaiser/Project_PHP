<?php

require_once('models/products.php');

class ProductController
{
    // Phương thức lấy danh sách tất cả các sản phẩm
    public static function getAllProductsController()
    {
        return Product::readAll();
    }

    // Phương thức tạo mới sản phẩm
    public static function createController($name, $category_id, $quantity, $price, $description, $storage, $color, $image)
    {
        $product = new Product($name, $category_id, $quantity, $price, $description, $storage, $color, $image);
        return $product->create();
    }

    // Phương thức đọc thông tin sản phẩm
    public static function readController($id)
    {
        return Product::read($id);
    }

    // Phương thức cập nhật thông tin sản phẩm
    public static function updateController($id, $name, $category_id, $quantity, $price, $description, $storage, $color, $image)
    {
        $product = new Product($name, $category_id, $quantity, $price, $description, $storage, $color, $image);
        return $product->update($id);
    }

    // Phương thức xóa sản phẩm
    public static function deleteController($id)
    {
        return Product::delete($id);
    }
}

?>