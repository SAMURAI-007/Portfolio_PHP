<?php
include("../admin/dbconfig/config.php");
$id=$_GET['id'];
$result = $conn->prepare("DELETE FROM `portfolio item` WHERE id=?");
$result->bindValue(1,$id);
$result->execute();
header("location:index.php");
if ($_SESSION['login'] == false) {
    header("location:../index.php");
}
?>