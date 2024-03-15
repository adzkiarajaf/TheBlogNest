<?php
session_start();
include('function.php');

$conn = connectToDatabase();

$id_artikel = (int)$_GET['id_artikel'];

$user_role = "Penulis"; 
$_SESSION['user_role'] = $user_role;

$artikel_query = "SELECT * FROM artikel WHERE id_artikel = $id_artikel";
$result = mysqli_query($conn, $artikel_query);
$artikel = mysqli_fetch_assoc($result);

if(isset($_POST['editartikel'])) {
    if(edit_artikel($_POST) > 0 ) { 
        echo "<script>  
                alert('Artikel Berhasil Diubah');
                document.location.href = 'artikel.php';
              </script>";
    } else {
        echo "<script>  
                alert('Artikel Gagal Diubah');
                document.location.href = 'artikel.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addartikel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>The Blog Nest | Edit Artikel</title>
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
        <div class="form">
            <form action="" method="post" id="addartikel" enctype="multipart/form-data">
                <input type="hidden" class="type" name="id_artikel" value="<?= $artikel['id_artikel']?>">
                <h1 class="title">Edit Artikel</h1>
                </div> 
                <label for="judulartikel">Judul Artikel</label>
                <input type="text" name="judul"  value="<?= $artikel['judul']?>" required>
                <label for="isiartikel">Isi Artikel</label>
                <input type="text" name="isi_artikel" id="isi_artikel" value="<?= $artikel['isi_artikel']?>" required>
                <label for="tanggal">Tanggal</label>
                <input type="text" name="tanggal_artikel" id="tanggal_artikel" value="<?= $artikel['tanggal']?>" required disabled>
                <label for="fotoProfil">Foto Artikel</label>
                <input type="text" id="foto" name="foto" value="<?= $artikel['foto']?>" accept="image/*">
                <br>
                <input type="submit" value="Tambah Artikel" name="addartikel">
            </form>
        </div>
    </div>
</body>
</html>