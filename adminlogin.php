<html>

<?php
include 'db.php'
?>

<head>
    <link rel="stylesheet" href="css/adminlogin.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Sign in as Administrator</title>
</head>

<body>
    <div class="main">
        <p class="sign">Sign in as Admin</p>
        <form class=" " method="post">
            <input class="un " type="text" name="uname" placeholder="Username">
            <input class="pass" type="password" name="pass" placeholder="Password">
            <input class="submit" type="submit" name="submit" value="Submit">
        </form>
        <div class="back">
            <a href="login.php">Go Back</a>
        </div>
        
        <div class="result">
            <?php
              if (isset($_POST['submit'])){
              $uname = $_POST['uname'];
              $pass = $_POST['pass'];
              if($_POST['uname'] == "admin" and $_POST['pass'] == "admin"){
                echo "<script>window.location.replace('dashboard.php');</script>";              }
              else{
              echo 'Wrong credentials!';
              }
            }
            ?>
        </div>
    </div>


</body>

</html>