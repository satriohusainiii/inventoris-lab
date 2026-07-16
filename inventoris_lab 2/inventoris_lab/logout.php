<?php
session_start();

session_unset();
session_destroy();

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<link rel="stylesheet"
href="bootstrap/css/bootstrap.min.css">

<meta http-equiv="refresh"
content="3;url=login.php">

<style>

body{

height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:#f5f6fa;

}

.box{

width:420px;
padding:40px;
background:white;
border-radius:15px;
box-shadow:0px 0px 20px rgba(0,0,0,.1);
text-align:center;

}

</style>

</head>
<body>


<div class="box">

<div class="alert alert-success">

<h4>
Logout Berhasil
</h4>

<p>
Anda sudah berhasil logout.
</p>

<p>
Anda akan diarahkan ke halaman login dalam 3 detik.
</p>

</div>


</div>


</body>
</html>