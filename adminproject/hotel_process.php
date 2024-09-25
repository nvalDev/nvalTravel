<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Travel";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mendapatkan semua destinasi
$query = "SELECT * FROM destinasi ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Destinasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#">NvalTravel</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h1 class="h3 mb-0">Manajemen Destinasi</h1>
            </div>
            <div class="card-body">
                <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahDestinasiModal">
                    <i class="fas fa-plus"></i> Tambah Destinasi Baru
                </button>

                <div class="table-responsive">
                    <table id="destinasiTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Destinasi</th>
                                <th>Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['nama_destinasi'] . "</td>";
                                echo "<td>" . $row['lokasi'] . "</td>";
                                echo "<td>
                                        <button class='btn btn-sm btn-warning edit-btn' data-id='" . $row['id'] . "'><i class='fas fa-edit'></i></button>
                                        <button class='btn btn-sm btn-danger delete-btn' data-id='" . $row['id'] . "'><i class='fas fa-trash'></i></button>
                                      </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Destinasi -->
    <div class="modal fade" id="tambahDestinasiModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Tambah Destinasi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="tambahDestinasiForm">
                        <div class="mb-3">
                            <label for="nama_destinasi" class="form-label">Nama Destinasi</label>
                            <input type="text" class="form-control" id="nama_destinasi" name="nama_destinasi" required>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                        </div>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Destinasi -->
    <div class="modal fade" id="editDestinasiModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Edit Destinasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editDestinasiForm">
                        <input type="hidden" name="id">
                        <div class="mb-3">
                            <label for="edit_nama_destinasi" class="form-label">Nama Destinasi</label>
                            <input type="text" class="form-control" id="edit_nama_destinasi" name="nama_destinasi" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="edit_lokasi" name="lokasi" required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#destinasiTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
                }
            });

            // Tambah Destinasi
            $('#tambahDestinasiForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'destinasi_process.php',
                    type: 'POST',
                    data: $(this).serialize() + '&action=tambah',
                    success: function(response) {
                        alert(response);
                        location.reload();
                    }
                });
            });

            // Edit Destinasi
            $('.edit-btn').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'destinasi_process.php',
                    type: 'GET',
                    data: {action: 'get', id: id},
                    success: function(response) {
                        var data = JSON.parse(response);
                        $('#editDestinasiForm input[name="id"]').val(data.id);
                        $('#editDestinasiForm input[name="nama_destinasi"]').val(data.nama_destinasi);
                        $('#editDestinasiForm input[name="lokasi"]').val(data.lokasi);
                        $('#editDestinasiModal').modal('show');
                    }
                });
            });

            $('#editDestinasiForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'destinasi_process.php',
                    type: 'POST',
                    data: $(this).serialize() + '&action=edit',
                    success: function(response) {
                        alert(response);
                        location.reload();
                    }
                });
            });

            // Hapus Destinasi
            $('.delete-btn').click(function() {
                if (confirm('Apakah Anda yakin ingin menghapus destinasi ini?')) {
                    var id = $(this).data('id');
                    $.ajax({
                        url: 'destinasi_process.php',
                        type: 'POST',
                        data: {action: 'hapus', id: id},
                        success: function(response) {
                            alert(response);
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>