<?php 
include "../admin/dbconfig/config.php";

if ($_SESSION['login'] == false) {
    header("location:../index.php");
}


if (isset($_POST['sub'])) {

    $Title= $_POST['Title'];
    $image= $_POST['image'];
    $content= $_POST['content'];

    $new = $conn->prepare("INSERT INTO portfolio item SET Title=? , image=? , content=?");
    $new->bindValue(1, $Title);
    $new->bindValue(2, $image);
    $new->bindValue(3, $content);
    $new->execute();
    $item_display = $new->fetchAll(PDO::FETCH_ASSOC);
    header("location:index.php");
}

?>