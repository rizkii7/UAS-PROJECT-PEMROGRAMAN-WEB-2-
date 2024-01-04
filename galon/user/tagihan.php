<?php

session_start();
include '../config.php';

$id_user = $_SESSION['id_user'];
$query = "SELECT *
          FROM pesanan 
          INNER JOIN tagihan ON pesanan.id_pesanan = tagihan.id_pesanan
          WHERE pesanan.id_user = '$id_user' AND tagihan.pembayaran = 'Belum Bayar'";

$pesanan = mysqli_query($conn, $query);

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
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="history_pembelian.php">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">History
                                Pembelian</span>
                        </a>
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="tagihan.php">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">
                                Tagihan</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pemesanan.php">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Pemesanan
                            </span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../logout.php">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Logout</span>
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
                                    <h1 class="mb-5">Tagihan Pesanan</h1>
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-hover text-dark text-center">
                                            <thead>
                                                <tr class="table table-primary">
                                                    <th>Tanggal</th>
                                                    <th>Jenis Galon</th>
                                                    <th>Jumlah Galon</th>
                                                    <th>Nominal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pesanan as $td) : ?>
                                                    <tr>
                                                        <td><?= date('d F Y', strtotime($td['tanggal'])) ?></td>
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