<?php
session_start();
$conn = new mysqli("localhost", "root", "", "mdnacc_db");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Hash password sebelum disimpan
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $hashedPassword);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Registrasi berhasil! Silakan login.";
        header("Location: login.php");
    } else {
        $_SESSION['message'] = "Registrasi gagal! Username mungkin sudah terdaftar.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TOKO MDNACC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center text-success">Daftar</h2>

                    <!-- Pesan error/sukses -->
                    <?php if (!empty($_SESSION['message'])): ?>
                        <div class="alert alert-info"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Daftar</button>
                    </form>

                    <p class="text-center mt-3">
                        Sudah punya akun? <a href="login.php">Login di sini</a>
                    </p>

                    <a href="index.html" class="btn btn-secondary w-100 mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
