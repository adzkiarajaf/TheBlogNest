<?php 
include('function.php');

$conn = connectToDatabase();

$id_user = (int)$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addartikel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>The Blog Nest | Delete user</title>
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    if(delete_user($id_user) > 0 ) {
        echo "<script>  
                    Swal.fire({
                        icon: 'success',
                        title: 'User Berhasil Dihapus',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        document.location.href = 'user.php';
                    });
              </script>";
    }  else { 
        echo "<script>  
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'user Gagal Dihapus',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    document.location.href = 'user.php';
                });
            </script>";
    }
    ?>
</body>
</html>
