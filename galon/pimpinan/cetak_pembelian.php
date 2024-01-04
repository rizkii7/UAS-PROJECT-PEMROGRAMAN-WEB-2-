<?php

session_start();
include '../config.php';

$awal = $_POST['awal'];
$akhir = $_POST['akhir'];

$query = "SELECT *
          FROM pesanan 
          INNER JOIN tagihan ON pesanan.id_pesanan = tagihan.id_pesanan
          INNER JOIN user ON pesanan.id_user = user.id_user
          WHERE tagihan.pembayaran = 'Sudah Bayar' 
          AND pesanan.tanggal BETWEEN '$awal' AND '$akhir'
          ";
$pembelian = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GALON</title>
    <link href="../css/app.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">

        <div class="main">
            <main class="content p-4">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body p-5">
                                    <h1 class="mb-5 text-center">Rekapitulasi Pembelian Depot Air di Pondok Pesantren
                                        Mahasiswa Roudhotul Jannah Surakarta</h1>
                                    <h5 class="mb-5 text-center"><?= date('d F Y', strtotime($awal)) ?> s.d
                                        <?= date('d F Y', strtotime($akhir)) ?></h5>
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-hover text-dark text-center">
                                            <thead>
                                                <tr class="table table-primary">
                                                    <th>Tanggal</th>
                                                    <th>ID Pelanggan</th>
                                                    <th>Nama</th>
                                                    <th>Nama Kamar</th>
                                                    <th>No HP</th>
                                                    <th>Jenis Galon</th>
                                                    <th>Jumlah Galon</th>
                                                    <th>Nominal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $total = 0; ?>
                                                <?php foreach ($pembelian as $td) : ?>
                                                    <tr>
                                                        <td><?= date('d F Y', strtotime($td['tanggal'])) ?></td>
                                                        <td><?= $td['id_user'] ?> <?php $id_us = $td['id_user']; ?> </td>
                                                        <?php $user_detail = query("SELECT * FROM pelanggan WHERE id_user = '$id_us'")[0]; ?>
                                                        <td><?= $user_detail['nama'] ?></td>
                                                        <td><?= $user_detail['alamat'] ?></td>
                                                        <td><?= $user_detail['nohp'] ?></td>
                                                        <td><?= $td['jenis_galon'] ?></td>
                                                        <td><?= $td['jumlah_galon'] ?></td>
                                                        <td><?= number_format($td['nominal'], 0); ?></td>
                                                        <?php $total += $td['nominal']; ?>
                                                    </tr>
                                                <?php endforeach; ?>

                                                <tr>
                                                    <td colspan="7">TOTAL</td>
                                                    <td><?= number_format($total, 0); ?></td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>

                                    <div class="mx-5 mt-5 mb-5 d-flex justify-content-between">
                                        <h5>Mengetahui</h5>
                                        <h5>Dibuat oleh</h5>
                                    </div>
                                    <div class="mx-5 mt-5 d-flex justify-content-between">
                                        <h5>Pimpinan</h5>
                                        <h5>Admin</h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

        </div>
    </div>

    <script src="js/app.js"></script>
    <script>
        window.print();
    </script>

</body>

</html>