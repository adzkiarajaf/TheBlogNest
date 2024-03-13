<?php
include('function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>The Blog Nest | Penulis Dashboard</title>
</head>
<body>
    <div class="navbar">
        <ul><a href="admin.php" class="active">Dashboard</a>
        <a href="artikel.php">Artikel</a>
        <a href="kategori.php">Kategori</a>
        <a href="../index.php">Home</a>
        </ul>
        <div class="dropdown">
            <button class="dropbtn">
                <i class="fa fa-user"> User </i> 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="#">Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>
    <div class="container">
            <h1>Selamat Datang Penulis Dashboard!</h1>
            <p>ini adalah penulis dashboard</p>
            <div class="dashboard-widgets">
                <div class="widget">
                    <h2><i class="fa fa-chart-bar" aria-hidden="true"></i> Statistics</h2>
                    <p>Total Artikel : </p>
                </div>
                <div class="widget">
                    <h2><i class="fa fa-newspaper" aria-hidden="true"></i> Recent Posts</h2>
                    <ul>
                        <li><a href="#">Artikel Terbaru</a></li>
                    </ul>
                </div>
                <div class="widget">
                    <h2><i class="fa fa-users" aria-hidden="true"></i> Users</h2>
                    <p>List User</p>
                </div>
            </div>
    </div>
</body>
</html>