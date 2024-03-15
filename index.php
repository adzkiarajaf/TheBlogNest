<?php 
include('view/function.php');

$conn = connectToDatabase();


if(isset($_GET['search'])){
    $keyword = $_GET['search'];
    $sql_artikel = "SELECT * FROM artikel WHERE judul LIKE '%$keyword%' OR isi_artikel LIKE '%$keyword%' ORDER BY tanggal DESC";
} elseif (isset($_GET['kategori'])) {
    $kategori_id = $_GET['kategori'];
    $sql_artikel = "SELECT * FROM artikel WHERE id_kategori = '$kategori_id' ORDER BY tanggal DESC";
} elseif (isset($_GET['semua'])) {
    $sql_artikel = "SELECT * FROM artikel ORDER BY tanggal DESC"; 
} else {
    $sql_artikel = "SELECT * FROM artikel ORDER BY tanggal DESC";
}

$result_artikel = $conn->query($sql_artikel);

$sql_kategori = "SELECT * FROM kategori";
$result_kategori = $conn->query($sql_kategori);


$sql_berita_terbaru = "SELECT * FROM artikel ORDER BY tanggal DESC LIMIT 5";
$result_berita_terbaru = $conn->query($sql_berita_terbaru);

$sql_berita_terpopuler = "SELECT * FROM artikel ORDER BY view DESC LIMIT 5";
$result_berita_terpopuler = $conn->query($sql_berita_terpopuler);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>The Blog Nest</title>
</head>
<body>
    <header>
        <div class="container">
            <h1>The Blog Nest</h1>
            <nav>
                <ul>
                <li><a href="?semua=true">Semua</a></li>
                <?php
                    if ($result_kategori->num_rows > 0) {
                    while ($row = $result_kategori->fetch_assoc()) {
                        echo "<li><a href='?kategori=" . $row['id_kategori'] . "'>" . $row['nama_kategori'] . "</a></li>";
                        }
                    }
                ?>
                <button class="login" onclick="location.href='view/login.php';">Login</button>
                <button class="register" onclick="location.href='view/signUp.php';">Register</button>
                </ul>
            </nav>
        </div>
    </header>

    <section class="search-bar">
        <div class="container">
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </section>

    <aside class="sidebar">
            <div class="widget">
                <h3>Berita Terbaru</h3>
                <ul>
                    <?php
                    if ($result_berita_terbaru->num_rows > 0) {
                        while ($row = $result_berita_terbaru->fetch_assoc()) {
                            echo "<li><a href='view/view_artikel.php?id_artikel=" . $row['id_artikel'] . "'>" . $row['judul'] . "</a></li>";
                        }
                    } else {
                        echo "<li>Belum ada berita terbaru.</li>";
                    }
                    ?>
                </ul>
            </div>
            <div class="widget">
                <h3>Berita Terpopuler</h3>
                <ul>
                    <?php
                    if ($result_berita_terpopuler->num_rows > 0) {
                        while ($row = $result_berita_terpopuler->fetch_assoc()) {
                            echo "<li><a href='view/view_artikel.php?id_artikel=" . $row['id_artikel'] . "'>" . $row['judul'] . "</a></li>";
                        }
                    } else {
                        echo "<li>Belum ada berita terpopuler.</li>";
                    }
                    ?>
                </ul>
            </div>
    </aside>

    <section class="featured-post">
        <div class="container">
            <h2>Featured Post</h2>
            <br>
            <?php
            $max_characters = 250;

            if ($result_artikel->num_rows > 0) {
                while ($row = $result_artikel->fetch_assoc()) {
                    echo "<div class='post'>";
                    echo "<img src='assets/" . $row['foto'] . "' alt='Featured Post Image'>";
                    echo "<div class='post-content'>";
                    echo "<h3>" . $row['judul'] . "</h3>";
                    echo "<p class='post-meta'>Posted by " . $row['penulis'] . " | " . date('d/m/y H:i', strtotime($row['tanggal'])) . "</p>";
                    echo "<p class='post-meti'>Jumlah View " . $row['view'] . "</p>";
                    
                    $short_content = substr($row['isi_artikel'], 0, $max_characters);
                    $last_space = strrpos($short_content, ' ');
                    $short_content = substr($short_content, 0, $last_space) . '...';
                    echo "<p>" . $short_content . "</p>";
                    echo "<a href='view/view_artikel.php?id_artikel=" . $row['id_artikel'] . "' class='read-more'>Selengkapnya <i class='fas fa-arrow-right'></i></a>";
                    echo "</div>";
                    echo "</div>";
                }
                } else {
                    echo "Belum Terdapat Artikel Tentang Kategori ini.";
                }
            $conn->close();
            ?>
        </div>
    </section>
    
    <footer>
        <div class="container">
            <p>&copy; 2024 The Blog Nest. All Rights Reserved.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
