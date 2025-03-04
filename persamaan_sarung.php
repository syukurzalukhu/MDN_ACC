<?php
session_start();
$conn = new mysqli("localhost", "root", "", "mdnacc_db");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$search = "";
$query = "SELECT * FROM sarung_hp";

if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $query = "SELECT * FROM sarung_hp WHERE 
              tipe_hp LIKE '%$search%' OR 
              nama_sarung LIKE '%$search%' OR 
              persamaan LIKE '%$search%'";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persamaan Sarung - TOKO MDNACC</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background: #f8f9fa;
            font-size: 18px;
        }

        .container {
            max-width: 90%;
            margin-top: 20px;
        }

        .card {
            border-radius: 12px;
            padding: 30px;
            transition: 0.3s;
        }

        .card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .btn {
            font-size: 18px;
            padding: 12px 18px;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .table {
            font-size: 18px;
        }

        .table th, .table td {
            padding: 15px;
            text-align: center;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .form-control {
            font-size: 18px;
            padding: 10px;
        }

        h2 {
            font-size: 28px;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card shadow-lg">
                    <h2 class="text-center text-primary mb-4">Persamaan Sarung</h2>
                    
                    <div class="d-flex justify-content-end mb-4">
                        <form method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control me-2" placeholder="Cari..." value="<?= htmlspecialchars($search); ?>" style="width: 250px;">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Tipe HP</th>
                                    <th>Nama Sarung</th>
                                    <th>Persamaan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $row['tipe_hp']; ?></td>
                                    <td><?= $row['nama_produk']; ?></td>
                                    <td><?= $row['persamaan']; ?></td>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?= $row['id']; ?>&table=sarung_hp" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="delete.php?id=<?= $row['id']; ?>&table=sarung_hp" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
