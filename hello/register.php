<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
<form action="" method="POST">
        <h2>Register</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" required><br>
        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" id="fullname" required><br>
        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" id="dob"><br>
        <label for="gender">Gender:</label>
        <select name="gender" id="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address"><br>
        <input type="submit" name="submit" value="Register">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Bước 1: Kết nối DB
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "se06303_sdlc";    
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if (!$conn) {
                die("Kết nối thất bại: " . mysqli_connect_error());
            }

            // Bước 2: Lấy dữ liệu từ form
            $username = $_POST["username"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $fullname = $_POST["fullname"];
            $dob = $_POST["dob"];
            $gender = $_POST["gender"];
            $address = $_POST["address"];
            
            // Bước 3: Tạo truy vấn SQL
            $sql = "INSERT INTO users (username, password, email, fullname, dob, gender, address) 
                    VALUES ('$username', '$password', '$email', '$fullname', '$dob', '$gender', '$address')";
            
            // Bước 4: Thực thi truy vấn
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Đăng ký thành công!');</script>";
                header("Location: login.php");
                exit();
            } else {
                echo "<script>alert('Đăng ký thất bại!');</script>";
            }
        }
    ?>
</body>
</html>

