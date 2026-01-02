<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "sample");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['ID'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE ID='$username' AND PASS='$password'";
    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);

    if ($count) {
        header("Location: select.php");
        exit();
    } else {
        header("Location: adminlogin.html?error=invalid");
        exit();
    }
}
?>
