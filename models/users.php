<?php

require_once('databases.php');

class User
{
    private $email;
    private $pass;
    private $fullname;
    private $phone_number;
    private $address;
    private $avatar;
    private $gender;
    private $role;

    // Constructor
    public function __construct($email, $pass, $fullname, $phone_number, $address, $avatar, $gender, $role)
    {
        $this->email = $email;
        $this->pass = $pass;
        $this->fullname = $fullname;
        $this->phone_number = $phone_number;
        $this->address = $address;
        $this->avatar = $avatar;
        $this->gender = $gender;
        $this->role = $role;
    }

    // Getter và Setter
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->pass;
    }

    public function setPassword($pass)
    {
        $this->pass = $pass;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function sign_in($email, $pass)
    {
        // Kết nối cơ sở dữ liệu
        $database = new Database();
        $connection = $database->getConnection();

        // Chuẩn bị truy vấn SQL
        $query = "SELECT * FROM User WHERE email = ? AND password = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ss", $email, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        // Kiểm tra số hàng trả về từ truy vấn
        if ($result->num_rows == 1) {
            // Đăng nhập thành công
            session_start();
            return true;
        } else {
            // Đăng nhập thất bại
            return false;
        }
    }

    public function getFullNameByEmail($email)
    {
        // Kết nối cơ sở dữ liệu
        $database = new Database();
        $connection = $database->getConnection();

        // Chuẩn bị truy vấn SQL
        $query = "SELECT fullname FROM User WHERE email = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Kiểm tra số hàng trả về từ truy vấn
        if ($result->num_rows == 1) {
            // Lấy dòng dữ liệu đầu tiên
            $row = $result->fetch_assoc();
            return $row['fullname'];
        } else {
            // Không tìm thấy người dùng có email tương ứng
            return null;
        }
    }

    public function sign_up($email, $pass, $fullname, $phone_number, $address, $avatar, $gender, $role)
    {
        // Kết nối cơ sở dữ liệu
        $database = new Database();
        $connection = $database->getConnection();

        // Chuẩn bị truy vấn SQL
        $query = "INSERT INTO User (email, password, fullname, phone_number, address, avatar, gender, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ssssssss", $email, $pass, $fullname, $phone_number, $address, $avatar, $gender, $role);

        // Thực thi truy vấn và kiểm tra kết quả
        if ($stmt->execute()) {
            // Đăng ký thành công
            return true;
        } else {
            // Đăng ký thất bại
            return false;
        }
    }
    public function isEmailRegistered($email)
    {
        // Kết nối cơ sở dữ liệu
        $database = new Database();
        $connection = $database->getConnection();

        // Chuẩn bị truy vấn SQL
        $query = "SELECT COUNT(*) as count FROM User WHERE email = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Lấy số lượng hàng trả về từ truy vấn
        $row = $result->fetch_assoc();
        $count = $row['count'];

        // Kiểm tra xem email đã được đăng ký hay chưa
        if ($count > 0) {
            // Email đã được đăng ký
            return true;
        } else {
            // Email chưa được đăng ký
            return false;
        }
    }
    public function sign_out(){
        session_start();
        session_unset();
        session_destroy();
    }
}
