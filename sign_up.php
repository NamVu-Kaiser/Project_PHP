<?php
// Kiểm tra xem form đã được submit hay chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhúng file chứa lớp UserController và lớp User
    require_once('controllers/UserController.php');
    require_once('models/users.php');

    // Lấy dữ liệu từ form
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $fullname = $_POST['fullname'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $role = 'User';
    $avatar = 'images/avatar.png';

    // Kiểm tra nếu các trường bắt buộc không được để trống
    if (!empty($email) && !empty($password) && !empty($fullname) && !empty($phone_number) && !empty($address) && !empty($gender)) {
        // Khởi tạo đối tượng UserController
        $userController = new UserController();

        // Gọi phương thức SignUpController để xử lý đăng ký
        $sign_up_result = $userController->SignUpController($email, $password, $fullname, $phone_number, $address, $avatar, $gender, $role);

        if ($sign_up_result) {
            // Đăng ký thành công, có thể thực hiện các hành động tiếp theo như chuyển hướng người dùng đến trang khác
            echo "Đăng ký thành công!";
            header("Location: sign_in.php");
            exit(); 
        } else {
            // Đăng ký thất bại
            echo "Đăng ký không thành công!";
        }
    } else {
        // Hiển thị thông báo lỗi nếu có trường bắt buộc không được nhập
        echo "Vui lòng điền đầy đủ thông tin!";
    }
}
?>
<?php
    require_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Đăng Ký Tài Khoản</title>

    <!-- Icons font CSS-->
    <link href="css/sign_up/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="css/sign_up/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="css/sign_up/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="css/sign_up/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/sign_up/css/main.css" rel="stylesheet" media="all">
</head>
<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Đăng Ký Tài Khoản</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                    <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="email" placeholder="Nhập email">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Họ và Tên</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="fullname" placeholder="Nhập họ và tên">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Mật khẩu</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="password" name="pass" placeholder="Nhập mật khẩu">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Số điện thoại</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" name="phone_number" placeholder="Nhập số điện thoại">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Địa chỉ</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="address" placeholder="Nhập địa chỉ">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Giới tính</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="gender">
                                            <option disabled="disabled" selected="selected">Vui lòng chọn giới tính</option>
                                            <option>Nam</option>
                                            <option>Nữ</option>
                                            <option>Khác</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit">Đăng Ký</button>
                        </div>
                        <div style="margin-top: 40px; float:right; font-size:16px;">
                            Bạn đã có tài khoản?
                            <a style="text-decoration: none; color:blue; " href="sign_in.php">
                                Đăng Nhập
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="css/sign_up/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="css/sign_up/vendor/select2/select2.min.js"></script>
    <script src="css/sign_up/vendor/datepicker/moment.min.js"></script>
    <script src="css/sign_up/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="css/sign_up/js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->