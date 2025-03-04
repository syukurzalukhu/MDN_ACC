<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TOKO MDNACC</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #ece9e6, #ffffff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            max-width: 900px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }
        .card-title {
            font-weight: bold;
            font-size: 1.2rem;
        }
        .btn-custom {
            font-size: 1rem;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }
        .btn-custom:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center text-primary mb-4">Dashboard TOKO MDNACC</h2>

        <div class="row g-4">
            <div class="col-md-12">
                <div class="card text-center p-3 bg-info text-white">
                    <i class="fa-solid fa-plus fa-3x mb-2"></i>
                    <h5 class="card-title">Tambah Data Produk</h5>
                    <a href="tambah_data.php" class="btn btn-light btn-custom">Tambah Data</a>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-6">
                <div class="card text-center p-3">
                    <i class="fa-solid fa-table fa-3x text-primary mb-2"></i>
                    <h5 class="card-title">Persamaan Tempered Glass</h5>
                    <a href="persamaan_tempered.php" class="btn btn-primary btn-custom">Lihat Data</a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card text-center p-3">
                    <i class="fa-solid fa-mobile fa-3x text-success mb-2"></i>
                    <h5 class="card-title">Persamaan Sarung</h5>
                    <a href="persamaan_sarung.php" class="btn btn-success btn-custom">Lihat Data</a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card text-center p-3">
                    <i class="fa-solid fa-door-open fa-3x text-warning mb-2"></i>
                    <h5 class="card-title">Persamaan Simdoor</h5>
                    <a href="persamaan_simdoor.php" class="btn btn-warning btn-custom">Lihat Data</a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card text-center p-3">
                    <i class="fa-solid fa-battery-full fa-3x text-danger mb-2"></i>
                    <h5 class="card-title">Persamaan Battery</h5>
                    <a href="persamaan_battery.php" class="btn btn-danger btn-custom">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
