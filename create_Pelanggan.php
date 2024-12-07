<?php
// Include file koneksi.php untuk menghubungkan dengan database
include 'koneksi.php';

// Ambil data yang dikirimkan melalui form
$nama = $_POST['nama'];
$jenis_Pelanggan = $_POST['jenis_Pelanggan'];
$tanggal_Bergabung = $_POST['tanggal_Bergabung'];
$nomor_Telepon = $_POST['nomor_Telepon'];

// Query untuk menyimpan data ke dalam database
$query = "INSERT INTO pelanggan (nama, jenis_Pelanggan, tanggal_Bergabung, nomor_Telepon) VALUES ('$nama', '$jenis_Pelanggan', '$tanggal_Bergabung', '$nomor_Telepon')";

// Jalankan query
if (mysqli_query($conn, $query)) {
    // Jika penyimpanan berhasil, redirect ke halaman tertentu atau tampilkan pesan sukses
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil disimpan!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'pelanggan.php';
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
                    window.location.href = 'formPelanggan.php';
                });
            });
</script>";
}

// Tutup koneksi
mysqli_close($conn);
