<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form action="" method="POST">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <input type="submit" name="login" value="Login">
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </form>
    <?php
        // Bước 1: Kết nối và chọn DB 
        $connect = mysqli_connect('localhost', 'root','','se06303_sdlc');
    
        if(!$connect) {
            die("Kết nối thất bại: " . mysqli_connect_error());
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Bước 2: Xây dựng câu truy vấn
            $username = $_POST["username"];
            $password = $_POST["password"];
            $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            // Bước 3: Thực thi
            $result = mysqli_query($connect, $sql);
            // Bước 4: Xử lý kết quả
            $check_login = mysqli_num_rows($result);   
            if($check_login > 0){
                echo "<script>alert('Đăng nhập thành công!');</script>";
                exit();
            } else {
                echo "<script>alert('Đăng nhập thất bại!');</script>"; 
            }   
        }
    ?>
</body>
</html>
