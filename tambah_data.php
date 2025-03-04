<?php
session_start();
$conn = new mysqli("localhost", "root", "", "mdnacc_db");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah form disubmit
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategori = $_POST['kategori'];
    $tipe_hp = $_POST['tipe_hp'];
    $nama_produk = $_POST['nama_produk'];
    $persamaan = $_POST['persamaan'];

    // Tentukan tabel berdasarkan kategori
    $table_name = "";
    switch ($kategori) {
        case "tempered":
            $table_name = "tempered_glass";
            break;
        case "battery":
            $table_name = "battery";
            break;
        case "simdoor":
            $table_name = "simdoor";
            break;
        case "sarung":
            $table_name = "sarung_hp";
            break;
        default:
            die("Kategori tidak valid.");
    }

    // Query untuk insert data
    $query = "INSERT INTO $table_name (tipe_hp, nama_produk, persamaan) VALUES ('$tipe_hp', '$nama_produk', '$persamaan')";

    if ($conn->query($query) === TRUE) {
        $message = "Data berhasil ditambahkan!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Produk</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center text-primary">Tambah Data Produk</h2>
                    
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-success" role="alert">
                            <?= $message; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori Produk:</label>
                            <select name="kategori" class="form-select" required>
                                <option value="tempered">Tempered Glass</option>
                                <option value="battery">Battery</option>
                                <option value="simdoor">Simdoor</option>
                                <option value="sarung">Sarung HP</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tipe_hp" class="form-label">Tipe HP:</label>
                            <input type="text" name="tipe_hp" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk:</label>
                            <input type="text" name="nama_produk" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="persamaan" class="form-label">Persamaan:</label>
                            <input type="text" name="persamaan" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </form>

                    <a href="dashboard.php" class="btn btn-secondary mt-3 w-100">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
