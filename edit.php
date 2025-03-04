<?php
session_start();
$conn = new mysqli("localhost", "root", "", "mdnacc_db");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Pastikan parameter id dan tabel ada
if (!isset($_GET['id']) || !isset($_GET['table'])) {
    die("Parameter tidak lengkap!");
}

$id = (int) $_GET['id']; // Pastikan id adalah integer
$table = $_GET['table']; // Nama tabel dari parameter URL
$allowed_tables = ['battery', 'sarung_hp', 'simdoor', 'tempered_glass'];

// Validasi agar hanya bisa mengakses tabel yang diizinkan
if (!in_array($table, $allowed_tables)) {
    die("Tabel tidak valid!");
}

$query = "SELECT * FROM `$table` WHERE id=$id";
$result = $conn->query($query);
$data = $result->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipe_hp = $conn->real_escape_string($_POST['tipe_hp']);
    $nama_produk = $conn->real_escape_string($_POST['nama_produk']);
    $persamaan = $conn->real_escape_string($_POST['persamaan']);

    $update_query = "UPDATE `$table` SET tipe_hp='$tipe_hp', nama_produk='$nama_produk', persamaan='$persamaan' WHERE id=$id";
    if ($conn->query($update_query) === TRUE) {
        header("Location: dashboard.php?table=$table");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Data</h2>
        <form action="" method="POST">
            <label>Tipe HP</label>
            <input type="text" name="tipe_hp" value="<?= htmlspecialchars($data['tipe_hp']); ?>" required>

            <label>Nama Produk</label>
            <input type="text" name="nama_produk" value="<?= htmlspecialchars($data['nama_produk']); ?>" required>

            <label>Persamaan</label>
            <input type="text" name="persamaan" value="<?= htmlspecialchars($data['persamaan']); ?>" required>

            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>