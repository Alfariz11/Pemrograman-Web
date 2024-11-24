<?php
$host = "localhost";  
$username = "root";   
$password = "";      
$dbname = "pendaftaran_db";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message'])) {
        echo "Semua field harus diisi!";
        exit;
    }

    if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];

        if ($fileSize > 2 * 1024 * 1024) {
            echo "Ukuran file tidak boleh lebih dari 2MB!";
            exit;
        }

        if ($fileType !== "text/plain") {
            echo "Hanya file teks yang diperbolehkan!";
            exit;
        }

        $fileContent = file_get_contents($fileTmpPath);
    } else {
        echo "Terjadi kesalahan saat mengupload file.";
        exit;
    }

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO pendaftaran (name, email, phone, message, file_content) 
            VALUES ('$name', '$email', '$phone', '$message', '$fileContent')";

    if ($conn->query($sql) === TRUE) {
        header("Location: result.php?name=" . urlencode($name) . "&email=" . urlencode($email) . "&phone=" . urlencode($phone) . "&message=" . urlencode($message) . "&fileContent=" . urlencode($fileContent));
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
