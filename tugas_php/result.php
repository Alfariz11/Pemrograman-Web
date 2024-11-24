<?php
$host = "localhost";
$username = "root"; 
$password = "";      
$dbname = "pendaftaran_db"; 

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM pendaftaran";
$result = $conn->query($sql);

echo "<h2>Data Pendaftaran dan Informasi Browser</h2>";

if ($result->num_rows > 0) {
    echo "<table border='1' style='width: 100%; margin-top: 20px; border-collapse: collapse;'>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Pesan</th>
                <th>Isi File (Text)</th>
                <th>Browser/Sistem Operasi</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {

        $file_content = isset($row['file_content']) ? $row['file_content'] : 'Tidak ada konten';

        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['phone'] . "</td>
                <td>" . $row['message'] . "</td>
                <td><pre>" . htmlspecialchars($file_content) . "</pre></td>  <!-- Menampilkan isi file -->
                <td>" . htmlspecialchars($user_agent) . "</td>  <!-- Menampilkan User-Agent -->
              </tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data yang ditemukan.";
}

$conn->close();
?>
