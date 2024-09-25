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
            $nama_destinasi = $_POST['nama_destinasi'];
            $lokasi = $_POST['lokasi'];

            $sql = "INSERT INTO destinasi (nama_destinasi, lokasi) VALUES ('$nama_destinasi', '$lokasi')";
            if (mysqli_query($conn, $sql)) {
                echo "Destinasi berhasil ditambahkan";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;

        case 'edit':
            $id = $_POST['id'];
            $nama_destinasi = $_POST['nama_destinasi'];
            $lokasi = $_POST['lokasi'];

            $sql = "UPDATE destinasi SET nama_destinasi='$nama_destinasi', lokasi='$lokasi' WHERE id=$id";
            if (mysqli_query($conn, $sql)) {
                echo "Destinasi berhasil diperbarui";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;

        case 'hapus':
            $id = $_POST['id'];

            $sql = "DELETE FROM destinasi WHERE id=$id";
            if (mysqli_query($conn, $sql)) {
                echo "Destinasi berhasil dihapus";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'get') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM destinasi WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
}

mysqli_close($conn);