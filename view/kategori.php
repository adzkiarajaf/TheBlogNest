<?php
session_start();
include('function.php');

$conn = connectToDatabase();


$sql = "SELECT * FROM kategori ORDER BY id_kategori DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/artikel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>The Blog Nest | Kategori</title>
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
            <h1>List Kategori </h1>
            <p>Selamat datang di halaman List Kategori! Di sini, Anda dapat melihat daftar lengkap kategori yang tersedia dalam sistem. Anda memiliki kontrol penuh untuk melakukan operasi Create, Read, Update, dan Delete (CRUD) terhadap kategori, yang memungkinkan Anda untuk mengelola kategori dengan mudah dan efisien. Silakan jelajahi daftar kategori di bawah ini dan gunakan fitur-fitur yang tersedia untuk mengelola informasi kategori dengan cepat dan tepat.</p>
        <div>
        <a href="tambah_kategori.php" class="button">Tambah Kategori</a>
        </div>

        <table class="user-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
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
            <td><?= $row['nama_kategori']; ?></td>
            <td class="actions">
                <a href="view_kategori.php?id_kategori=<?= $row['id_kategori']; ?>" title="View"><i class="fas fa-eye view-icon"></i></a>
                <a href="edit_kategori.php?id_kategori=<?= $row['id_kategori']; ?>" title="Edit"><i class="fas fa-edit edit-icon"></i></a>
                <a href="delete_kategori.php?id_kategori=<?= $row['id_kategori']; ?>" title="Delete" onclick="return confirmDelete(<?= $row['id_kategori']; ?>)"><i class="fas fa-trash-alt delete-icon"></i></a>
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
    function confirmDelete(id_kategori) {
        Swal.fire({
            title: 'Apakah Anda yakin menghapus Kategori?',
            text: 'Tindakan ini tidak dapat dibatalkan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'delete_kategori.php?id_kategori=' + id_kategori;
            }
        });

        return false;
    }
    </script>
</body>
</html>