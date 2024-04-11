<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <style>
        /* CSS để sắp xếp sản phẩm trong các flexbox */
        .product-container {
            display: flex;
            flex-wrap: wrap;
        }
        .product-item {
            width: 20%; /* Chia mỗi hàng thành 5 cột */
            padding: 10px;
        }
        .product-item img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <?php
    require_once 'header.php';
    require_once 'models/categories.php';
    require_once 'models/products.php';

    // Truy vấn danh sách các danh mục sản phẩm
    $categories = Category::readAll(); // Giả sử bạn có một class Category để quản lý các danh mục sản phẩm

    // Hiển thị các danh mục sản phẩm và sản phẩm thuộc mỗi danh mục
    foreach ($categories as $category) {
        echo "<h2>{$category['name']}</h2>"; // Hiển thị tên danh mục

        // Truy vấn và hiển thị các sản phẩm thuộc danh mục này
        $products = Product::readByCategory($category['id_category']); // Giả sử bạn có một phương thức readByCategory để đọc sản phẩm theo danh mục

        // Bắt đầu container cho các sản phẩm
        echo '<div class="product-container">';

        foreach ($products as $product) {
            // Hiển thị mỗi sản phẩm trong một flexbox item
            echo '<div class="product-item">';
            echo "<img src=\"{$product['image_product']}\" alt=\"{$product['name']}\">";
            echo "<p>{$product['name']}</p>";
            echo "<p>{$product['price']}</p>";
            // Hiển thị các thông tin khác về sản phẩm nếu cần
            echo '</div>'; // Kết thúc flexbox item
        }

        // Kết thúc container cho các sản phẩm
        echo '</div>';
    }
    ?>
</body>
</html>
