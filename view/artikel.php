<?php
session_start();
include('function.php');

$conn = connectToDatabase();


$sql = "SELECT * FROM artikel ORDER BY id_artikel DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/artikel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>The Blog Nest | Artikel</title>
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
            <h1>List Artikel</h1>
            <p>Selamat datang di halaman List Artikel! Di sini, Anda dapat melihat daftar lengkap artikel yang terdaftar dalam sistem. Anda memiliki kontrol penuh untuk melakukan operasi Create, Read, Update, dan Delete (CRUD) terhadap artikel, yang memungkinkan Anda untuk mengelola artikel dengan mudah dan efisien. Silakan jelajahi daftar artikel di bawah ini dan gunakan fitur-fitur yang tersedia untuk mengelola informasi artikel dengan cepat dan tepat.</p>
        <div>
        <a href="tambah_artikel.php" class="button">Tambah Artikel</a>
        </div>

        <table class="user-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Isi Artikel</th>
                <th>Tanggal</th>
                <th>Penulis</th>
                <th>Foto</th>
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
            <td><?= $row['judul']; ?></td>
            <td><?= $row['isi_artikel']; ?></td>
            <td><?= date('d/m/y H:i' , strtotime($row['tanggal'])); ?></td>
            <td><?= $row['penulis']; ?></td>
            <td><img src="../assets/<?= $row['foto']; ?>" alt="Profil" class="foto_artikel"></td>
            <td class="actions">
                <a href="view_artikel.php?id_artikel=<?= $row['id_artikel']; ?>" title="View"><i class="fas fa-eye view-icon"></i></a> 
                <a href="edit_artikel.php?id_artikel=<?= $row['id_artikel']; ?>" title="Edit"><i class="fas fa-edit edit-icon"></i></a>
                <a href="delete_artikel.php?id_artikel=<?= $row['id_artikel']; ?>" title="Delete" onclick="return confirmDelete(<?= $row['id_artikel']; ?>)">
                    <i class="fas fa-trash-alt delete-icon"></i>
                </a>
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
    function confirmDelete(id_artikel) {
        Swal.fire({
            title: 'Apakah Anda yakin menghapus Artikel?',
            text: 'Tindakan ini tidak dapat dibatalkan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'delete_artikel.php?id_artikel=' + id_artikel;
            }
        });

        return false;
    }
    </script>
</body>
</html>