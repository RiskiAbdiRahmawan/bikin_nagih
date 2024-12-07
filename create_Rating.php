<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaMenu = $_POST['menuItem'];
    $rating = $_POST['rating'];
    $ulasan = $_POST['ulasan'];

    // Check if all required fields are filled
    if (!empty($namaMenu) && !empty($rating) && !empty($ulasan)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO rating (nama_Menu, rating, ulasan) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $namaMenu, $rating, $ulasan);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil disimpan!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'index.php';
                });
            });
</script>";
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: 'Error: " . addslashes($query) . "<br>" . addslashes($error_message) . "',
                }).then(function() {
                    window.location.href = 'index.php';
                });
            });
</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: 'Error: Semua data harus diisi',
                }).then(function() {
                    window.location.href = 'formMenu.php';
                });
            });
</script>";
    }

    // Close the connection
    $conn->close();
}
