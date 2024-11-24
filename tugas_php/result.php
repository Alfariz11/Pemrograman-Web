<?php
// Koneksi ke database
$host = "localhost";
$username = "root";  // Username default untuk XAMPP
$password = "";      // Password default untuk XAMPP
$dbname = "pendaftaran_db"; // Nama database yang sudah kamu buat

$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil semua data dari tabel 'pendaftaran'
$sql = "SELECT * FROM pendaftaran";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' style='width: 100%; margin-top: 20px; border-collapse: collapse;'>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Pesan</th>
                <th>Isi File</th>
            </tr>";

    // Loop untuk menampilkan setiap baris data
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['phone'] . "</td>
                <td>" . $row['message'] . "</td>
                <td><pre>" . htmlspecialchars($row['file_content']) . "</pre></td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data yang ditemukan.";
}

$conn->close();
?>
