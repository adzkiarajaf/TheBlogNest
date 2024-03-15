<?php
function connectToDatabase()
{
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "theblognest";
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    return $conn;
}


function login($conn, $username, $password)
{
    $err = "";

    if ($username == '' or $password == '') {
        $err = "<li>Silahkan Masukan Username dan Password</li>";
    } else {
        $sql = "SELECT * FROM user WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            $err = "<li>Akun tidak ditemukan</li>";
        } else {
            $row = $result->fetch_assoc();
            if (!password_verify($password, $row['password'])) {
                $err = "<li>Password salah</li>";
            } else {
                $_SESSION['user_username'] = $username;
                if ($row['role'] == 'Admin') {
                    $_SESSION['log'] = 'Logged';
                    $_SESSION['role'] = 'Admin';
                    header('location:admin.php');
                    exit();
                } else {
                    $_SESSION['log'] = 'Logged';
                    $_SESSION['role'] = 'Penulis';
                    header('location:penulis.php');
                    exit();
                }
            }
        }
    }

    return $err;
}

function upload_file() {
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];
   
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile = explode('.', $namaFile);
    $extensifile = strtolower(end($extensifile));
    if (!in_array($extensifile, $extensifileValid)) {
        echo "<script>  
                alert('Format File Tidak Valid');
              </script>";
        die();
    }
    if ($ukuranFile > 2048000) {
        echo "<script>  
                alert('Ukuran File Max 2MB');
              </script>";
        die();
    }
    $namaFileBaru = uniqid() . '.' . $extensifile;
    if (!move_uploaded_file($tmpName, '../assets/' . $namaFileBaru)) {
        echo "<script>  
                alert('Gagal mengunggah file. Silakan coba lagi.');
              </script>";
        die();
    }

    return $namaFileBaru;
}

// user
function create_user($conn) {
    $error = ""; 
    
    $namaLengkap = $_POST['NamaLengkap'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $jenisKelamin = $_POST['JenisKelamin'];
    $role = $_POST['Role'];
    $minatTopik = isset($_POST['MinatTopik']) ? $_POST['MinatTopik'] : NULL;
    $biografi = isset($_POST['Biografi']) ? $_POST['Biografi'] : NULL;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($password !== $confirmPassword) {
        $error .= "<li>Konfirmasi password tidak sesuai dengan password yang dimasukkan.</li>";
    }
    
    $checkUsernameQuery = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($checkUsernameQuery);
    if ($result->num_rows > 0) {
        $error .= "<li>Username sudah digunakan. Silakan gunakan username yang lain.</li>";
    }
    
    $foto = upload_file();
    if  (!$foto){ 
        return false;
    }


    $sql = "INSERT INTO user (namalengkap, username, email, password, jeniskelamin, role, minat, bio, foto)
            VALUES ('$namaLengkap', '$username','$email', '$hashedPassword', '$jenisKelamin', '$role', '$minatTopik', '$biografi', '$foto')";

    if ($conn->query($sql) === TRUE) {
        $error = "<p>User baru berhasil ditambahkan</p>";
    } else {
        $error = "<p>Error: " . $sql . "<br></p>" . $conn->error;
    }
    return $error;
}

function edit_user($post) { 
    global $conn;

    $namaLengkap = $_POST['NamaLengkap'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $jenisKelamin = $_POST['JenisKelamin'];
    $role = $_POST['Role'];
    $minatTopik = isset($_POST['MinatTopik']) ? $_POST['MinatTopik'] : NULL;
    $biografi = isset($_POST['Biografi']) ? $_POST['Biografi'] : NULL;
    $foto = $_POST['foto'];

    $query = "UPDATE user SET username = '$namaLengkap',  email = '$email', password  = '$password'), JenisKelamin = '$jenisKelamin', role = $role, minat = $minatTopik, bio = $biografi, foto = $foto";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function delete_user($id_user){ 
    global $conn;

    $query = "DELETE from user WHERE id = $id_user";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
// user


// artikel
function create_artikel($post, $kategori_id) {
    global $conn; 

    // Escape input data
    $judul = mysqli_real_escape_string($conn, $post['judul']); 
    $isi = mysqli_real_escape_string($conn, $post['isi_artikel']); 
    $foto = upload_file(); 
    $penulis = $_SESSION['user_username']; 

    
    $query = "INSERT INTO artikel (judul, isi_artikel, tanggal, foto, penulis, id_kategori) VALUES ('$judul', '$isi', CURRENT_TIMESTAMP(), '$foto', '$penulis', '$kategori_id')";

    
    mysqli_query($conn, $query);

   
    return mysqli_affected_rows($conn);
}

function edit_artikel($post) { 
    global $conn; 

    $nama = $post['judul'];
    $isi = $post['isi_artikel'];
    $nama_file = $_FILES['foto_artikel']['name'];

    $query = "UPDATE artikel SET judul = '$nama',  isi_artikel = '$isi', foto_artikel = '$nama_file')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete_artikel($id_artikel) { 
    global $conn;

    $query = "DELETE from artikel WHERE id_artikel = $id_artikel";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
// artikel

// kategori
function create_kategori($post){ 
    global $conn; 

    $nama = $post['nama_kategori'];
    
    $query = "INSERT INTO kategori VALUES(null, '$nama')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function edit_kategori($post) { 
    global $conn;

    $id_kategori = $post['id_kategori']; 
    $nama = $post['nama_kategori'];
    
    $query = "UPDATE kategori SET nama_kategori = '$nama' WHERE id_kategori = $id_kategori";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete_kategori($id_kategori) { 
    global $conn;

    $query = "DELETE from kategori WHERE id_kategori = $id_kategori";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
// kategori

//dashboard
function TotalArtikel() {
    global $conn; 
    $sql = "SELECT COUNT(*) AS total_artikel FROM artikel";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total_artikel'];
    } else {
        return 0;
    }
}

function RecentPost() {
    global $conn; 
    $sql_recent_posts = "SELECT judul, tanggal FROM artikel ORDER BY tanggal DESC LIMIT 1";
    $result_recent_posts = $conn->query($sql_recent_posts);

    if ($result_recent_posts->num_rows > 0) {
        $row_recent_post = $result_recent_posts->fetch_assoc();
        return $row_recent_post;
    } else {
        return array("judul" => "Tidak ada artikel terbaru", "tanggal" => "");
    }
}

function TotalUsers() {
    global $conn; 
    $sql = "SELECT COUNT(*) AS total_users FROM user"; 
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total_users'];
    } else {
        return 0;
    }
}

function PenulisArtikelData() {
    $conn = connectToDatabase();

    
    $sql_penulis_artikel = "SELECT penulis, COUNT(*) AS jumlah_artikel FROM artikel WHERE penulis IS NOT NULL GROUP BY penulis";
    $result_penulis_artikel = $conn->query($sql_penulis_artikel);

    $data = [];

    
    if ($result_penulis_artikel->num_rows > 0) {
        while ($row = $result_penulis_artikel->fetch_assoc()) {
            $data[] = [
                'penulis' => $row['penulis'],
                'jumlah_artikel' => $row['jumlah_artikel']
            ];
        }
    }

    return $data;
}

?>