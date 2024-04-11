<?php
session_start();
require_once('controllers/UserController.php');

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION['fullname'])) {
    // Nếu đã đăng nhập, hiển thị họ tên của họ
    $fullname = $_SESSION['fullname'];
} else {
    // Nếu chưa đăng nhập, hiển thị một liên kết đến trang đăng nhập
    $fullname = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <ul>
        <li><a href="index.php">Trang Chủ</a></li>
        <li><a href="#news">iPhone</a></li>
        <li><a href="#news">iPad</a></li>
        <li><a href="#news">Mac</a></li>
        <li><a href="#news">Watch</a></li>
        <li><a href="#news">AirPods</a></li>
        <li style="float: right;"><a href="#home">Giỏ Hàng</a></li>
        <?php if ($fullname) : ?>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn"><?php echo $fullname; ?></a>
                <div class="dropdown-content">
                    <a href="myinfo.php">Hồ Sơ Của Tôi</a>
                    <a href="#">Lịch Sử Mua Hàng</a>
                    <a href="sign_out.php">Đăng Xuất</a>
                </div>
            </li>
        <?php else : ?>
            <li style="float: right;"><a href="sign_in.php">Đăng Nhập</a></li>
        <?php endif; ?>
    </ul>
</body>

</html>