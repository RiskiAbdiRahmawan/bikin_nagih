<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Testimoni</title>
    <link rel="icon" type="image/png" href="img/logo.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h5>Edit Testimoni</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include 'koneksi.php';

                        // Ambil ID dari parameter URL
                        $id = $_GET['id'];

                        // Query untuk mendapatkan data testimoni berdasarkan ID
                        $queryGetData = "SELECT * FROM testimoni WHERE ID = $id";
                        $resultGetData = mysqli_query($conn, $queryGetData);
                        $data = mysqli_fetch_assoc($resultGetData);

                        if (!$data) {
                            echo "Data tidak ditemukan!";
                            exit;
                        }
                        ?>
                        <form action="update_Testimoni.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $data['ID']; ?>">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="rasa" class="form-label">Rasa</label>
                                <input type="text" class="form-control" id="rasa" name="rasa" value="<?php echo $data['rasa']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="tempat" class="form-label">Tempat</label>
                                <input type="text" class="form-control" id="tempat" name="tempat" value="<?php echo $data['tempat']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="pelayanan" class="form-label">Pelayanan</label>
                                <input type="text" class="form-control" id="pelayanan" name="pelayanan" value="<?php echo $data['pelayanan']; ?>" required>
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