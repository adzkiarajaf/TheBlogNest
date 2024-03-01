<?php
session_start();
include('function.php');

$conn = connectToDatabase();

// if(isset($_POST['addartikel'])) {
//     if(create_artikel($_POST) > 0 ) { 
//         echo "<script>  
//                 alert('Artikel Berhasil Ditambahkan');
//                 document.location.href = 'artikel.php';
//               </script>";
//     } else {
//         echo "<script>  
//                 alert('Artikel Gagal Ditambahkan');
//                 document.location.href = 'artikel.php';
//               </script>";
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addartikel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>The Blog Nest | Tambah Artikel</title>
</head>
<body>
    <div class="navbar">
        <ul><a href="admin.php">Dashboard</a>
        <a href="artikel.php" class="active">Artikel</a>
        <a href="kategori.php">Kategori</a>
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
            <form action="" method="post" id="addartikel" enctype="multipart/form-data">
                <h1 class="title">Tambah Artikel</h1>
                </div> 
                <label for="judulartikel">Judul Artikel</label>
                <input type="text" name="judul" placeholder="Judul Artikel" required>
                <label for="isiartikel">Isi Artikel</label>
                <input type="text" name="isi_artikel" id="isi_artikel" placeholder="Isi Artikel" required>
                <label for="foto">Foto Artikel</label>
                <input type="file" id="foto" name="foto" placeholder="Foto Artikel">
                <br>
                <input type="submit" value="Tambah Artikel" name="addartikel">
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php 
    if(isset($_POST['addartikel'])) {
        $post = $_POST;
        $file = $_FILES['foto'];    
        $post['foto'] = $file;
        if(create_artikel($post) > 0 ) { 
            echo "<script>  
                Swal.fire({
                icon: 'success',
                title: 'Artikel Berhasil Ditambahkan',
                showConfirmButton: false,
                timer: 1500
                }).then(() => {
                document.location.href = 'artikel.php';
                });
                </script>";
        } else {
            echo "<script>  
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Artikel Gagal Ditambahkan',
                showConfirmButton: false,
                timer: 1500
                }).then(() => {
                document.location.href = 'artikel.php';
                });
                </script>";
        }
    }
    ?>
</body>
</html>