<?php
include 'koneksi.php';

// Ambil ID dari parameter URL
$id = $_GET['ID'];

// Query untuk mendapatkan data berdasarkan ID
$query = "SELECT * FROM keuangan WHERE ID = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="img/logo.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h5>Edit Menu</h5>
                    </div>
                    <div class="card-body">
                        <form action="update_Keuangan.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $data['ID']; ?>">
                            <div class="mb-3">
                                <label for="jenis_Transaksi" class="form-label">Jenis Transaksi</label>
                                <select class="form-control" id="jenis_Transaksi" name="jenis_Transaksi" required>
                                    <option value="" disabled>Pilih Jenis Transaksi</option>
                                    <option value="Pemasukan" <?php if ($data['jenis_Transaksi'] == 'Pemasukan') echo 'selected'; ?>>Pemasukan</option>
                                    <option value="Pengeluaran" <?php if ($data['jenis_Transaksi'] == 'Pengeluaran') echo 'selected'; ?>>Pengeluaran</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" value="<?php echo $data['jumlah']; ?>" name="jumlah" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" value="<?php echo $data['tanggal']; ?>" name="tanggal" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required><?php echo $data['keterangan']; ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>