<?php
session_start();
include('function.php');

$conn = connectToDatabase();

$sql = "SELECT COUNT(*) AS total_artikel FROM artikel";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $total_artikel = $row['total_artikel'];
} else {
    $total_artikel = 0;
}

$sql_recent_posts = "SELECT judul,tanggal FROM artikel ORDER BY tanggal DESC LIMIT 1";
$result_recent_posts = $conn->query($sql_recent_posts);

if ($result_recent_posts->num_rows > 0) {
    $row_recent_post = $result_recent_posts->fetch_assoc();
    $judul_recent_post = $row_recent_post['judul'];
    $tanggal_recent_post = $row_recent_post['tanggal'];
} else {
    $judul_recent_post = "Tidak ada artikel terbaru";
    $tanggal_recent_post = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>The Blog Nest | Admin Dashboard</title>
</head>
<body>
<div class="navbar">
        <ul><a href="admin.php" class="active">Dashboard</a>
        <a href="artikel.php" >Artikel</a>
        <a href="kategori.php">Kategori</a>
        <a href="user.php">List Penulis</a>
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
            <h1>Selamat Datang <?= $_SESSION['user_username']; ?></h1>
            <p>Selamat datang di Dasbor Artikel The Blog Nest! Di sini, Anda dapat mengelola konten artikel untuk situs web kami. Jelajahi berbagai fitur yang tersedia untuk membuat, mengedit, dan menghapus artikel, serta melihat statistik dan memberikan pengaturan lainnya sesuai dengan kebutuhan.</p>
            <div class="dashboard-widgets">
                <div class="widget">
                    <h2><i class="fa fa-chart-bar" aria-hidden="true"></i> Statistics</h2>
                    <p>Total Jumlah Artikel: <?= $total_artikel; ?> Artikel</p>
                </div>
                <div class="widget">
                    <h2><i class="fa fa-newspaper" aria-hidden="true"></i> Recent Posts</h2>
                    <ul>
                        <li> <span><?= $tanggal_recent_post; ?></span> - <?= $judul_recent_post; ?></li>
                    </ul>
                </div>
                <div class="widget">
                    <h2><i class="fa fa-users" aria-hidden="true"></i> Users</h2>
                    <p>Manage users and their roles.</p>
                </div>
            </div>
    </div>
</body>
</html>