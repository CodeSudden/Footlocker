<!DOCTYPE html>

<?php
include 'db.php'
?>

<html>
  <head>
    <title>Footlocker Admin</title>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
    <link rel="stylesheet" href="css/adminstyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  </head>
  <body>
    <div id="pgside">
      <div id="pguser">
        <img src="css/pictures/usericon.png">
        <i class="txt">Administrator</i>
      </div>
      <a href="dashboard.php" >
        <i class="material-symbols-outlined">Dataset </i>
        <i class="txt">Dashboard</i>
      </a>
      <a href="products.php">
        <i class="material-symbols-outlined">inventory_2</i>
        <i class="txt">Products</i>
      </a>
      <a href="category.php">
        <i class="material-symbols-outlined">category</i>
        <i class="txt">Categories</i>
      </a>
      <a href="customer.php">
        <i class="material-symbols-outlined">groups_3</i>
        <i class="txt">Customers</i>
      </a>
      <a href="order.php" >
        <i class="material-symbols-outlined">receipt_long</i>
        <i class="txt">Order</i>
      </a>
      <a href="delivery.php">
        <i class="material-symbols-outlined">local_shipping</i>
        <i class="txt">Delivery</i>
      </a>
      <a href=" " class="current">
        <i class="material-symbols-outlined">payments</i>
        <i class="txt">Payments</i>
      </a>
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      <a href="index.html">
        <i class="material-symbols-outlined">logout</i>
        <i class="txt">Log-Out</i>
      </a>
    </div>
    <main id="pgmain">
    <h1><center>Total Payments</center></h1>  
    <?php
      if (isset($_POST['delete'])){
      $paymentid = $_POST['paymentid'];
      $sql = "DELETE FROM payment WHERE payment_ID= '$paymentid'";
      if (mysqli_query($con, $sql)) {
          echo "Record deleted successfully";
          header ("refresh:2;url=payments.php");
      } else {
          echo "Error deleting record: " . mysqli_error($con);
      }
    }
        $sql = "SELECT * FROM payment";
        $result = $con->query($sql);
        echo "<table class='styled-table'>
        <thead>
        <tr>
        <th>Payment ID</th>
        <th>Wallet ID</th>
        <th>Order ID</th>
        <th>Total amount</th>
        <th>Payment Date</th>
        <th>Status</th>
        <th>Actions</th>
        </tr>
        </thead>";
        while($row = $result-> fetch_assoc())
        {
        echo "<tr>";
        echo "<td>" . $row['payment_ID'] . "</td>";
        echo "<td>" . $row['wallet_ID'] . "</td>";
        echo "<td>" . $row['order_ID'] . "</td>";
        echo "<td>" . $row['total_amount'] . "</td>";
        echo "<td>" . $row['payment_date'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";?>	
        <form action=" " method="POST">
            <input type="hidden" name="paymentid" value="<?php echo $row["payment_ID"]?>">
            <td><input class="buttonDEL" type="submit" name="delete" value="Delete"></td>
        </form>
        <?php
        echo "</tr>";
        }                
        echo "</table>";
        mysqli_close($con);
        ?>
    </main>
  </body>
</html>