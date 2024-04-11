<?php

require_once('models/users.php');

class UserController {
    public function SignInController($email, $password) {
        // Tạo một đối tượng User
        $user = new User($email, $password, null, null, null, null, null, null);
        
        // Gọi phương thức đăng nhập từ đối tượng User
        $result = $user->sign_in($email, $password);

        // Kiểm tra kết quả đăng nhập
        if ($result) {
            // Đăng nhập thành công, lấy họ tên của người dùng
            $fullname = $user->getFullNameByEmail($email);
            if ($fullname) {
                // Nếu có họ tên, trả về họ tên
                $_SESSION['email'] = $email;
                $_SESSION['fullname'] = $fullname; // Thay đổi ở đây
                header('Location: index.php');
            } else {
                // Nếu không có họ tên, trả về null hoặc một giá trị mặc định khác
                return null;
            }
        } else {
            // Đăng nhập thất bại
            return false;
        }
    }
    public function SignUpController($email, $password, $fullname, $phone_number, $address, $avatar, $gender, $role) {
        // Tạo một đối tượng User
        $user = new User($email, $password, $fullname, $phone_number, $address, $avatar, $gender, $role);
        
        // Kiểm tra xem email đã được đăng ký hay chưa
        if ($user->isEmailRegistered($email)) {
            // Email đã tồn tại, không thể đăng ký
            return false;
        }
        
        // Thực hiện đăng ký người dùng
        $result = $user->sign_up($email, $password, $fullname, $phone_number, $address, $avatar, $gender, $role);

        // Kiểm tra kết quả đăng ký
        if ($result) {
            // Đăng ký thành công
            return true;
        } else {
            // Đăng ký thất bại
            return false;
        }
    }
    public function SignOutController() {
        // Tạo một đối tượng User
        $user = new User(null, null, null, null, null, null, null, null);
        
        // Gọi phương thức đăng xuất từ đối tượng User
        $user->sign_out();

        // Chuyển hướng người dùng đến trang chính sau khi đăng xuất
        header('Location: index.php');
    }

}

?>
