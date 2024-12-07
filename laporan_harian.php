<?php
include 'koneksi.php';

// Set default date to today
$date = date('Y-m-d');
if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

$query = "SELECT * FROM keuangan WHERE DATE(tanggal) = '$date'";
$result = mysqli_query($conn, $query);

// Query untuk pemasukan
$queryPemasukan = "SELECT SUM(jumlah) AS totalPemasukan FROM keuangan WHERE DATE(tanggal) = '$date' AND jenis_Transaksi = 'pemasukan'";
$resultPemasukan = mysqli_query($conn, $queryPemasukan);
$rowPemasukan = mysqli_fetch_assoc($resultPemasukan);
$totalPemasukan = $rowPemasukan['totalPemasukan'];

// Query untuk pengeluaran
$queryPengeluaran = "SELECT SUM(jumlah) AS totalPengeluaran FROM keuangan WHERE DATE(tanggal) = '$date' AND jenis_Transaksi = 'pengeluaran'";
$resultPengeluaran = mysqli_query($conn, $queryPengeluaran);
$rowPengeluaran = mysqli_fetch_assoc($resultPengeluaran);
$totalPengeluaran = $rowPengeluaran['totalPengeluaran'];

// Hitung total pendapatan harian
$totalPendapatan = $totalPemasukan - $totalPengeluaran;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan Harian</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div id="app">
        <div class="flex flex-col md:flex-row">

            <!-- SideBar -->
            <div class="text-gray-100 flex justify-between md:flex-col min-h-screen w-64" style="background-color: #ff5050;">
                <div class="px-8 py-6">
                    <h1 class="text-2xl font-bold text-black">Laporan Keuangan</h1>
                </div>
                <ul class="flex flex-col w-full">
                    <li class="hover:bg-gray-700">
                        <a href="#" class="block py-2 px-4 text-black hover:bg-blue-700">
                            Laporan Harian
                        </a>
                    </li>
                    <!-- Tambahkan menu lain sesuai kebutuhan -->
                </ul>
            </div>

            <!-- Content -->
            <div class="bg-white w-full">
                <div class="container mx-auto px-4 py-6">
                    <h1 class="text-2xl font-bold mb-6">Laporan Keuangan Harian</h1>
                    <form method="GET" action="" class="mb-6">
                        <label for="date" class="block">Pilih Tanggal:</label>
                        <input type="date" id="date" name="date" value="<?php echo $date; ?>" class="border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-2 rounded">Tampilkan</button>
                    </form>

                    <table class="w-full table-fixed border-collapse">
                        <thead>
                            <tr>
                                <th class="w-1/6 px-4 py-2">Jenis Transaksi</th>
                                <th class="w-1/6 px-4 py-2">Jumlah</th>
                                <th class="w-1/6 px-4 py-2">Saldo</th>
                                <th class="w-1/6 px-4 py-2">Tanggal</th>
                                <th class="w-1/2 px-4 py-2">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td class="border px-4 py-2"><?php echo $row['jenis_Transaksi']; ?></td>
                                    <td class="border px-4 py-2"><?php echo $row['jumlah']; ?></td>
                                    <td class="border px-4 py-2"><?php echo $row['saldo']; ?></td>
                                    <td class="border px-4 py-2"><?php echo $row['tanggal']; ?></td>
                                    <td class="border px-4 py-2"><?php echo $row['keterangan']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                        <!-- Card total pemasukan -->
                        <div class="mt-4">
                            <div class="bg-blue-500 rounded-lg p-4 text-black">
                                <h2 class="text-lg font-bold mb-2">Total Pendapatan</h2>
                                <p class="text-xl"><?php echo $totalPendapatan; ?></p>
                            </div>
                        </div>

                        <!-- Total pendapatan harian
                        <div class="mt-4">
                            <span class="font-bold">Total Pendapatan Harian:</span>
                            <span><?php echo $totalPendapatan; ?></span>
                        </div> -->
                    </table>
                    <a href="keuangan.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 mt-4 rounded inline-block">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>