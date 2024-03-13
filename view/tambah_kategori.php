<?php
session_start();
include('function.php');

$conn = connectToDatabase();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addartikel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>The Blog Nest | Tambah Kategori</title>
</head>
<body>
    <div class="navbar">
        <ul><a href="admin.php">Dashboard</a>
        <a href="artikel.php" >Artikel</a>
        <a href="kategori.php" class="active">Kategori</a>
        <a href="user.php">User Management</a>
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
            <form action="" method="post" id="addartikel">
                <h1 class="title">Tambah Kategori</h1>
                </div> 
                <label for="Kategori">Kategori</label>
                <input type="text" name="nama_kategori" placeholder="Kategori" required>
                <input type="submit" value="Tambah Kategori" name="addkategori">
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    if(isset($_POST['addkategori'])) {
        if(create_kategori($_POST) > 0 ) { 
            echo "<script>  
                    Swal.fire({
                        icon: 'success',
                        title: 'Kategori Berhasil Ditambahkan',
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
                        text: 'Kategori Gagal Ditambahkan',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        document.location.href = 'kategori.php';
                    });
                  </script>";
        }
    }
    ?>
</body>
</html>