<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if($username == "admin" && $password == "admin123"){

    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;

    header("Location: dashboard.php");
    exit;

}else{

    echo "<script>
            alert('Username atau Password Salah');
            window.location='login.php';
          </script>";
}
?>