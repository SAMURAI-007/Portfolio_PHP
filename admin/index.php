<?php
include "../admin/dbconfig/config.php";

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

    $Title = $_POST['Title'];
    $image = $_POST['image'];
    $content = $_POST['content'];

    $new = $conn->prepare("INSERT INTO `portfolio item` (`title`, `image`, `content`) VALUES (? , ?, ?)");
    $new->bindValue(1, $Title);
    $new->bindValue(2, $image);
    $new->bindValue(3, $content);
    $new->execute();
}

$items = $conn->prepare("SELECT * FROM `portfolio item` ");
$items->execute();
$items_display = $items->fetchAll(PDO::FETCH_ASSOC);
$num=1;




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
            <span class="navbar-brand" href="#">Admin dashboard</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-dark" aria-current="page" href="logout.php">logout</a>
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
                <input type="text" name="Title" placeholder="Title" style="margin-right: 10px;">
                <input type="text" name="image" placeholder="image URL">
            </div>

            <br>
            <textarea name="content"></textarea>
            <br>
            <input type="submit" name="sub" class="btn btn-primary">
    </div>
    <br>
    <div class="container">
        <h2>Current portfolio items</h2>
        <p>you can edit or delete your items in here</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>image</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items_display as $item) { ?>
                    <tr>
                        <td><?php echo $num++; ?></td>
                        <td><?php echo $item['title']; ?></td>
                        <td><img style="max-width: 100px;" src="<?php echo $item['image']; ?>"></td>

                        <td>
                            <a href="edit.php?id=<?php echo $item['id']; ?>" class="btn btn-warning">edit</a>
                            <a href="delete.php?id=<?php echo $item['id']; ?>" class="btn btn-danger">delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <br><br>
</body>

<script>
    CKEDITOR.replace('content');
</script>

</html>