<?php

require_once('databases.php');

class Product
{
    private $id;
    private $name;
    private $category_id;
    private $quantity;
    private $price;
    private $description;
    private $storage;
    private $color;
    private $image;

    public function __construct($name, $category_id, $quantity, $price, $description, $storage, $color, $image)
    {
        $this->name = $name;
        $this->category_id = $category_id;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->description = $description;
        $this->storage = $storage;
        $this->color = $color;
        $this->image = $image;
    }

    // Phương thức đọc danh sách toàn bộ sản phẩm
    public static function readAll() {
        $database = new Database();
        $connection = $database->getConnection();
        $query = "SELECT * FROM product";
        $result = $connection->query($query);

        $products = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        $connection->close();
        return $products;
    }

    // Phương thức tạo mới sản phẩm
    public function create()
    {
        $database = new Database();
        $connection = $database->getConnection();

        $query = "INSERT INTO Product (name, id_category, quantity, price, description, storage, color, image_product) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("siidsiss", $this->name, $this->category_id, $this->quantity, $this->price, $this->description, $this->storage, $this->color, $this->image);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Phương thức đọc thông tin sản phẩm
    public static function read($id)
    {
        $database = new Database();
        $connection = $database->getConnection();

        $query = "SELECT * FROM Product WHERE id_product = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    // Phương thức đọc các sản phẩm thuộc một danh mục cụ thể
    public static function readByCategory($id_category) {
        $database = new Database();
        $connection = $database->getConnection();

        $query = "SELECT * FROM Product WHERE id_category = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $id_category);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        $connection->close();
        return $products;
    }


    // Phương thức cập nhật thông tin sản phẩm
    public function update($id)
    {
        $database = new Database();
        $connection = $database->getConnection();

        $query = "UPDATE Product 
                  SET name = ?, id_category = ?, quantity = ?, price = ?, description = ?, storage = ?, color = ?, image_product = ?
                  WHERE id_product = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("siidsissi", $this->name, $this->category_id, $this->quantity, $this->price, $this->description, $this->storage, $this->color, $this->image, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Phương thức xóa sản phẩm
    public static function delete($id)
    {
        $database = new Database();
        $connection = $database->getConnection();

        $query = "DELETE FROM Product WHERE id_product = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>