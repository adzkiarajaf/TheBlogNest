<?php
session_start();
include('function.php');

$conn = connectToDatabase();

$id_artikel = (int)$_GET['id_artikel'];

$user_role = "Penulis"; 
$_SESSION['user_role'] = $user_role;

$update_view_query = "UPDATE artikel SET view = view + 1 WHERE id_artikel = $id_artikel";
mysqli_query($conn, $update_view_query);

$artikel_query = "SELECT * FROM artikel WHERE id_artikel = $id_artikel";
$result = mysqli_query($conn, $artikel_query);
$artikel = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/viewartikel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>The Blog Nest | View Artikel</title>
</head>
<body>
    <div class="navbar">
    <?php if ($_SESSION['user_role'] == 'Penulis') : ?>
                <ul>
                    <a href="penulis.php" class="active">Dashboard</a>
            <?php else : ?>
                <ul>
                    <a href="admin.php" class="active">Dashboard</a>
            <?php endif; ?>
                <a href="artikel.php" >Artikel</a>
            <?php if ($_SESSION['user_role'] != 'Penulis') : ?>
                <a href="kategori.php">Kategori</a>
                <a href="user.php">User Management</a>
            <?php endif; ?>
        <a href="../index.php">Home</a>
        </ul>
        
        <div class="dropdown">
            <button class="dropbtn">
                <i class="fa fa-user"> <?= $_SESSION['user_username']; ?> </i> 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="#">Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>
    
    <div class="container">
    <section class="featured-post">
        <div class="container">
            <h1 class="title">View Artikel</h1>
            <br>
            <div class='post'>
            <img src="../assets/<?= $artikel['foto'] ?>" alt='Featured Post Image'>
            <div class='post-content'>
            <h3> <?= $artikel['judul']?> </h3>
            <p class='post-meta'>Posted by  <?= $artikel['penulis']?>   <?= date('d/m/y H:i', strtotime ($artikel['tanggal']))?> </p>
            <p> <?= $artikel['isi_artikel']?> </p>
            </div>
            </div>
        </div>
    </section>
    </div>
</body>
</html>