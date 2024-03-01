<?php
session_start();

require_once('function.php');

$conn = connectToDatabase();

$err = "";

if (isset($_POST['Login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $err = login($conn, $username, $password);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&display=swap">
    <title>The Blog Nest | Login</title>
</head>
<body>
<div class="form">
    <div class="logo">
        <img src="../assets/lg.png" alt="Logo">
    </div>
    <h1 class="title">Login</h1>
    <div class="error-message">
        <?php
        if ($err) {
            echo "<ul>$err</ul>";
        }
        ?>
    </div>
    <form action="" method="post">
        <label for="nama">Username</label>
        <input type="text" name="username" value="<?php echo isset($username) ? $username : ''; ?>" placeholder="Nama">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password">
        <h4 class="title">Belum mempunyai akun?</h4>
        <a href="signup.php" class="signup-link">Daftar Disini!</a>
        <input type="submit" value="Login" name="Login">
    </form>
</div>
<div class="overlay"></div>
</body>
</html>
