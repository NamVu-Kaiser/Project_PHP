<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "Mac_Maven";

    private $conn;

    // Phương thức khởi tạo
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Kiểm tra kết nối
        if ($this->conn->connect_error) {
            die("Lỗi kết nối: " . $this->conn->connect_error);
        }
    }

    
    // Phương thức để lấy kết nối cơ sở dữ liệu
    public function getConnection() {
        return $this->conn;
    }

    // Phương thức để thực hiện truy vấn
    public function executeQuery($sql) {
        $result = $this->conn->query($sql);
        return $result;
    }

    // Phương thức để ngắt kết nối
    public function closeConnection() {
        $this->conn->close();
    }
}
?>