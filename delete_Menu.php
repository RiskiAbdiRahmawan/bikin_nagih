<?php
include 'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kode untuk menghapus data
    $id = $_POST['ID'];

    $query = "DELETE FROM menu WHERE ID ='$id'";

    // Query untuk mengatur ulang urutan ID
    $queryResetID = "ALTER TABLE menu AUTO_INCREMENT = 1";
    if (mysqli_query($conn, $query)) {
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
                        window.location.href = 'menu.php';
                    });
                } else {
                    window.location.href = 'menu.php';
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
                text: 'Error: <?php echo mysqli_error($conn); ?>',
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
?>
