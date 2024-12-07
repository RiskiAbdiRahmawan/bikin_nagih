<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil ID dari form
    $id = $_POST['ID'];

    // Ambil data yang dikirimkan melalui form untuk update
    $menuItem = $_POST['menuItem'];
    $rating = $_POST['rating'];
    $ulasan = $_POST['ulasan'];

    // Query untuk update data rating
    $queryUpdate = "UPDATE rating SET nama_Menu = '$menuItem', rating = '$rating', ulasan = '$ulasan' WHERE ID = $id";

    if (mysqli_query($conn, $queryUpdate)) {
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
                        window.location.href = 'rating.php';
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info').then(() => {
                        window.location.href = 'formEditRating.php?ID=" . $id . "';
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
                    window.location.href = 'formEditKeuangan.php?ID=$id';
                });
            });
</script>";
    }

    // Menutup koneksi
    mysqli_close($conn);
}
