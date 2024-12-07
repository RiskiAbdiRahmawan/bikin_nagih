<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'] ?? '';
    $tanggal_transaksi = $_POST['tanggal_transaksi'] ?? '';
    $method_payment = $_POST['payment_method'] ?? '';
    $total = $_POST['total'] ?? '';
    $cart_json = $_POST['cart'] ?? '[]';

    $cart = json_decode($cart_json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Error: Invalid JSON data.";
        exit;
    }

    if (empty($cart)) {
        echo "Error: Cart is empty.";
        exit;
    }

    // Menyimpan data pelanggan
    $stmt_pelanggan = $conn->prepare("INSERT INTO pelanggan (nama) VALUES (?)");
    $stmt_pelanggan->bind_param("s", $nama);
    if ($stmt_pelanggan->execute()) {
        $id_pelanggan = $stmt_pelanggan->insert_id;
    } else {
        echo "Error: " . $stmt_pelanggan->error;
        exit;
    }

    // Menyimpan data penjualan
    $stmt_penjualan = $conn->prepare("INSERT INTO penjualan (tanggal_Penjualan, total, id_Pelanggan, metode_Pembayaran) VALUES (?, ?, ?,?)");
    $stmt_penjualan->bind_param("ssis", $tanggal_transaksi, $total, $id_pelanggan, $method_payment);
    if ($stmt_penjualan->execute()) {
        $id_penjualan = $stmt_penjualan->insert_id;
    } else {
        echo "Error: " . $stmt_penjualan->error;
        exit;
    }

    // Menyimpan data detail penjualan
    $stmt_detail_penjualan = $conn->prepare("INSERT INTO detail_penjualan (id_Penjualan, nama_Menu, jumlah, subtotal) VALUES (?, ?, ?, ?)");
    foreach ($cart as $item) {
        $nama_menu = $item['namaMenu'];
        $jumlah = $item['jumlah'];
        $subtotal = $item['subtotal'];

        $stmt_detail_penjualan->bind_param("isid", $id_penjualan, $nama_menu, $jumlah, $subtotal);
        if (!$stmt_detail_penjualan->execute()) {
            echo "Error: " . $stmt_detail_penjualan->error;
            exit;
        }
    }

    // Retrieve the current balance from keuangan table
    $result = $conn->query("SELECT saldo FROM keuangan ORDER BY id DESC LIMIT 1");
    $current_balance = $result->fetch_assoc()['saldo'] ?? 0;

    // Calculate the new balance
    $new_balance = $current_balance + $total;

    // Menyimpan data keuangan
    $jenis = 'Pemasukan';
    $keterangan = 'Pembelian ' . $nama . '';
    $stmt_keuangan = $conn->prepare("INSERT INTO keuangan (tanggal, keterangan, jenis_Transaksi, jumlah, saldo) VALUES (?, ?, ?, ?, ?)");
    $stmt_keuangan->bind_param("sssii", $tanggal_transaksi, $keterangan, $jenis, $total, $new_balance);
    if (!$stmt_keuangan->execute()) {
        echo "Error: " . $stmt_keuangan->error;
        exit;
    }

    echo "Success: Data has been saved.";
}

$conn->close();
