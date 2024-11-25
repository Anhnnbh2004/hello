<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Layout</title>
    <style type="text/css">
        .wrapper {
            width: 1000px;
            height: auto;
            margin: auto;
        }
        .header {
            height: 55px;
            margin: auto;
            border: 1px solid black;
            position: relative;
        }
        .logo {
            float: left;
            width: 150px;
            padding: 10px;
        }
        .cart {
            float: right;
            padding: 10px;
        }
        #form_search {
            margin-top: 10px;
        }
        #form_search input[type="text"] {
            width: 250px;
            height: 30px;
        }
        #form_search input[type="submit"] {
            height: 30px;
        }
        .menu {
            width: 100%;
            height: 30px;
            background: pink;
            border: 1px solid black;
            line-height: 30px;
        }
        .menu ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }
        .menu ul li {
            display: inline-block;
            padding: 0 10px;
        }
        .menu ul li a {
            text-decoration: none;
            font-size: 14px;
            text-transform: uppercase;
        }
        .content {
            width: 100%;
            border: 1px solid black;
            overflow: hidden;
        }
        .left {
            width: 20%;
            background: gray;
            float: left;
        }
        .right {
            width: 80%;
            float: right;
        }
        .footer {
            width: 100%;
            height: 100px;
            background: #f0f0f0;
            clear: both;
            text-align: center;
            line-height: 100px;
        }
        .products_box {
            text-align: center;
            padding: 10px;
        }
        .single_product {
            float: left;
            margin: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            width: 200px;
        }
        .single_product img {
            width: 180px;
            height: 180px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <a href="index.php">
                <div class="logo">
                    <img id="logo" src="images/btec.jpg" alt="Logo">
                </div>
            </a>
            <a href="cart.php">
                <div class="cart">
                    <img id="cart" src="images/cart.png" alt="Cart">
                </div>
            </a>
            <div id="form_search">
                <form method="get" action="search.php">
                    <input type="text" name="user_query" placeholder="Search a Product">
                    <input type="submit" name="search" value="Search">
                </form>
            </div>
        </div>
        <div class="menu">
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="Admin/view_product.html">Quản lý sản phẩm</a></li>
                <li><a href="add_product.php">Thêm sản phẩm</a></li>
                <li><a href="loginweb.php">Đăng nhập</a></li>
                <li><a href="registerweb.php">Đăng ký</a></li>
                <li><a href="logout.php">Đăng xuất</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="left">
                <p>Loại sản phẩm</p>
                <div class="category">
                    <ul>
                        <li><a href="#">Tivi</a></li>
                        <li><a href="#">Laptop</a></li>
                        <li><a href="#">Camera</a></li>
                        <li><a href="#">Desktop</a></li>
                    </ul>
                </div>
                <p>Thương hiệu</p>
                <div class="brand">
                    <ul>
                        <li><a href="#">Samsung</a></li>
                        <li><a href="#">Dell</a></li>
                        <li><a href="#">Apple</a></li>
                    </ul>
                </div>
            </div>
            <div class="right">
                <?php
                include 'connect.php';
                if (isset($_GET['search'])) {
                    $search = mysqli_real_escape_string($connect, $_GET['user_query']);
                    echo "<div class='products_box'>";
                    echo "<h3>Kết quả tìm kiếm cho sản phẩm: <b>" . htmlspecialchars($search) . "</b></h3>";
                    $sql = "SELECT * FROM product WHERE product_name LIKE '%$search%'";
                    $result = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $product_id = $row['product_id'];
                            $product_name = htmlspecialchars($row['product_name']);
                            $product_price = $row['product_price'];
                            $product_image = htmlspecialchars($row['product_image']);
                            echo "
                            <div class='single_product'>
                                <h3>$product_name</h3>
                                <img src='Images/$product_image' alt='$product_name'>
                                <p><b>Price: $$product_price</b></p>
                                <a href='single.php?id=$product_id'>Details</a>
                                <a href='index.php?add_cart=$product_id'>
                                    <button style='float:right;'>Add to Cart</button>
                                </a>
                            </div>";
                        }
                    } else {
                        echo "<p>Không tìm thấy sản phẩm nào.</p>";
                    }
                    echo "</div>";
                }
                ?>
            </div>
        </div>
        <div class="footer">
            <p>Đây là footer</p>
        </div>
    </div>
</body>
</html>
