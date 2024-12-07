<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis_Transaksi = $_POST['jenis_Transaksi'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];

    $username = $_SESSION['username'];

    // Ambil saldo terakhir dari database
    $querySaldo = "SELECT saldo FROM keuangan ORDER BY ID DESC LIMIT 1";
    $resultSaldo = mysqli_query($conn, $querySaldo);
    $saldoTerakhir = mysqli_fetch_assoc($resultSaldo)['saldo'];

    // Tentukan saldo baru berdasarkan jenis transaksi
    if ($jenis_Transaksi == 'Pemasukan') {
        $saldoBaru = $saldoTerakhir + $jumlah;
    } elseif ($jenis_Transaksi == 'Pengeluaran') {
        if ($jumlah > $saldoTerakhir) {
            echo "<script>
                alert('Error: Pengeluaran melebihi jumlah saldo!');
                window.location.href = 'formKeuangan.php';
            </script>";
            exit;
        }
        $saldoBaru = $saldoTerakhir - $jumlah;
    }

    // Query untuk menyimpan data
    $query = "INSERT INTO keuangan (nama,jenis_Transaksi, jumlah, saldo, tanggal, keterangan) VALUES ('$username','$jenis_Transaksi', '$jumlah', '$saldoBaru', '$tanggal', '$keterangan')";

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
                    window.location.href = 'keuangan.php';
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
                    window.location.href = 'formKeuangan.php';
                });
            });
</script>";
    }

    // Menutup koneksi
    mysqli_close($conn);
}
