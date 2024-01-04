<?php
session_start();
include '../config.php';

$id_pesanan = $_GET['id_pesanan'];
mysqli_query($conn, "DELETE FROM pesanan WHERE id_pesanan = '$id_pesanan'");
echo "
        <script>
            alert('Data berhasil dihapus!');
            window.location.href='data_tagihan.php';
        </script>
    ";