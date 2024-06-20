<html>

<?php
include 'db.php';
session_start();
if(isset($_SESSION['customerid'])) {
header('location:profile.php');
}
?>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="css/loginstyle.css">
</head>

<body>
    <div class="parent clearfix">
        <div class="bg-illustration">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        </div>

        <div class="login">
            <div class="back">
                <a href="index.html"><i class="material-symbols-outlined">arrow_back</i>Go back</a>
            </div>
            <div class="container">
                <h1>Login to access to your account</h1>
                <div class="login-form">
                    <form action=" " method="POST">
                        <input type="text" name="email" placeholder="Email">
                        <input type="password" name="password" placeholder="Password">
                        <div class="administrator">
                            <a class="admin" href="adminlogin.php">Login as administrator ?</a>
                            <span>Not yet a Member?</span>&nbsp;&nbsp;<a href="register.php">Register Here!</a>                  
                        <div class="results">          
                            <?php
                                if (isset($_POST['submit'])){
                                    $email = $_POST['email'];
                                    $pass = $_POST['password'];
                                    $sql = "SELECT * FROM customer WHERE customer_email = '$email' && customer_password = '$pass' ";
                                    $result = mysqli_query($con, $sql);
                                    if (mysqli_num_rows($result) == 1) {
                                        while ($user = mysqli_fetch_assoc($result)){
                                        $_SESSION['customerid'] = $user["customer_ID"];
                                        }
                                        echo "<script>window.location.replace('index.html');</script>";
                                    }
                                    else{
                                        echo 'Wrong credentials!';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <button class="loginbutton" type="submit" name="submit">LOG-IN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>