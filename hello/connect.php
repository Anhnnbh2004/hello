<?php
$servername = "localhost";
$username = "root";  // Thay đổi username nếu cần
$password = "";      // Thay đổi password nếu cần
$dbname = "se06303_web"; // Thay đổi tên cơ sở dữ liệu

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
