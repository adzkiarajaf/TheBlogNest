<?php 
include('function.php');

$conn = connectToDatabase();

$id_artikel = (int)$_GET['id_artikel'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addartikel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>The Blog Nest | Delete Artikel</title>
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    if(delete_artikel($id_artikel) > 0 ) {
        echo "<script>  
                    Swal.fire({
                        icon: 'success',
                        title: 'Artikel Berhasil Dihapus',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        document.location.href = 'artikel.php';
                    });
              </script>";
    }  else { 
        echo "<script>  
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'artikel Gagal Dihapus',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    document.location.href = 'artikel.php';
                });
            </script>";
    }
    ?>
</body>
</html>
