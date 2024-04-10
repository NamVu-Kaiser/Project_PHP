<?php
require_once('controllers/UserController.php');

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION['user_fullname'])) {
    // Nếu đã đăng nhập, hiển thị họ tên của họ
    $userFullname = $_SESSION['user_fullname'];
} else {
    // Nếu chưa đăng nhập, hiển thị một liên kết đến trang đăng nhập
    $userFullname = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="navbar-category"><a href="#">iPhone</a></div>
            <div class="navbar-category"><a href="#">iPad</a></div>
            <div class="navbar-category"><a href="#">Mac</a></div>
            <div class="navbar-category"><a href="#">Watch</a></div>
            <div class="navbar-category"><a href="#">Tai nghe và Loa</a></div>
            <div class="navbar-category"><a href="#">Phụ kiện</a></div>
            <div class="navbar-sign_in">
                <?php if($userFullname): ?>
                    <div class="dropdown">
                        <a href="#" class="dropbtn"><?php echo $userFullname; ?></a>
                        <div class="dropdown-content">
                            <a href="#">Hồ sơ cá nhân</a>
                            <a href="#">Lịch sửa mua hàng</a>
                            <a href="#">Đăng xuất</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="sign_in.php">Đăng Nhập</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
</body>
</html>
