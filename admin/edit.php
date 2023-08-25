<?php
include "../admin/dbconfig/config.php";

$id = $_GET['id'];

if ($_SESSION['login'] == false) {
    header("location:../index.php");
}

$admin = $conn->prepare("SELECT * FROM admin");
$admin->execute();
$admin_display = $admin->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['logout'])) {
    header("location:logout.php");
}

if (isset($_POST['sub'])) {

    $title = $_POST['title'];
    $image = $_POST['image'];
    $content = $_POST['content'];

    $new = $conn->prepare("UPDATE `portfolio item` SET `title` = ? , `image` = ? , `content` = ? WHERE `portfolio item`.`id` = $id;");
    $new->bindValue(1, $title);
    $new->bindValue(2, $image);
    $new->bindValue(3, $content);
    $new->execute();
    header("location:index.php");
}

$items = $conn->prepare("SELECT * FROM `portfolio item` WHERE id=?");
$items->bindValue(1,$id);
$items->execute();
$item = $items->fetch(PDO::FETCH_ASSOC);




?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/ckeditor/ckeditor.js"></script>
    <title>admin dashboard</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <span class="navbar-brand">edit menu</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-dark" aria-current="page" href="index.php">Cansel</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container" style="padding-right: 400px;">
        <h3>portfolio management</h3>
        <br>
        <form method="post" class="form-control admin-form">
            <h4>new portfolio item</h4>
            <div style="margin-bottom: 10px;">
                <input value="<?php echo $item['title'] ?>" type="text" name="title" style="margin-right: 10px;">
                <input value="<?php echo $item['image'] ?>" type="text" name="image">
            </div>

            <br>
            <textarea name="content"><?php echo $item['content'] ?></textarea>
            <br>
            <input type="submit" name="sub" class="btn btn-primary">
    </div>
    <br>
    <br><br>
</body>

<script>
    CKEDITOR.replace('content');
</script>

</html>