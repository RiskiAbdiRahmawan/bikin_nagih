<?php
// Include file koneksi.php untuk menghubungkan dengan database
include 'koneksi.php';

// Ambil ID pelanggan dari parameter URL
$id = $_GET['ID'];

// Query untuk mendapatkan data pelanggan berdasarkan ID
$queryGetData = "SELECT * FROM pelanggan WHERE ID = $id";
$resultGetData = mysqli_query($conn, $queryGetData);
$data = mysqli_fetch_assoc($resultGetData);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

// Ambil data yang dikirimkan melalui form
$nama = $_POST['nama'];

// Query untuk update data pelanggan
$queryUpdate = "UPDATE pelanggan SET nama = '$nama' WHERE ID = $id";

// Jalankan query update
if (mysqli_query($conn, $queryUpdate)) {
    // Jika update berhasil, redirect ke halaman tertentu atau tampilkan pesan sukses
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Do you want to save the changes?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Saved!', '', 'success').then(() => {
                        window.location.href = 'pelanggan.php';
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info').then(() => {
                        window.location.href = 'formEditPelanggan.php?ID=" . $id . "';
                    });
                }
            });
        });
        </script>";
} else {
    // Jika ada error, tampilkan pesan error
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: 'Error: " . addslashes($query) . "<br>" . addslashes($error_message) . "',
                }).then(function() {
                    window.location.href = 'formEditPelanggan.php?ID=$id';
                });
            });
</script>";
}

// Tutup koneksi
mysqli_close($conn);
