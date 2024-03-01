<?php
session_start();
include('function.php');

$conn = connectToDatabase();

$id_kategori = (int)$_GET['id_kategori'];

$kategori_query = "SELECT * FROM kategori WHERE id_kategori = $id_kategori";
$result = mysqli_query($conn, $kategori_query);
$kategori = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addartikel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>The Blog Nest | Edit Kategori</title>
</head>
<body>
    <div class="navbar">
        <ul><a href="admin.php">Dashboard</a>
        <a href="artikel.php" >Artikel</a>
        <a href="kategori.php" class="active">Kategori</a>
        <a href="user.php">User Management</a>
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
            <form action="" method="post" id="editkategori">
                <input type="hidden" class="type" name="id_kategori" value="<?= $kategori['id_kategori']?>">
                <h1 class="title">Edit Kategori</h1>
                </div> 
                <label for="Kategori">Kategori</label>
                <input type="text" name="nama_kategori" value="<?= $kategori['nama_kategori']?>" placeholder="Kategori" required>
                <input type="submit" value="Edit Kategori" name="editkategori">
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php 
    if(isset($_POST['editkategori'])) {
        if(edit_kategori($_POST) > 0 ) { 
            echo "<script>  
            Swal.fire({
            icon: 'success',
            title: 'Kategori Berhasil Diubah',
            showConfirmButton: false,
            timer: 1500
            }).then(() => {
            document.location.href = 'kategori.php';
            });
            </script>";
    } else {
        echo "<script>  
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Kategori Gagal Diubah',
            showConfirmButton: false,
            timer: 1500
            }).then(() => {
            document.location.href = 'kategori.php';
            });
            </script>";
    };
}
    ?>
</body>
</html>