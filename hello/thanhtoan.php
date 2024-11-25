<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Thông tin thanh toán</h2>

        <!-- Hiển thị thông tin sản phẩm -->
        <div class="mb-3">
            <img src="images/<?php echo htmlspecialchars($product['product_image']); ?>" alt="Product Image" class="img-fluid" style="max-width: 200px;">
        </div>

        <!-- Form thanh toán -->
        <form method="POST" action="">
            <div class="mb-3">
                <label for="fullName" class="form-label">Họ và Tên</label>
                <input type="text" class="form-control" id="fullName" name="fullName" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Số điện thoại</label>
                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Số lượng</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1" required>
            </div>

            <button type="submit" class="btn btn-primary">Hoàn tất thanh toán</button>
            <a href="homepage.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();

// Kiểm tra đăng nhập
if (!isset($_SESSION['username'])) {
    header("Location: loginweb.php");
    exit();
}

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "se06303_web";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy ID sản phẩm từ URL
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $sql = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);
}

// Xử lý form thanh toán
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $quantity = intval($_POST['quantity']);
    $totalPrice = $quantity * $product['product_price'];

    $sql_order = "INSERT INTO orders (customer_name, customer_address, customer_phone, product_id, quantity, total_price, order_date)
                  VALUES ('$fullName', '$address', '$phoneNumber', $product_id, $quantity, $totalPrice, NOW())";

    if (mysqli_query($conn, $sql_order)) {
        echo "<script>
                alert('Thanh toán thành công! Cảm ơn bạn đã mua hàng.');
                window.location.href = 'homepage.php';
              </script>";
    } else {
        echo "<script>alert('Thanh toán thất bại! Vui lòng thử lại.');</script>";
    }
}

mysqli_close($conn);
?>

