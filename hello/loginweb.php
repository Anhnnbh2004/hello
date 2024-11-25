<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form action="loginweb.php" method="POST">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <input type="submit" name="login" value="Login">
        <p>Don't have an account? <a href="registerweb.php">Register here</a></p>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Kết nối DB
        $servername = "localhost";
        $dbusername = "root"; // Đặt lại biến để không trùng với $username từ form
        $dbpassword = "";
        $dbname = "se06303_web";

        $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

        // Kiểm tra kết nối
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Lấy dữ liệu từ form và xử lý an toàn
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = $_POST["password"];

        // Truy vấn kiểm tra thông tin
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            // Kiểm tra mật khẩu đã được mã hóa
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['username'] = $username;
                header("Location: homepage.php"); // Chuyển hướng đến trang chính
                exit();
            } else {
                echo "<script>alert('Incorrect password!');</script>";
            }
        } else {
            echo "<script>alert('Username does not exist!');</script>";
        }

        mysqli_close($conn);
    }
    ?>
</body>
</html>
