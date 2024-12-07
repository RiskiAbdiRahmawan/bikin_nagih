<?php
include 'koneksi.php';

// Ambil ID dari parameter URL
$id = $_GET['ID'];

// Query untuk mendapatkan data berdasarkan ID
$query = "SELECT * FROM menu WHERE ID = $id";
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
                        <form action="update_Menu.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $data['ID']; ?>">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Menu</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="kode_Menu" class="form-label">Kode Menu</label>
                                <input type="text" class="form-control" id="kode_Menu" name="kode_Menu" value="<?php echo $data['kode_Menu']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $data['harga']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
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