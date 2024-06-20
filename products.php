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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body>
    <div id="pgside">
        <div id="pguser">
            <img src="css/pictures/usericon.png">
            <i class="txt">Administrator</i>
        </div>
        <a href="dashboard.php">
            <i class="material-symbols-outlined">Dataset </i>
            <i class="txt">Dashboard</i>
        </a>
        <a href=" " class="current">
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
            <div class="modalstyle">
                <input type="checkbox" id="modal">
                <div class="modalbutton">
                    <label for="modal" class="example-label">Add Product</label>
                </div>
                <label for="modal" class="modal-background"></label>
                <div class="modal">
                    <div class="modal-header">
                        <h3>Add Product on the list</h3>
                        <label for="modal">
                            <i class="material-symbols-outlined">close</i>
                        </label>
                    </div>
                    <p>
                    <form action=" " method="post">
                        <label class="formstyle">Product ID: </label>
                        <input type="text" name="product_id"><br><br>
                        <label class="formstyle">Product Name: </label>
                        <input type="text" name="product_name"><br><br>
                        <label class="formstyle">Product Description: </label>
                        <input type="text" name="product_desc"><br><br>
                        <label class="formstyle">Category</label>
                        <select name="category_id">
                        <?php
                        $sql = "SELECT * FROM category";
                        $all_category = mysqli_query($con,$sql);
                        while ($category = mysqli_fetch_array(
                            $all_category,MYSQLI_ASSOC)):;
                        ?>
                        <option value="<?php echo $category["Category_ID"];?>">
                        <?php echo $category["Category_ID"]; echo $category["Category_Name"];?>
                        </option>
                        <?php endwhile; ?>
                        </select><br><br> 
                        <label class="formstyle">Product Cost:</label>
                        <input type="text" name="product_cost"><br><br>
                        <input type="submit" class="addbutton" name="addproduct" value="Add Product">
                    </form>
                    </p>
                </div>
            </div>
        <div class="stats">
        <?php
        if (isset($_POST['addproduct'])){    
            $productid = $_POST['product_id'];
            $productname = $_POST['product_name'];
            $productdesc = $_POST['product_desc'];
            $categoryid = $_POST['category_id'];
            $productcost = $_POST['product_cost'];
            $sql = "INSERT INTO `product`(`Product_ID`, `Product_Name`, `Product_description`, `Category_ID`, `Product_Cost`) 
            VALUES ('$productid','$productname','$productdesc','$categoryid','$productcost')";
            if (mysqli_query($con, $sql)){
                echo "Product Added!";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
                echo "<br> ID already exist!";
            }
    }
        if (isset($_POST['deleteP'])){
            $productid = $_POST['productid'];
            $sql = "DELETE FROM product WHERE Product_ID= '$productid'";
            if (mysqli_query($con, $sql)) {
                echo "Record deleted successfully!";
            } else {
                echo "Error deleting record: " . mysqli_error($con);
            }
        }
        ?>
        </div>
        <div class="productscroll">
        <?php
        $sql = "SELECT * FROM product";
        $result = $con->query($sql);
        echo "<table class='styled-table'>
        <thead>
        <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Product Description</th>
        <th>Category ID</th>
        <th>Product Cost</th>
        <th>Actions</th>
        </tr>
        </thead>";
        while($row = $result-> fetch_assoc())
        {
        echo "<tr>";
        echo "<td>" . $row['Product_ID'] . "</td>";
        echo "<td>" . $row['Product_Name'] . "</td>";
        echo "<td>" . $row['Product_description'] . "</td>";
        echo "<td>" . $row['Category_ID'] . "</td>";
        echo "<td>" . $row['Product_Cost'] . "</td>";?>
            <form action=" " method="POST">
                <input type="hidden" name="productid" value="<?php echo $row["Product_ID"]?>">
                <td><input class="buttonDEL" type="submit" name="deleteP" value="Delete"></td>
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