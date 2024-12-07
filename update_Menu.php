<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kode_Menu = $_POST['kode_Menu'];
    $harga = $_POST['harga'];

    // Query untuk mengupdate data
    $query = "UPDATE menu SET nama='$nama', kode_Menu='$kode_Menu', harga='$harga' WHERE ID=$id";

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
                        window.location.href = 'menu.php';
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info').then(() => {
                        window.location.href = 'formEditMenu.php?id=" . $id . "';
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
                    window.location.href = 'formEditMenu.php?id=$id';
                });
            });
</script>";
    }

    // Menutup koneksi
    mysqli_close($conn);
}
