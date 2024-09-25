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

// Tambahkan ini di akhir logika PHP untuk mendapatkan semua transaksi
$query = "SELECT * FROM transaksi ORDER BY tanggal_pemesanan DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Transaksi</title>
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
                <h1 class="h3 mb-0">Manajemen Transaksi</h1>
            </div>
            <div class="card-body">
                <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahTransaksiModal">
                    <i class="fas fa-plus"></i> Tambah Transaksi Baru
                </button>

                <div class="table-responsive">
                    <table id="transaksiTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Jenis Layanan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['tanggal_pemesanan'] . "</td>";
                                echo "<td>" . $row['jenis_layanan'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>" . $row['tanggal'] . "</td>";
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

    <!-- Modal Tambah Transaksi -->
    <div class="modal fade" id="tambahTransaksiModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Tambah Transaksi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="tambahTransaksiForm">
                        <div class="mb-3">
                            <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan</label>
                            <input type="text" class="form-control" id="tanggal_pemesanan" name="tanggal_pemesanan" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_layanan" class="form-label">Jenis Layanan</label>
                            <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Transaksi -->
    <div class="modal fade" id="editTransaksiModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Edit Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editTransaksiForm">
                        <input type="hidden" name="id">
                        <div class="mb-3">
                            <label for="edit_tanggal_pemesanan" class="form-label">Tanggal Pemesanan</label>
                            <input type="text" class="form-control" id="edit_tanggal_pemesanan" name="tanggal_pemesanan" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_jenis_layanan" class="form-label">Jenis Layanan</label>
                            <input type="text" class="form-control" id="edit_jenis_layanan" name="jenis_layanan" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="edit_status" name="status" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="edit_tanggal" name="tanggal">
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
            $('#transaksiTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
                }
            });

            // Tambah Transaksi
            $('#tambahTransaksiForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'transaksi_process.php',
                    type: 'POST',
                    data: $(this).serialize() + '&action=tambah',
                    success: function(response) {
                        alert(response);
                        location.reload();
                    }
                });
            });

            // Edit Transaksi
            $('.edit-btn').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'transaksi_process.php',
                    type: 'GET',
                    data: {action: 'get', id: id},
                    success: function(response) {
                        var data = JSON.parse(response);
                        $('#editTransaksiForm input[name="id"]').val(data.id);
                        $('#editTransaksiForm input[name="tanggal_pemesanan"]').val(data.tanggal_pemesanan);
                        $('#editTransaksiForm input[name="jenis_layanan"]').val(data.jenis_layanan);
                        $('#editTransaksiForm input[name="status"]').val(data.status);
                        $('#editTransaksiForm input[name="tanggal"]').val(data.tanggal);
                        $('#editTransaksiModal').modal('show');
                    }
                });
            });

            $('#editTransaksiForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'transaksi_process.php',
                    type: 'POST',
                    data: $(this).serialize() + '&action=edit',
                    success: function(response) {
                        alert(response);
                        location.reload();
                    }
                });
            });

            // Hapus Transaksi
            $('.delete-btn').click(function() {
                if (confirm('Apakah Anda yakin ingin menghapus transaksi ini?')) {
                    var id = $(this).data('id');
                    $.ajax({
                        url: 'transaksi_process.php',
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