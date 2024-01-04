<?php
session_start();
include '../config.php';

$id_pesanan = $_GET['id_pesanan'];
$tagihan = query("SELECT * FROM tagihan WHERE id_pesanan = '$id_pesanan'")[0];
$id_tagihan = $tagihan['id_tagihan'];
mysqli_query($conn, "UPDATE tagihan SET 
            pembayaran = 'Sudah Bayar'
            WHERE id_tagihan = '$id_tagihan'
            ");
echo "
        <script>
            alert('Berhasil Membayar Tagihan! Data akan masuk ke Rekapitulasi');
            window.location.href='data_tagihan.php';
        </script>
    ";
