<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $kode_Menu = $_POST['kode_Menu'];
    $harga = $_POST['harga'];

    // File upload handling
    $gambar = $_FILES['gambar']['name'];
    $gambar_temp = $_FILES['gambar']['tmp_name'];
    $gambar_path = 'uploads/' . $gambar;

    if (move_uploaded_file($gambar_temp, $gambar_path)) {
        // Query untuk menyimpan data
        $query = "INSERT INTO menu (nama, kode_Menu, harga, gambar) VALUES ('$nama', '$kode_Menu', '$harga', '$gambar_path')";

        if (mysqli_query($conn, $query)) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil disimpan!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'menu.php';
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
                        html: 'Error: " . addslashes($query) . "<br>" . addslashes(mysqli_error($conn)) . "',
                    }).then(function() {
                        window.location.href = 'formMenu.php';
                    });
                });
            </script>";
        }
    } else {
        echo "Error uploading file!";
    }

    // Menutup koneksi
    mysqli_close($conn);
}
?>