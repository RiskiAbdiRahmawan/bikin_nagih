<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $jenis_Transaksi = $_POST['jenis_Transaksi'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];

    // Dapatkan saldo terakhir
    $querySaldo = "SELECT saldo FROM keuangan ORDER BY ID DESC LIMIT 1";
    $resultSaldo = mysqli_query($conn, $querySaldo);
    $dataSaldo = mysqli_fetch_assoc($resultSaldo);
    $saldoSebelum = $dataSaldo ? $dataSaldo['saldo'] : 0;

    if ($jenis_Transaksi == 'Pemasukan') {
        $saldoBaru = $saldoSebelum + $jumlah;
    } elseif ($jenis_Transaksi == 'Pengeluaran') {
        if ($jumlah > $saldoSebelum) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: 'Error: Jumlah pengeluaran melebihi saldo',
                }).then(function() {
                    window.location.href = 'formEditKeuangan.php?id=$id';
                });
            });
</script>";
            exit;
        } else {
            $saldoBaru = $saldoSebelum - $jumlah;
        }
    }

    // Query untuk update data
    $query = "UPDATE keuangan SET jenis_Transaksi = '$jenis_Transaksi', jumlah = '$jumlah', saldo = '$saldoBaru', tanggal = '$tanggal', keterangan = '$keterangan' WHERE ID = '$id'";

    if (mysqli_query($conn, $query)) {
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
                        window.location.href = 'keuangan.php';
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info').then(() => {
                        window.location.href = 'formEditKeuangan.php?id=" . $id . "';
                    });
                }
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
                    window.location.href = 'formEditKeuangan.php?id=$id';
                });
            });
</script>";
    }

    // Menutup koneksi
    mysqli_close($conn);
}
