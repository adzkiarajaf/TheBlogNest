<?php
session_start();
include 'function.php';


$conn = connectToDatabase();


$sql = "SELECT * FROM user ORDER BY id DESC";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>The Blog Nest | Admin Dashboard</title>
</head>
<body>
    <div class="navbar">
        <ul><a href="admin.php">Dashboard</a>
        <a href="artikel.php" >Artikel</a>
        <a href="kategori.php">Kategori</a>
        <a href="user.php" class="active">User Management</a>
        <a href="../index.php">Home</a>
        </ul>
        
        <div class="dropdown">
            <button class="dropbtn">
                <i class="fa fa-user"><?= $_SESSION['user_username']; ?></i> 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="#">Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>
    <div class="container">
            <h1>List User - Admin & Penulis</h1>
            <p>Selamat datang di halaman List User! Di sini, Anda dapat melihat daftar lengkap pengguna yang terdaftar dalam sistem, termasuk pengguna dengan peran Admin dan Penulis. Anda memiliki kontrol penuh untuk melakukan operasi Create, Read, Update, dan Delete (CRUD) terhadap pengguna, yang memungkinkan Anda untuk mengelola pengguna dengan mudah dan efisien. Silakan jelajahi list User di bawah ini dan gunakan fitur-fitur yang tersedia untuk mengelola informasi pengguna dengan cepat dan tepat.</p>
            <table class="user-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jenis Kelamin</th>
                <th>Role</th>
                <th>Minat</th>
                <th>Biografi</th>
                <th>Foto Profil</th>
                <th>Aksi</th>
            </tr>
        </thead>
    <tbody>
    <?php 
        $i = 1;
        if ($result->num_rows > 0) {
        foreach ($result as $row) {
    ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $row['username']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['jeniskelamin']; ?></td>
            <td><?= $row['role']; ?></td>
            <td><?= $row['minat']; ?></td>
            <td><?= $row['bio']; ?></td>
            <td><img src="../assets/<?= $row['foto']; ?>" alt="Profil" class="user-photo"></td>
            <td class="actions">
            <a href="view_user.php?id=<?= $row['id']; ?>" title="View"><i class="fas fa-eye view-icon"></i></a> <!-- Tambahkan ikon "view" -->
                <a href="edit_user.php?id=<?= $row['id']; ?>" title="Edit"><i class="fas fa-edit edit-icon"></i></a>
                <a href="delete_user.php?id=<?= $row['id']; ?>" title="Delete" onclick="return confirmDelete(<?= $row['id']; ?>)"><i class="fas fa-trash-alt delete-icon"></i></a>
            </td>
        </tr>
    <?php 
    }
    } else {
        echo "<tr><td colspan='9'>Tidak ada data</td></tr>";
    }
    ?>
    </tbody>
    </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin menghapus User?',
            text: 'Tindakan ini tidak dapat dibatalkan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'delete_user.php?id=' + id;
            }
        });

        return false;
    }
    </script>
</body>
</html>