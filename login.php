<?php
session_start();
$conn = new mysqli("localhost", "root", "", "mdnacc_db");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Query untuk mendapatkan data user dari database
    $query = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password']; // Ambil password dari database

        // Cek apakah password cocok (langsung cocokkan jika password TIDAK di-hash)
        if ($password === $hashedPassword) { 
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['message'] = "Password salah!";
        }
    } else {
        $_SESSION['message'] = "Username tidak ditemukan!";
    }

    $stmt->close();
    $conn->close();

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script>
    setTimeout(() => {
        let alertBox = document.querySelector(".alert");
        if (alertBox) alertBox.style.display = "none";
    }, 5000);
    </script>

</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center text-primary">Login</h2>

                    <!-- Pesan error -->
                    <?php if (!empty($_SESSION['message'])): ?>
                        <div class="alert alert-danger"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
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

                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>

                    <a href="index.php" class="btn btn-secondary w-100 mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
