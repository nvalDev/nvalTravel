<?php



$host = 'localhost';
$username = 'root';  // Biasanya 'root' untuk XAMPP
$password = '';      // Biasanya kosong untuk XAMPP
$database = 'Travel';  // Ganti dengan nama database Anda yang sebenarnya

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Impor file koneksi database
require_once '../config.php';

function getDestinasi($conn) {
    $sql = "SELECT * FROM destinasi";
    $result = $conn->query($sql);
    if ($result === false) {
        die("Error in query: " . $conn->error);
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Pastikan $conn tersedia sebelum memanggil fungsi
if (!isset($conn)) {
    die("Koneksi database tidak tersedia.");
}

$destinasi_list = getDestinasi($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Destinasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2ecc71;
            --secondary-color: #27ae60;
            --light-color: #e8f5e9;
        }
        body {
            background-color: var(--light-color);
        }
        .navbar {
            background-color: var(--primary-color) !important;
        }
        .navbar-light .navbar-brand,
        .navbar-light .navbar-nav .nav-link {
            color: white !important;
        }
        .navbar-light .navbar-nav .nav-link:hover {
            color: var(--light-color) !important;
        }
        h1 {
            color: var(--secondary-color);
        }
        .table-custom {
            background-color: white;
        }
        .table-custom thead {
            background-color: var(--primary-color);
            color: white;
        }
        .btn-custom {
            background-color: var(--secondary-color);
            color: white;
        }
        .btn-custom:hover {
            background-color: var(--primary-color);
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="user/index.php">NvalTravel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Destinasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Daftar Destinasi</h1>
        <div class="table-responsive">
            <table class="table table-hover table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Destinasi</th>
                        <th>Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($destinasi_list as $destinasi): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($destinasi['id']); ?></td>
                        <td><?php echo htmlspecialchars($destinasi['nama_destinasi']); ?></td>
                        <td><?php echo htmlspecialchars($destinasi['lokasi']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <a href="user/index.php" class="btn btn-custom mt-3">Kembali ke Beranda</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>