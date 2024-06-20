<html>

<?php
include('db.php');
session_start();
if (isset($_GET['addcart'])) {
  if(isset($_SESSION['customerid'])){
    $proid = $_GET['productid'];
    if (!empty($_SESSION['cart'])) {
      $acol = array_column($_SESSION['cart'], 'productid');
      if (in_array($proid, $acol)) {
        $_SESSION['cart'][$proid]['qty'] += 1;
      } else {
        $item = [
          'productid' => $_GET['productid'],
          'productname' => $_GET['productname'],
          'productcost' => $_GET['productcost'],
          'qty' => 1
        ];
        $_SESSION['cart'][$proid]= $item;
      }
    } else {
      $item = [
        'productid' => $_GET['productid'],
        'productname' => $_GET['productname'],
        'productcost' => $_GET['productcost'],
        'qty' => 1
      ];
      $_SESSION['cart'][$proid]= $item;
    }
  }else{
    echo "<script>window.location.replace('login.php');</script>";
  }
}
  ?>
<head>
    <title>FootLocker</title>
    <link rel="stylesheet" href="css/indexstyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body>
    <!-- Top navigation -->
    <div class="topnav">

        <!-- Centered link -->
        <div class="topnav-centered">
            <a href="index.html">HOME</a>
            <a href="man.php">MAN</a>
            <a href="woman.php">WOMAN</a>
            <a href=" " class="active">KIDS</a>
            <a href="sale.php">SALE</a>
        </div>

        <!-- Left-aligned links (default) -->
        <img src="css/pictures/logo.png" alt="logo">

        <!-- Right-aligned links -->
        <div class="topnav-right">
            <a href="search.php">
                <i class="material-symbols-outlined">search</i></a>
            <a href="cart.php">
                <i class="material-symbols-outlined">shopping_cart</i></a>
            <a href="login.php">
                <i class="material-symbols-outlined">person</i></a>
        </div>

    </div>
    <div class="container">
        <div class="productcard">
            <?php
                $sql = "SELECT * FROM product WHERE Category_ID='223'";
                $result = $con->query($sql);
                while($row = $result-> fetch_assoc())
                {?>
            <div class="card">
            <form action=" " method="get">
                    <img src="css/pictures/shoe.jpg" style="width:150px">
                    <h1><?php echo $row['Product_Name']?></h1>
                    <p class="price">$<?= number_format($row['Product_Cost']); ?></p>
                    <p><?= $row['Product_description']?></p>
                    <input type="hidden" name="productcost" value="<?= $row['Product_Cost'];?>">
                    <input type="hidden" name="productname" value="<?= $row['Product_Name'];?>">
                    <input type="hidden" name="productid" value="<?= $row['Product_ID'];?>">
                    <p><button type="submit" name="addcart">Add to Cart</button></p>
                </form>
            </div>
            <?php
                }  
                mysqli_close($con);
                ?>
        </div>
    </div>
</body>

</html>