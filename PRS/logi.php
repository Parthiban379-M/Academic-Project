<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "sample");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM user WHERE name=? AND pass=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if (!$res) {
        echo "Error: " . mysqli_error($con);
        exit();
    }

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // Login successful, set session variables
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

        // Check if the user is a new user
        if (!isset($_SESSION['login_count'])) {
            $_SESSION['login_count'] = 1;
        } else {
            $_SESSION['login_count']++;
        }

        if ($_SESSION['login_count'] == 1) {
            header("Location: index.html?showAlert=true&username=" . urlencode($username));
            exit();
        } else {
            header("Location: pp.html");
            exit();
        }
    } else {
        header("Location: login.html?error=invalid");
        exit();
    }
}
?>



