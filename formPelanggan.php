<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pelanggan</title>
    <link rel="icon" type="image/png" href="img/logo.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h5>Form Pelanggan</h5>
                    </div>
                    <div class="card-body">
                        <form action="create_Pelanggan.php" method="POST">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_Pelanggan" class="form-label">Jenis Pelanggan</label>
                                <select class="form-control" id="jenis_Pelanggan" name="jenis_Pelanggan" required>
                                    <option value="" disabled selected>Pilih Jenis Pelanggan</option>
                                    <option value="Bronze">Bronze</option>
                                    <option value="Silver">Silver</option>
                                    <option value="Gold">Gold</option>
                                    <option value="Diamond">Diamond</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_Bergabung" class="form-label">Tanggal Bergabung</label>
                                <input type="date" class="form-control" id="tanggal_Bergabung" name="tanggal_Bergabung" required>
                            </div>
                            <div class="mb-3">
                                <label for="nomor_Telepon" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="nomor_Telepon" name="nomor_Telepon" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Simpan</button>
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