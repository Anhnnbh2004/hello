<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <form action="registerweb.php" method="POST">
        <h2>Register</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <input type="submit" name="submit" value="Register">
        <p>Already have an account? <a href="loginweb.php">Login here</a></p>
    </form>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Kết nối DB
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "se06303_web";    
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Lấy dữ liệu từ form
            $username = mysqli_real_escape_string($conn, $_POST["username"]);
            $password = mysqli_real_escape_string($conn, $_POST["password"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);

            // Hash mật khẩu
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            // Tạo truy vấn SQL
            $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password_hashed', '$email')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Đăng ký thành công! Chuyển hướng đến trang đăng nhập.');</script>";
                header("Location: loginweb.php");
                exit();
            } else {
                echo "<script>alert('Đăng ký thất bại!');</script>";
            }

            mysqli_close($conn);
        }
    ?>
</body>
</html>
