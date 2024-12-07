<?php
include 'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kode untuk menghapus data
    $id = $_POST['ID'];

    // Query untuk menghapus data penjualan yang terkait dengan pelanggan
    $queryDeleteSales = "DELETE FROM penjualan WHERE id_pelanggan ='$id'";

    // Eksekusi query penghapusan data penjualan terlebih dahulu
    if (mysqli_query($conn, $queryDeleteSales)) {
        // Jika penghapusan data penjualan berhasil, lanjutkan penghapusan data pelanggan
        $queryDeleteCustomer = "DELETE FROM pelanggan WHERE ID ='$id'";

        if (mysqli_query($conn, $queryDeleteCustomer)) {
            // Query untuk mengatur ulang urutan ID
            $queryResetID = "ALTER TABLE pelanggan AUTO_INCREMENT = 1";
            mysqli_query($conn, $queryResetID);

            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            icon: 'success'
                        }).then(() => {
                            window.location.href = 'pelanggan.php';
                        });
                    } else {
                        window.location.href = 'pelanggan.php';
                    }
                });
            });
            </script>";
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error: " . mysqli_error($conn) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.history.back();
                });
            });
            </script>";
        }
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error!',
                text: 'Error: " . mysqli_error($conn) . "',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => {
                window.history.back();
            });
        });
        </script>";
    }

    // Menutup koneksi
    mysqli_close($conn);
}