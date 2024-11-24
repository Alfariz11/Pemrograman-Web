<?php
// Koneksi ke database
$host = "localhost";  
$username = "root";   
$password = "";      
$dbname = "pendaftaran_db";

$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input teks
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message'])) {
        echo "Semua field harus diisi!";
        exit;
    }

    // Validasi file upload
    if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];

        // Validasi ukuran file
        if ($fileSize > 2 * 1024 * 1024) {
            echo "Ukuran file tidak boleh lebih dari 2MB!";
            exit;
        }

        // Validasi tipe file
        if ($fileType !== "text/plain") {
            echo "Hanya file teks yang diperbolehkan!";
            exit;
        }

        // Baca isi file
        $fileContent = file_get_contents($fileTmpPath);
    } else {
        echo "Terjadi kesalahan saat mengupload file.";
        exit;
    }

    // Menyimpan data ke database
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO pendaftaran (name, email, phone, message, file_content) 
            VALUES ('$name', '$email', '$phone', '$message', '$fileContent')";

    if ($conn->query($sql) === TRUE) {
        // Arahkan ke halaman result.php setelah data berhasil disimpan
        header("Location: result.php?name=" . urlencode($name) . "&email=" . urlencode($email) . "&phone=" . urlencode($phone) . "&message=" . urlencode($message) . "&fileContent=" . urlencode($fileContent));
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Menutup koneksi
    $conn->close();
}
?>
