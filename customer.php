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
      <a href=" " class="current">
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
    <div class=" ">
    <div class="modalstyle">
        <input type="checkbox" id="modal">
        <div class="modalbutton">
            <label for="modal" class="example-label">Add Customer</label>
        </div>
        <label for="modal" class="modal-background"></label>
        <div class="modal">
            <div class="modal-header">
                <h3>Add Another Customer</h3>
                <label for="modal">
                    <i class="material-symbols-outlined">close</i>
                </label>
            </div>
            <p>
            <form action=" " method="post">
                <label class="formstyle">Customer Name:</label>
                <input type="text" name="customername"><br><br>
                <label class="formstyle">Customer Address:</label>
                <input type="text" name="customeradd"><br><br>
                <label class="formstyle">Customer Phone:</label>
                <input type="text" name="Customerphone"><br><br>
                <label class="formstyle">Customer Email:</label>
                <input type="text" name="Customeremail"><br><br>
                <label class="formstyle">Customer Password:</label>
                <input type="text" name="Customerpassword"><br><br>
                <input type="submit" class="addbutton" name="addcustomer" value="Add Customer">
            </form>
            </p>
        </div>
    </div>
  </div>
    <?php
    if (isset($_POST['addcustomer'])){    
      $customername = $_POST['customername'];
      $customeradd = $_POST['customeradd'];
      $Customerphone = $_POST['Customerphone'];
      $Customeremail = $_POST['Customeremail'];
      $Customerpassword = $_POST['Customerpassword'];
      $sql = "INSERT INTO `customer`(`customer_name`, `customer_address`, `customer_phone`, `customer_email`, `customer_password`) 
      VALUES ('$customername','$customeradd','$Customerphone','$Customeremail','$Customerpassword')";
      if (mysqli_query($con, $sql)){
          echo "Customer Added!";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($con);
      }
}
    ?>
    <h1><center>Customer List</center></h1>
      <div class="customerscroll"> 
      <?php
      if (isset($_POST['delete'])){
        $customerid = $_POST['customerid'];
        $sql = "DELETE FROM customer WHERE customer_ID= '$customerid'";
        if (mysqli_query($con, $sql)) {
            echo "Record deleted successfully";
            header ("refresh:2;url=customer.php");
        } else {
            echo "Error deleting record: " . mysqli_error($con);
        }
      }
          $sql = "SELECT * FROM customer";
          $result = $con->query($sql);
          echo "<table class='styled-table'>
          <thead>
          <tr>
          <th>Customer ID</th>
          <th>Customer Name</th>
          <th>Customer Address</th>
          <th>Customer Phone</th>
          <th>Customer Email</th>
          <th>Customer Password</th>
          <th>Actions</th>
          </tr>
          </thead>";
          while($row = $result-> fetch_assoc())
          {
          echo "<tr>";
          echo "<td>" . $row['customer_ID'] . "</td>";
          echo "<td>" . $row['customer_name'] . "</td>";
          echo "<td>" . $row['customer_address'] . "</td>";
          echo "<td>" . $row['customer_phone'] . "</td>";
          echo "<td>" . $row['customer_email'] . "</td>";
          echo "<td>" . $row['customer_password'] . "</td>";?>				
          <form action=" " method="POST">
              <input type="hidden" name="customerid" value="<?php echo $row["customer_ID"]?>">
              <td><input class="buttonDEL" type="submit" name="delete" value="Delete"></td>
          </form>
          <?php
          echo "</tr>";
          }                
          echo "</table>";
          mysqli_close($con);
      ?>
      </div>
    </main>
  </body>
</html>