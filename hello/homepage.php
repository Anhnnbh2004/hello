<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Bán Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 10px;
        }
        .header, .menu, .footer {
            margin-bottom: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            border: 1px solid #ddd;
        }
        .logo img {
            height: 50px;
        }
        .menu {
            background: #f8f9fa;
            padding: 10px 15px;
            border: 1px solid #ddd;
        }
        .menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
        }
        .menu ul li {
            list-style: none;
        }
        .menu ul li a {
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }
        .carousel-inner img {
            height: 400px;
            object-fit: cover;
        }
        .content {
            display: flex;
            gap: 20px;
        }
        .left {
            width: 20%;
            background: #f0f0f0;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .right {
            width: 80%;
        }
        .products_box {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .single_product {
            border: 1px solid #ddd;
            padding: 15px;
            width: calc(33.33% - 20px);
            text-align: center;
        }
        .single_product img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background: #f8f9fa;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <img src="logo.jpg" alt="Logo">
            </div>
        </div>

        <!-- Menu -->
        <div class="menu">
            <ul>
                <li><a href="add_product.php">Thêm sản phẩm</a></li>
                <li><a href="cart.php">Giỏ hàng</a></li>
                <li><a href="detail.php">Detail</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="right">
                <!-- Carousel -->
                <div id="carouselExampleAutoplaying" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="picture/xe-mercedes-c-class-1.jpg" class="d-block w-100" alt="Product 1">
                        </div>
                        <div class="carousel-item">
                            <img src="picture/pngtree-new-mercedes-car-in-front-of-an-dark-room-image_2575877.jpg" class="d-block w-100" alt="Product 2">
                        </div>
                        <div class="carousel-item">
                            <img src="picture/4107.jpg_wh860.jpg" class="d-block w-100" alt="Product 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Product List -->
                <p class="text-center fs-4 fw-bold">Tất cả sản phẩm</p>
                <div class="products_box">
                    <?php
                    // Kết nối cơ sở dữ liệu
                    $connect = mysqli_connect('localhost', 'root', '', 'se06303_web');
                    if (!$connect) {
                        die('Không thể kết nối cơ sở dữ liệu');
                    }

                    // Lấy danh sách sản phẩm
                    $sql = "SELECT * FROM products";
                    $result = mysqli_query($connect, $sql);
                    if (!$result) {
                        die('Lỗi truy vấn cơ sở dữ liệu');
                    }

                    // Hiển thị sản phẩm
                    while ($row = mysqli_fetch_array($result)) {
                        $product_id = $row['id'];
                        $product_name = htmlspecialchars($row['product_name']);
                        $product_price = number_format($row['product_price'], 0, ',', '.') . " đ";
                        $product_image = file_exists("Image/" . $row['product_img']) ? "Image/" . $row['product_img'] : "Image/placeholder.jpg";
                    ?>
                        <div class="single_product">
                            <h5><?php echo $product_name; ?></h5>
                            <img src="<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>">
                            <p class="mt-2"><b>Giá: <?php echo $product_price; ?></b></p>
                            <a href="product_detail.php?id=<?php echo $product_id; ?>" class="btn btn-primary btn-sm">Chi tiết</a>
                            <a href="add_cart.php?id=<?php echo $product_id; ?>" class="btn btn-success btn-sm mt-2">Thêm vào giỏ</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <form method="get" action="search.php">
            <input type="text" name="user_query" placeholder="Search a Product" />
            <input type="submit" name="search" value="Search" />
        </form>


        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2024 - Website Bán Hàng</p>
        </div>
    </div>

    <!-- Thêm JS của Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
