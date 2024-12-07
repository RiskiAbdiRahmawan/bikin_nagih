<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil ID dari form
    $id = $_POST['id'];

    // Ambil data yang dikirimkan melalui form untuk update
    $nama = $_POST['nama'];
    $rasa = $_POST['rasa'];
    $tempat = $_POST['tempat'];
    $pelayanan = $_POST['pelayanan'];

    // Query untuk update data testimoni
    $queryUpdate = "UPDATE testimoni SET nama = '$nama', rasa = '$rasa', tempat = '$tempat', pelayanan = '$pelayanan' WHERE ID = $id";

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
                        window.location.href = 'testimoni.php';
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info').then(() => {
                        window.location.href = 'formEditTestimoni.php?id=" . $id . "';
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
                    window.location.href = 'formEditTestimoni.php?id=$id';
                });
            });
</script>";
    }
    // Menutup koneksi
    mysqli_close($conn);
}
