<?php
// Import UserController
require_once('controllers/UserController.php');

// Khởi tạo một đối tượng UserController
$userController = new UserController();

// Gọi phương thức SignOutController để thực hiện đăng xuất
$userController->SignOutController();
?>
