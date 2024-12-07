<?php
include 'koneksi.php';

// Ambil ID dari parameter URL
$id = $_GET['ID'];

// Query untuk mendapatkan data berdasarkan ID
$query = "SELECT * FROM rating WHERE ID = $id";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rating</title>
    <link rel="icon" type="image/png" href="img/logo.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h5>Edit Rating</h5>
                    </div>
                    <div class="card-body">
                        <form action="update_Rating.php" method="POST">
                            <input type="hidden" name="ID" value="<?php echo $data['ID']; ?>">
                            <div class="mb-3">
                                <label for="menuItem" class="form-label">Pilih Menu</label>
                                <select class="form-control" id="menuItem" name="menuItem" required>
                                    <option value="" disabled>Pilih Menu</option>
                                    <option value="Dimsum Mentai" <?php if ($data['nama_Menu'] == 'Dimsum Mentai') echo 'selected'; ?>>Dimsum Mentai</option>
                                    <option value="Kage Mentai" <?php if ($data['nama_Menu'] == 'Kage Mentai') echo 'selected'; ?>>Kage Mentai</option>
                                    <option value="Kage Sambal" <?php if ($data['nama_Menu'] == 'Kage Sambal') echo 'selected'; ?>>Kage Sambal</option>
                                    <option value="Family Size Dimsum Mentai" <?php if ($data['nama_Menu'] == 'Family Size Dimsum Mentai') echo 'selected'; ?>>Family Size Dimsum Mentai</option>
                                    <option value="Gyuniku Teriyaki" <?php if ($data['nama_Menu'] == 'Gyuniku Teriyaki') echo 'selected'; ?>>Gyuniku Teriyaki</option>
                                    <option value="Aburi Salmon Dynamite" <?php if ($data['nama_Menu'] == 'Aburi Salmon Dynamite') echo 'selected'; ?>>Aburi Salmon Dynamite</option>
                                    <option value="Tofu Skin Roll" <?php if ($data['nama_Menu'] == 'Tofu Skin Roll') echo 'selected'; ?>>Tofu Skin Roll</option>
                                    <option value="Gyoza Mentai Package Family" <?php if ($data['nama_Menu'] == 'Gyoza Mentai Package Family') echo 'selected'; ?>>Gyoza Mentai Package Family</option>
                                    <option value="Hakau" <?php if ($data['nama_Menu'] == 'Hakau') echo 'selected'; ?>>Hakau</option>
                                    <option value="Salmon Kani Mentai" <?php if ($data['nama_Menu'] == 'Salmon Kani Mentai') echo 'selected'; ?>>Salmon Kani Mentai</option>
                                    <option value="Kage Nanban" <?php if ($data['nama_Menu'] == 'Kage Nanban') echo 'selected'; ?>>Kage Nanban</option>
                                    <option value="Gyoza Mentai" <?php if ($data['nama_Menu'] == 'Gyoza Mentai') echo 'selected'; ?>>Gyoza Mentai</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label">Pilih Rating</label>
                                <select class="form-control" id="rating" name="rating" required>
                                    <option value="" disabled>Pilih Rating</option>
                                    <option value="Sangat Buruk" <?php if ($data['rating'] == 'Sangat Buruk') echo 'selected'; ?>>1 - Sangat Buruk</option>
                                    <option value="Buruk" <?php if ($data['rating'] == 'Buruk') echo 'selected'; ?>>2 - Buruk</option>
                                    <option value="Cukup" <?php if ($data['rating'] == 'Cukup') echo 'selected'; ?>>3 - Cukup</option>
                                    <option value="Baik" <?php if ($data['rating'] == 'Baik') echo 'selected'; ?>>4 - Baik</option>
                                    <option value="Sangat Baik" <?php if ($data['rating'] == 'Sangat Baik') echo 'selected'; ?>>5 - Sangat Baik</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ulasan" class="form-label">Ulasan</label>
                                <textarea class="form-control" id="ulasan" name="ulasan" rows="3" placeholder="Tulis ulasan Anda di sini" required><?php echo $data['ulasan']; ?></textarea>
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