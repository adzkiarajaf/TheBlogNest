<?php 
include('view/function.php');

$conn = connectToDatabase();

$sql_artikel = "SELECT * FROM artikel ORDER BY tanggal DESC";
$result_artikel = $conn->query($sql_artikel);

$sql_kategori = "SELECT * FROM kategori";
$result_kategori = $conn->query($sql_kategori);
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
                <?php
                    if ($result_kategori->num_rows > 0) {
                    while ($row = $result_kategori->fetch_assoc()) {
                        echo "<li><a href='#'>" . $row['nama_kategori'] . "</a></li>";
                        }
                    }
                ?>
                <button class="login" onclick="location.href='view/login.php';">Login</button>
                <button class="register" onclick="location.href='view/signUp.php';">Register</button>
                </ul>
            </nav>
        </div>
    </header>

    <section class="featured-post">
        <div class="container">
            <h2>Featured Post</h2>
            <?php

            if ($result_artikel->num_rows > 0) {
                while ($row = $result_artikel->fetch_assoc()) {
                    echo "<div class='post'>";
                    echo "<img src='assets/" . $row['foto'] . "' alt='Featured Post Image'>";
                    echo "<div class='post-content'>";
                    echo "<h3>" . $row['judul'] . "</h3>";
                    echo "<p class='post-meta'>Posted by " . $row['penulis'] . " | " . date('F j, Y', strtotime($row['tanggal'])) . "</p>";
                    echo "<p>" . $row['isi_artikel'] . "</p>";
                    echo "<a href='#' class='read-more'>Read More <i class='fas fa-arrow-right'></i></a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "No featured post available.";
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
