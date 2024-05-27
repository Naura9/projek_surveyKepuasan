<?php
session_start();
include '../Koneksi.php';


if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit(); // Pastikan untuk keluar dari skrip setelah redirect
}

// Ambil nilai username dan role dari sesi
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$nama = $_SESSION['nama'];


// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah id telah diterima
    if(isset($_POST['id'])) {
        $id = $_POST['id'];

        // Jika tombol delete diklik

        // Jika tombol status diklik
        if(isset($_POST['status'])) {
            $status = $_POST['status'];

            // Lakukan sanitasi input sebelum query
            $status = mysqli_real_escape_string($kon, $status);
            $id = intval($id); // Pastikan id adalah integer

            // Lakukan query untuk memperbarui status
            $query = "UPDATE m_registrasi SET status='$status' WHERE id=$id";

            if(mysqli_query($kon, $query)) {
                // Tampilkan pesan sukses atau lakukan tindakan lain yang diperlukan
                // echo "Status berhasil diperbarui.";
            } else {
                // echo "Gagal memperbarui status: " . mysqli_error($kon);
            }
        }
        $delete_query = "DELETE FROM m_registrasi WHERE id=$id";
        if(mysqli_query($kon, $delete_query)) {
            // echo "Status berhasil diperbarui dan entri dihapus.";
        } else {
            // echo "Gagal memperbarui status atau menghapus entri: " . mysqli_error($kon);
        }
    }
}

// Query untuk mengambil data dari m_registrasi
$query = "SELECT * FROM m_registrasi";
$result = mysqli_query($kon, $query);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96cfbc074b.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="../header.css">

    <style>

        h2{
            font-weight: bold;
        }

        table {
            width: 50px;
            border-radius: 10px;
            margin-right: 100px;
        }

        .table th {
            width: 10px;
            padding-top: 15px;
            width: 10px;
        }

        .fa-regular.fa-circle-xmark {
            color: #E87818;
            margin-right: 15px;
            font-size: 20px;
        }

        .fa-regular.fa-circle-check {
            color: #2D1B6B;
            font-size: 20px;
        }
        
        .btn-circle {
            border: none;
            background: none;
            padding: 0;
            font-size: inherit;
            cursor: pointer;
        }

        .message {
                width: 5px;
                margin-left: 885px
        }

        .content {
            height: 630px;
        }
    </style>
</head>
<body>
<?php include 'Header.php'; ?>
    <section>
        <div class="content">
        <h2>Permintaan User</h2>
            <div style="margin-right: 50px;">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($result)) {                
                        ?>
                        <tr>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['role']; ?></td>
                            <td>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="status" value="declined" class="btn-circle delete-btn"><i class="fa-regular fa-circle-xmark"></i></button>
                                    <button type="submit" name="status" value="accepted" class="btn-circle accept-btn"><i class="fa-regular fa-circle-check"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>
