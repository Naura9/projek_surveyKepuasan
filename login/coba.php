<?php
// Mulai session
session_start();

// Pesan untuk ditampilkan
$message = '';

// Handle form submission for Mahasiswa
if (isset($_POST['submit_mahasiswa']) && $_SESSION['role'] === 'Mahasiswa') {
    // Cek apakah session 'nama' telah diatur
    if(isset($_SESSION['nama'])) {
        $message = "Nilai dari session 'nama': " . $_SESSION['nama'];
    } else {
        $message = "Session 'nama' belum diatur.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        .container {
            text-align: center;
        }

        .session-message {
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register Form</h2>
        <!-- Tampilkan pesan session 'nama' di sini -->
        <div class="session-message"><?php echo $message; ?></div>
        <form action="submit_mahasiswa" method="post">
            <!-- Tambahkan input untuk form Mahasiswa di sini -->
            <label for="nim">NIM:</label>
            <input type="text" id="nim" name="nim" required>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>
            <label for="prodi">Program Studi:</label>
            <input type="text" id="prodi" name="prodi" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="hp">Nomor HP:</label>
            <input type="text" id="hp" name="hp" required>
            <label for="tahun_masuk">Tahun Masuk:</label>
            <input type="text" id="tahun_masuk" name="tahun_masuk" required>
            <!-- Tombol submit untuk form Mahasiswa -->
            <button type="submit" name="submit_mahasiswa">Submit</button>
        </form>
    </div>
</body>
</html>
