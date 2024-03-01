<?php
require_once('function.php');

$conn = connectToDatabase();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = create_user($conn);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signUp.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&display=swap">

    <title>The Blog Nest | Sign Up </title>
</head>
<body>
    <div class="form">
        <form action="" method="post" id="signupForm" enctype="multipart/form-data">
            <div class="logo">
                <img src="../assets/lg.png" alt="Logo">
            </div>
            <h1 class="title">Sign Up</h1>
            <div class="error-message">
                <?php
                if ($error) {
                    echo "<ul>$error</ul>";
                }
                ?>
            </div>
            <label for="NamaLengkap">Nama Lengkap</label>
            <input type="text" name="NamaLengkap" placeholder="Masukan Nama Lengkap" required>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" required>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" required>
            <label for="confirmPassword">Konfirmasi Password</label>
            <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
            <label for="JenisKelamin">Jenis Kelamin:</label>
            <select id="JenisKelamin" name="JenisKelamin" required>
                <option value="---">------</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <label for="Role">Role:</label>
            <select id="Role" name="Role" required>
                <option value="---">------</option>
                <option value="Admin">Admin</option>
                <option value="Penulis">Penulis</option>
            </select>
            <label for="MinatTopik" id="minatTopikLabel">Minat Topik</label>
            <input type="text" name="MinatTopik" id="MinatTopik" placeholder="Minat Topik">
            <label for="Biografi" id="biografiLabel">Biografi Singkat</label>
            <input type="text" name="Biografi" id="Biografi" placeholder="Biografi Singkat">
            <label for="foto">Foto Profil:</label>
            <input type="file" id="foto" name="foto">
            <br>
            <div class="checkbox-container">
                <input type="checkbox" id="persetujuan" name="persetujuan">
                <label for="persetujuan">Apakah Kamu Sudah Setuju dengan data yang diisikan?</label>
            </div>
            <input type="submit" value="Sign Up" name="Sign Up">
        </form>
        <a href="login.php" id="login-link" class="login-link">Kembali Login</a>
    </div>
    
    <div class="overlay"></div>

    <script>
        document.getElementById("Role").addEventListener("change", function() {
            var role = this.value;
            var minatTopikInput = document.getElementById("MinatTopik");
            var biografiInput = document.getElementById("Biografi");
            var minatTopikLabel = document.getElementById("minatTopikLabel");
            var biografiLabel = document.getElementById("biografiLabel");

            if (role === "Admin") {
                minatTopikInput.disabled = true;
                biografiInput.disabled = true;
                minatTopikLabel.style.opacity = "0.5";
                biografiLabel.style.opacity = "0.5";
            } else {
                minatTopikInput.removeAttribute('disabled');
                biografiInput.removeAttribute('disabled');
                minatTopikLabel.style.display = "block";
                biografiLabel.style.display = "block";
            }
        });
    </script>
</body>
</html>
