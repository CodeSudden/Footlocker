<html>
<?php
include 'db.php';
?>
<head>
    <title>
        Register
    </title>
    <link rel="stylesheet" href="css/regstyle.css">
</head>

<body>
    <div class="container">
        <div class="content">
            <img src="css/pictures/regbg2.png" alt="Footlocker">
            <h1 class="form-title">Registration Form</h1>
            <div class="result">
            <?php
            if (isset($_POST['submit'])){
                $name = $_POST['name'];
                $pass = $_POST['pass'];
                $add = $_POST['address'];
                $email = $_POST['email'];
                $pnumber = $_POST['pnumber'];
                $sql = "INSERT INTO `customer`(`customer_name`, `customer_address`, `customer_phone`, `customer_email`, `customer_password`) 
                VALUES ('$name','$add','$pnumber','$email','$pass')";
                if (mysqli_query($con, $sql)) {
                echo "Registration success!<br>Redirecting to Login Page!<br>";    
                header('refresh:3;url=login.php');
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                }
            }
            ?>                
            </div>

            <form action=" " method="post">
                <b>Name: </b><input type="text" placeholder="Name" name="name" required>
                <b>Password: </b><input type="password" placeholder="Password" name="pass" required>
                <b>Address: </b><input type="text" placeholder="Address" name="address" required>
                <b>Email: </b><input type="email" placeholder="Email" name="email" required>
                <b>Phone number: </b><input type="number" placeholder="Phone Number" name="pnumber" required><br>
                <button type="submit" name="submit">Register</button>
                <a href="index.html">Cancel</a>
            </form>
        </div>
    </div>

</body>

</html>