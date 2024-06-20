<html>
<?php
    include 'db.php';
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Footlocker User profile</title>
    <link rel="stylesheet" href="css/profile.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body>
    <div class="home">
    <i class="material-symbols-outlined">arrow_back</i><a href="index.html">Go Back to Home</a>
    </div>
    <div class="header">
        <h1>User Account and Info</h1>
    </div>
    <div class="body-section">
        <div class="sidebar">
            <img src="css/pictures/customer.png">
            <h1>User Profile</h1><br>
            <?php
        session_start();
        $customerid = $_SESSION['customerid'];
        $sql = "SELECT * FROM customer WHERE customer_ID = '$customerid'";
        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {?>
            <p><b>Customer ID: </b><?php echo $row["customer_ID"] ?></p><br>
            <p><b>Name: </b><?php echo $row["customer_name"] ?></p><br>
            <p><b>Address: </b><?php echo $row["customer_address"] ?></p><br>
            <p><b>Phone: </b><?php echo $row["customer_phone"]?></p><br>
            <p><b>Email: </b><?php echo $row["customer_email"]?></p><br>
            <?php
            }
        }
    
        ?>
            <div class="logout">
                <form action=" " method="post">
                    <button type="submit" name="logout">Log-Out</button>
                </form>
                <?php
        if(isset($_POST['logout'])){
            session_destroy();
            header('location:index.html');
        }
        ?>
            </div>

        </div>
        <div class="main-body">
            <div class="upbody">
                <br>
                <h2>Orders</h2><br>
                <div class="scrolltable">
                    <?php
                    $sql = "SELECT * FROM orders WHERE `customer_ID` = '$customerid'";
                    $result = $con->query($sql);
                    if (mysqli_num_rows($result) > 0) {
                    echo "<table class>
                    <thead>
                    <tr>
                    <th>Order ID</th>
                    <th>Product ID</th>
                    <th>Order date</th>
                    <th>Order Amount</th>
                    <th>MOP</th>
                    </tr>
                    </thead>";
                    while($row = $result-> fetch_assoc())
                    {
                    echo "<tr>";
                    echo "<td>" . $row['order_ID'] . "</td>";
                    echo "<td>" . $row['product_ID'] . "</td>";
                    echo "<td>" . $row['order_date'] . "</td>";
                    echo "<td>" . $row['order_amount'] . "</td>";
                    echo "<td>" . $row['MOP'] . "</td>";
                    echo "</tr>";
                    }                
                    echo "</table>";
                }else{
                    echo '<div class="results">';
                    echo "No Orders Yet!";
                    echo '</div>';
                }
                ?>
                </div>
            </div>
            <div class="downbody"><br>
                <h3>Wallet</h3>
                <?php
                    $sql = "SELECT * FROM wallet WHERE `customer_ID` = '$customerid'";
                    $result = $con->query($sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = $result-> fetch_assoc()){
                            if($row["status"] = 0){
                                echo "Wallet status: Not Activated";
                                echo "<br>";
                            }else{
                                echo "Wallet status: Active";
                                echo "<br>";
                            }
                            echo "Available Balance: ";
                            echo $row["balance"];
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>