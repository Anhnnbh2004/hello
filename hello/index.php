<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        .product-container {
            display: flex;
            gap: 20px;
        }
        .product-image img {
            width: 600px;
            height: 500px;
            object-fit: cover;
        }
        .product-details {
            max-width: 500px;
        }
        .product-details h2 {
            margin: 0;
            padding: 0;
        }
        .product-details p {
            margin: 10px 0;
        }
        .product-details button {
            padding: 10px 15px;
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .product-details button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<?php
// Kết nối cơ sở dữ liệu
$connect = mysqli_connect('localhost', 'root', '', 'se06303_web');
if (!$connect) {
    die('Kết nối cơ sở dữ liệu thất bại');
}

// Lấy id sản phẩm từ URL và kiểm tra giá trị đầu vào
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Truy vấn dữ liệu sản phẩm
$sql = "SELECT * FROM product WHERE product_id = $id";
$result = mysqli_query($connect, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo '<p>Sản phẩm không tồn tại.</p>';
} else {
    $row = mysqli_fetch_assoc($result);
    ?>
    <div class="product-container">
        <!-- Hình ảnh sản phẩm -->
        <div class="product-image">
            <img src="Images/<?php echo htmlspecialchars($row['product_image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
        </div>
        
        <!-- Thông tin chi tiết sản phẩm -->
        <div class="product-details">
            <h2>Tên sản phẩm: <?php echo htmlspecialchars($row['product_name']); ?></h2>
            <p style="color: red;">Giá: <?php echo number_format($row['product_price'], 0, ',', '.') . " $"; ?></p>
</br>
            <a href="single.php?add_cart=<?php echo $row['product_id']; ?>">
                <button>Thêm vào giỏ hàng</button>
            </a>
            <br><br>
            <div style="border-bottom: 1px solid black;"></div>
            <br>
            <h2>Thông tin cơ bản:</h2>
            <p><?php echo nl2br(htmlspecialchars($row['product_description'])); ?></p>
        </div>
    </div>
    <?php
}
mysqli_close($connect);
?>
</body>
</html>
