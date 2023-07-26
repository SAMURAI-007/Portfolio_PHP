<?php
include "../admin/dbconfig/config.php";

if($_SESSION['login'] == false){
    header("location:../index.php");
}

$admin = $conn->prepare("SELECT * FROM admin");
$admin->execute();
$admin_display = $admin->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['logout'])){
    header("location:logout.php");
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="submit" value="logout" name="logout" >
    </form>
    
</body>
</html>