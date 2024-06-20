<html>

<?php
include 'db.php';
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
      $_SESSION['cart'][]= $item;
    }
    }else{
        echo "<script>window.location.replace('login.php');</script>";
  }
}
?>

<head>
    <title>FootLocker</title>
    <link rel="stylesheet" href="css/indexstyle.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href='https://fonts.googleapis.com/css?family=Otomanopee One' rel='stylesheet'>
</head>

<body>
    <!-- Top navigation -->
    <div class="topnav">

        <!-- Centered link -->
        <div class="topnav-centered">
            <a href="index.html">HOME</a>
            <a href="man.php">MAN</a>
            <a href="woman.php">WOMAN</a>
            <a href="kids.php">KIDS</a>
            <a href="sale.php">SALE</a>
        </div>

        <!-- Left-aligned links (default) -->
        <img src="css/pictures/logo.png" alt="logo">

        <!-- Right-aligned links -->
        <div class="topnav-right">
            <a href="search.php" class="active">
                <i class="material-symbols-outlined">search</i></a>
            <a href="cart.php">
                <i class="material-symbols-outlined">shopping_cart</i></a>
            <a href="login.php">
                <i class="material-symbols-outlined">person</i></a>
        </div>

    </div>
    <div class="container">
        <div class="search">
            <h1>Search Over our Products</h1>
            <form action=" " method="POST">
                <i class="material-symbols-outlined">search</i><input type="text" name="search"
                    placeholder="Enter The name of the Product">
                <input type="hidden" name="searchsub" value="Search">
            </form>
            <br>
            <?php
            if (isset($_POST['searchsub'])){
                $search = $_POST['search'];
                $sql = "SELECT * FROM `product` WHERE `Product_Name` = '$search'";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {?>
            <div class="card">
            <form action=" " method="get">
                <img src="css/pictures/shoe.jpg" style="width:150px">
                <h1><?php echo $row['Product_Name']?></h1>
                <p class="price">$<?php echo $row['Product_Cost']?></p>
                <p><?php echo $row['Product_description']?></p>
                <input type="hidden" name="productcost" value="<?= $row['Product_Cost'];?>">
                <input type="hidden" name="productname" value="<?= $row['Product_Name'];?>">
                <input type="hidden" name="productid" value="<?= $row['Product_ID'];?>">
                <p><button type="submit" name="addcart">Add to Cart</button></p>
            </form>
            </div>
            <?php
                }
                } else {
                    ?>
                    <div class="seresults">
                        <h3>Item Not Found!</h3>
                    </div>
                    <?php
                    }
            }

            ?>
        </div>

    </div>
</body>

</html>