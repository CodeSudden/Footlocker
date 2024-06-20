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
      <a href=" " class="current">
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
      <a href="order.php">
        <i class="material-symbols-outlined">receipt_long</i>
        <i class="txt">Order</i>
      </a>
      <a href="delivery.php">
        <i class="material-symbols-outlined">local_shipping</i>
        <i class="txt">Delivery</i>
      </a>
      <a href="payments.php">
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
      <h1><center>FootLocker Dashboard</center></h1>
      <h2>Product Data</h2>
      <div class="productdata">
        <div class="box">
          <h4>Total Products</h4>
          <h2>
          <?php
          $sql = "SELECT * from product";
          if ($result = mysqli_query($con, $sql)) {
              $rowcount = mysqli_num_rows( $result );
              echo($rowcount);
           }
          ?>
          </h2>
        </div>
        <div class="box2">
          <h4>Total Customers</h4>
          <h2>
          <?php
          $sql = "SELECT * from customer";
          if ($result = mysqli_query($con, $sql)) {
              $rowcount = mysqli_num_rows( $result );
              echo($rowcount);
           }
          ?>
          </h2> 
        </div>
        <div class="box3"> 
          <h4>Total Orders</h4>
          <h2>
          <?php
          $sql = "SELECT * from orders";
          if ($result = mysqli_query($con, $sql)) {
              $rowcount = mysqli_num_rows( $result );
              echo($rowcount);
           }
          ?>
          </h2>
        </div>
        <div class="box4"> 
          <h4>Total Deliveries</h4>
          <h2>
          <?php
          $sql = "SELECT * from delivery";
          if ($result = mysqli_query($con, $sql)) {
              $rowcount = mysqli_num_rows( $result );
              echo($rowcount);
           }
          ?>
          </h2>
        </div>
      </div>
        <h2>Total Payments</h2>
        <div class="payments">
          <div class="paybox">
            <?php
              $sql = "SELECT * FROM payment";
              $result = $con->query($sql);
              echo "<table class='paytable'>
              <thead>
              <tr>
              <th>Payment ID</th>
              <th>Order ID</th>
              <th>Total amount</th>
              <th>Payment Date</th>
              <th>Status</th>
              </tr>
              </thead>";
              $total = 0;
              while($row = $result-> fetch_assoc())
              {
              echo "<tr>";
              echo "<td>" . $row['payment_ID'] . "</td>";
              echo "<td>" . $row['order_ID'] . "</td>";
              echo "<td>" . $row['total_amount'] . "</td>";
              echo "<td>" . $row['payment_date'] . "</td>";
              echo "<td>" . $row['status'] . "</td>";
              echo "</tr>";
              $total = $total + $row['total_amount'];
              }                
              echo "</table>";
              mysqli_close($con);
            ?>
            <div class="total">
              <h1>Total Amount of payments</h3>
                $<?= number_format($total) ?>
            </div>
          </div>
        </div>
    </main>
  </body>
</html>