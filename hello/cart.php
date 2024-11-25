<?php
session_start();
include("connect.php");

// If the user is not logged in
if (!isset($_SESSION['user_id'])) {
    echo "<center><h5>You need to log in to see your cart.</h5></center>";
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['delete_cart_pro'])) {
    $cart_id = mysqli_real_escape_string($connect, $_GET['delete_cart_pro']);
    $sql = "DELETE FROM cart WHERE cart_id = '$cart_id' AND user_id = '$user_id'";
    if (mysqli_query($connect, $sql)) {
        echo "<script>alert('Product removed from cart');</script>";
        echo "<script>window.location.href = 'cart.php';</script>";
    } else {
        echo "<script>alert('Error deleting item');</script>";
    }
}

// Handle quantity update
if (isset($_POST['update_quantity'])) {
    $cart_id = mysqli_real_escape_string($connect, $_POST['cart_id']);
    $quantity = mysqli_real_escape_string($connect, $_POST['quantity']);

    if ($quantity > 0) {
        $sql = "UPDATE cart SET quantity = '$quantity' WHERE cart_id = '$cart_id' AND user_id = '$user_id'";
        if (mysqli_query($connect, $sql)) {
            echo "<script>alert('Cart updated successfully');</script>";
            echo "<script>window.location.href = 'cart.php';</script>";
        } else {
            echo "<script>alert('Error updating cart');</script>";
        }
    } else {
        echo "<script>alert('Invalid quantity');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Shopping Cart</title>
</head>
<body>
    <center>
        <h2>Your Shopping Cart</h2>
        <form method="post">
            <table border="1">
                <tr>
                    <th>Product Name</th>
                    <th>Images</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                <?php
                $sql = "SELECT cart.cart_id, product.product_name, product.product_image, product.product_price, cart.quantity 
                        FROM product 
                        JOIN cart ON product.product_id = cart.product_id 
                        WHERE cart.user_id = '$user_id'";
                $result = mysqli_query($connect, $sql);

                if (mysqli_num_rows($result) == 0) {
                    echo "<tr><td colspan='5'><h5>Your shopping cart is empty</h5></td></tr>";
                } else {
                    $total = 0;
                    while ($row_cart = mysqli_fetch_assoc($result)) {
                        $product_total = $row_cart['product_price'] * $row_cart['quantity'];
                        $total += $product_total;
                        echo "
                        <tr>
                            <td><a href='detail.php?product_id={$row_cart['cart_id']}'>{$row_cart['product_name']}</a></td>
                            <td><img src='Images/{$row_cart['product_image']}' width='50' height='50'></td>
                            <td>{$row_cart['product_price']}</td>
                            <td>
                                <input type='number' name='quantity' value='{$row_cart['quantity']}' min='1'>
                                <input type='hidden' name='cart_id' value='{$row_cart['cart_id']}'>
                            </td>
                            <td>
                                <a href='cart.php?delete_cart_pro={$row_cart['cart_id']}'>Delete</a>
                                <input type='submit' name='update_quantity' value='Update'>
                            </td>
                        </tr>";
                    }
                    echo "<tr><td colspan='4'><b>Total:</b></td><td><b>$" . number_format($total, 2) . "</b></td></tr>";
                }
                ?>
            </table>
        </form>

        <h3 style="text-align: center;">Payment Information</h3>
        <form method="POST" action="thanhtoan.php">
            <table>
                <tr>
                    <td>UserName:</td>
                    <td><input type="text" name="name" value="<?php echo $_SESSION['username'] ?? ''; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Select payment bank:</td>
                    <td>
                        <select name="bank" required>
                            <option value="" disabled selected>Select your bank</option>
                            <option value="Vietcombank">Vietcombank</option>
                            <option value="Techcombank">Techcombank</option>
                            <option value="Airpay">Airpay</option>
                            <option value="momo">Momo</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Order Date:</td>
                    <td>
                        <input type="text" name="date" value="<?php echo date('d.m.Y h:i:sa'); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Total:</td>
                    <td><input type="text" name="total" value="<?php echo number_format($total, 2); ?>" readonly></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Pay"></td>
                </tr>
            </table>
        </form>
    </center>
</body>
</html>
