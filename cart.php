<?php
include 'db.php';
session_start();
if(!isset($_SESSION['customerid'])) {
	header('location:login.php');
	}
?>

<html>

<head>
    <title>Footlocker Cart</title>
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<?php
if (isset($_GET['removeid'])) {
    $proid = $_GET['removeid'];
    unset($_SESSION['cart'][$proid]);
    header("location: cart.php");
    }
    
if (isset($_POST['update'])){
    $upid = $_POST['upid'];
    $acol = array_column($_SESSION['cart'], 'productid');
    if (in_array($_POST['upid'], $acol)) {
    $_SESSION['cart'][$upid]['qty'] = $_POST['qty'];
    } else {
    $item = [
        'productid' => $upid,
        'qty' => 1
    ];
    $_SESSION['cart'][$upid] = $item;
    }
    header("location: cart.php");
}

if(isset($_POST['checkout'])){
    $customer = $_POST['customer'];
    $productid = $_POST['productid'];
    $year = $_POST['year'];
    $total = $_POST['total'];
    $mop = $_POST['mop'];
    $orderid = date("ymhis");
    $sql = "INSERT INTO `orders`(`order_ID`, `customer_ID`, `product_ID`, `order_date`, `order_amount`, `MOP`) 
    VALUES ('$orderid', '$customer','$productid','$year','$total','$mop')";
    if (mysqli_query($con, $sql)){
        header('refresh:3;url=profile.php');
        echo "Order has been Checkout";
        unset($_SESSION['cart']);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
?>

<body>
<div class="back">
<a href="index.html"><i class="material-symbols-outlined">arrow_back</i>Go back</a>
</div>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Product id</th>
                    <th>Product name</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Quantity</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($_SESSION['cart'])) :
                        $total= 0;
                        $i = 1;
                        foreach ($_SESSION['cart'] as $cart) :
                    ?>
                <tr>
                    <td>#<?php echo $i; ?></td>
                    <td> Product <?= $cart['productid']; ?></td>
                    <td><?= $cart['productname']; ?></td>
                    <td>$<?= number_format( $cart['productcost']) ?></td>
                    <td>$<?= number_format($cart["qty"] * $cart["productcost"]) ?></td>
                    <td>
                        <form action="update.php" method="post">
                            <input type="number" class="quanti" value="<?= $cart['qty']; ?>" name="qty" min="1">
                            <input type="hidden" name="upid" value="<?= $cart['productid']; ?>">
                    </td>
                    <td>
                        <input type="submit" class="btn" name="update" value="Update">
                        </form>
                    </td>
                    <td><a href="cart.php?removeid=<?= $cart['productid']; ?>" class="btn">Remove</a></td>
                </tr>
                <?php
                $total = $total + ($cart["qty"] * $cart["productcost"]);
                $i++;
                endforeach;
                ?>
                <td colspan="4" align="right">Total Amount:</td>
                <td>$<?= number_format($total)?></td>
                <td colspan="3"></td>
                <?php
            endif;
            ?>
            </tbody>
        </table>
    </div>
    <div class="bottombar">
        <br>
        <h2>Check out Items</h2>
        <form action=" " method="POST">
            <input type="hidden" name="customer" value="<?= $_SESSION['customerid']?>">
            <input type="hidden" name="productid" value="<?= $cart['productid']?>">
            <input type="hidden" name="year" value="<?= date("Y-m-d")?>">
            <input type="hidden" name="total" value="<?= $total ?>">
            <br><br><br><br>
            <h5>Payment Method</h5><br>
            <input type="radio" class="bot" name="mop" value="Cash" required> Cash<br>
            <input type="radio" class="bot" name="mop" value="Wallet"> Wallet<br>
            <button type="submit" name="checkout">checkout</button>
        </form>

    </div>
</body>

</html>