<?php
session_start();
include('function.php');

$conn = connectToDatabase();

$id_user = (int)$_GET['id'];

$user_query = "SELECT * FROM user WHERE id = $id_user";
$result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addartikel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>The Blog Nest | View User</title>
</head>
<body>
    <div class="navbar">
        <ul>
        <a href="admin.php">Dashboard</a>
        <a href="artikel.php" >Artikel</a>
        <a href="kategori.php" >Kategori</a>
        <a href="user.php" class="active">User Management</a>
        <a href="../index.php" class="active">Home</a>
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
            <form action="" method="post" id="edituser">
                <input type="hidden" class="type" name="id_user" value="<?= $user['id']?>">
                <h1 class="title">Edit user</h1>
                </div> 
                <label for="namalengkap">Nama Lengkap</label>
                <input type="text" name="namalengkap" value="<?= $user['namalengkap']?>"required>
                <label for="username">Username</label>
                <input type="text" name="username" value="<?= $user['username']?>"required>
                <label for="email">Email</label>
                <input type="text" name="email" value="<?= $user['email']?>"required>
                <label for="password">Password</label>
                <input type="text" name="password" value="<?= $user['password']?>"required disabled>
                <label for="JenisKelamin">Jenis Kelamin</label>
                <input type="text" name="JenisKelamin" value="<?= $user['jeniskelamin']?>"required>
                <label for="role">Role</label>
                <input type="text" name="Role" value="<?= $user['role']?>"required>
                <label for="minat">Minat</label>
                <input type="text" name="minat" value="<?= $user['minat']?>"required>
                <label for="bio">Biografi</label>
                <input type="text" name="bio" value="<?= $user['bio']?>"required>
                <label for="user">Foto</label>
                <input type="file" name="foto" id="fotoInput">
                <img id="fotoPreview" src="../assets/<?= $user['foto'] ?>" alt="Foto Profil" width="500">
                <!-- <input type="submit" value="Edit user" name="edituser"> -->
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php 
    if(isset($_POST['edituser'])) {
        if(edit_user($_POST) > 0 ) { 
            echo "<script>  
            Swal.fire({
            icon: 'success',
            title: 'User Berhasil Diubah',
            showConfirmButton: false,
            timer: 1500
            }).then(() => {
            document.location.href = 'user.php';
            });
            </script>";
    } else {
        echo "<script>  
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'User Gagal Diubah',
            showConfirmButton: false,
            timer: 1500
            }).then(() => {
            document.location.href = 'user.php';
            });
            </script>";
    };
}
    ?>
</body>
</html>