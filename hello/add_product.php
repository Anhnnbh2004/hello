<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h1>Thêm Sản Phẩm</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Mã sản phẩm:</td>
                <td><input type="text" name="product_id"></td>
            </tr>
            <tr>
                <td>Tên sản phẩm:</td>
                <td><input type="text" name="product_name"></td>
            </tr>
            <tr>
                <td>Giá sản phẩm:</td>
                <td><input type="text" name="product_price"></td>
            </tr>
            <tr>
                <td>Số lượng sản phẩm:</td>
                <td><input type="text" name="quantity"></td>
            </tr>
            <tr>
                <td>Ảnh sản phẩm:</td>
                <td><input type="file" name="product_img"></td>
            </tr>
            <tr>
                <td>Mô tả sản phẩm:</td>
                <td><input type="text" name="product_description"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="add_product" value="Thêm mới">
                </td>
            </tr>
        </table>
    </form>

    <?php
    // Connect to the database
    $connect = mysqli_connect('localhost', 'root', '', 'se06303_web');
    if (!$connect) {
        echo "Kết nối thất bại";
    } else {
        echo "Kết nối thành công";
    }

    // Insert data when form is submitted
    if (isset($_POST['add_product'])) {
        // Retrieve data from form
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $quantity = $_POST['quantity'];
        $product_description = $_POST['product_description'];
        $product_img = $_FILES['product_img']['name'];
        $product_img_tmp = $_FILES['product_img']['tmp_name'];

        // Move uploaded file to the Image folder
        move_uploaded_file($product_img_tmp, "Image/$product_img");

        // SQL query to insert product
        $sql = "INSERT INTO products 
                VALUES ('$product_id', '$product_name', '$product_price', '$quantity', '$product_img', '$product_description')";

        // Execute query
        $result = mysqli_query($connect, $sql);
        if ($result) {
            echo "<script>alert('Thêm sản phẩm thành công');</script>";
        } else {
            echo "<script>alert('Thêm sản phẩm thất bại');</script>";
        }
    }
    ?>
</body>
</html>
