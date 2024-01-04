<?php

session_start();
include '../config.php';
$query = "SELECT *
          FROM pesanan 
          INNER JOIN tagihan ON pesanan.id_pesanan = tagihan.id_pesanan
          INNER JOIN user ON pesanan.id_user = user.id_user
          WHERE tagihan.pembayaran = 'Belum Bayar'";

$pembelian = mysqli_query($conn, $query);

if (isset($_POST['search'])) {
    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];

    $query = "SELECT *
          FROM pesanan 
          INNER JOIN tagihan ON pesanan.id_pesanan = tagihan.id_pesanan
          INNER JOIN user ON pesanan.id_user = user.id_user
          WHERE tagihan.pembayaran = 'Belum Bayar' 
          AND pesanan.tanggal BETWEEN '$awal' AND '$akhir'
          ";
    $pembelian = mysqli_query($conn, $query);
}


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

        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="">
                    <span class="align-middle">GALON</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="index.php">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="data_pelanggan.php">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data
                                Pelanggan</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="data_pembelian.php">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data
                                Pembelian</span>
                        </a>
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="data_tagihan.php">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data Tagihan
                            </span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../logout.php">
                            <i class="align-middle" data-feather="user-plus"></i> <span
                                class="align-middle">Logout</span>
                        </a>
                    </li>


                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <div>
                    <h3 class="justify-content-start"> Sistem Informasi Depot Galon </h3>
                </div>

            </nav>

            <main class="content p-4">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body p-5">
                                    <h1 class="mb-5">Data Tagihan</h1>
                                    <label class="text-dark">Search by date</label>
                                    <form action="" method="POST" class="d-flex justify-content-evenly mb-4">
                                        <input type="date" name="awal" class="form-control w-25">
                                        <label class="text-dark pt-2"> s.d</label>
                                        <input type="date" name="akhir" class="form-control w-25">
                                        <button type="submit" name="search" class="btn btn-primary w-25">Filter</button>
                                        <a href="" class="btn btn-secondary">Refresh</a>
                                    </form>
                                    <label class="text-dark">Print by date</label>
                                    <form action="cetak_tagihan.php" target="_blank" method="POST"
                                        class="d-flex justify-content-evenly mb-4">
                                        <input type="date" name="awal" class="form-control w-25">
                                        <label class="text-dark pt-2"> s.d</label>
                                        <input type="date" name="akhir" class="form-control w-25">
                                        <button type="submit" name="print" class="btn btn-primary w-25">Print</button>
                                    </form>
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
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>

                                        </table>
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

</body>

</html>