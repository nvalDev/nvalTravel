<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Travel";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses CRUD
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    switch ($action) {
        case 'tambah':
            $tanggal_pemesanan = $_POST['tanggal_pemesanan'];
            $jenis_layanan = $_POST['jenis_layanan'];
            $status = $_POST['status'];
            $tanggal = $_POST['tanggal'];

            $sql = "INSERT INTO transaksi (tanggal_pemesanan, jenis_layanan, status, tanggal) VALUES ('$tanggal_pemesanan', '$jenis_layanan', '$status', '$tanggal')";
            if (mysqli_query($conn, $sql)) {
                echo "Transaksi berhasil ditambahkan";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;

        case 'edit':
            $id = $_POST['id'];
            $tanggal_pemesanan = $_POST['tanggal_pemesanan'];
            $jenis_layanan = $_POST['jenis_layanan'];
            $status = $_POST['status'];
            $tanggal = $_POST['tanggal'];

            $sql = "UPDATE transaksi SET tanggal_pemesanan='$tanggal_pemesanan', jenis_layanan='$jenis_layanan', status='$status', tanggal='$tanggal' WHERE id=$id";
            if (mysqli_query($conn, $sql)) {
                echo "Transaksi berhasil diperbarui";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;

        case 'hapus':
            $id = $_POST['id'];

            $sql = "DELETE FROM transaksi WHERE id=$id";
            if (mysqli_query($conn, $sql)) {
                echo "Transaksi berhasil dihapus";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'get') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM transaksi WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
}

mysqli_close($conn);