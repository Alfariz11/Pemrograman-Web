<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Pendaftaran</h1>
    <form id="registrationForm" action="process.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="phone">No. Telepon:</label>
        <input type="text" id="phone" name="phone" required>
        
        <label for="message">Pesan:</label>
        <textarea id="message" name="message" rows="4" required></textarea>
        
        <label for="file">Upload File (teks):</label>
        <input type="file" id="file" name="file" accept=".txt" required>
        
        <input type="submit" value="Daftar">
    </form>

    <script>
        function validateForm() {
            var fileInput = document.getElementById('file');
            var file = fileInput.files[0];
            
            // Validasi file upload
            if (file) {
                var fileSize = file.size / 1024 / 1024; // dalam MB
                if (fileSize > 2) {
                    alert("Ukuran file tidak boleh lebih dari 2MB");
                    return false;
                }
                var fileType = file.type;
                if (fileType !== "text/plain") {
                    alert("Hanya file teks yang diperbolehkan");
                    return false;
                }
            }
            
            // Validasi input teks
            var name = document.getElementById('name').value;
            if (name.length < 3) {
                alert("Nama harus lebih dari 2 karakter");
                return false;
            }
            return true;
        }
    </script>

</body>
</html>
