<?php
$con = new mysqli('localhost','root','','shop');
      if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
      }
?>
