<?php
session_start();
$conn = new mysqli("localhost", "root", "", "mdnacc_db");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$search = "";
$query = "SELECT * FROM simdoor";

if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $query = "SELECT * FROM simdoor WHERE tipe_hp LIKE '%$search%' OR nama_produk LIKE '%$search%' OR persamaan LIKE '%$search%'";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persamaan Simdoor - TOKO MDNACC</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Persamaan Simdoor</h2>
        
        <!-- Form Pencarian -->
        <form method="GET" class="search-form">
            <input type="text" name="search" placeholder="Cari tipe HP, nama produk, atau persamaan..." value="<?= htmlspecialchars($search); ?>">
            <button type="submit">Cari</button>
        </form>

        <!-- Tabel Data -->
        <table>
            <thead>
                <tr>
                    <th>Tipe HP</th>
                    <th>Nama Simdoor</th>
                    <th>Persamaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['tipe_hp']; ?></td>
                    <td><?= $row['nama_produk']; ?></td>
                    <td><?= $row['persamaan']; ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>&table=simdoor" class="edit">Edit</a>
                        <a href="delete.php?id=<?= $row['id']; ?>&table=simdoor" class="delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
