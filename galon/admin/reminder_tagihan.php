<?php

session_start();
include '../config.php';
$pembelian = mysqli_query($conn, "SELECT p.id_user 
                                 FROM pesanan p
                                 INNER JOIN tagihan t ON p.id_pesanan = t.id_pesanan
                                 INNER JOIN pelanggan pl ON p.id_user = pl.id_user
                                 WHERE t.pembayaran = 'Belum Bayar'
                                 GROUP BY p.id_user");
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

                    <!-- Data Master -->
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#" id="dataMaster">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data
                                Master</span>
                        </a>
                        <ul class="sidebar-dropdown">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="data_admin.php">
                                    Data
                                    Admin</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="data_pelanggan.php">
                                    Data
                                    Pelanggan</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- End of Data Master -->
                    <!-- Data Master -->
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#" id="dataTransaksi">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data
                                Transaksi</span>
                        </a>
                        <ul class="sidebar-dropdown">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="input_pembelian.php">
                                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Input
                                        Pembelian</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" href="data_tagihan.php">
                                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data
                                        Tagihan</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" href="rekapitulasi_data.php">
                                    <i class="align-middle" data-feather="user"></i> <span
                                        class="align-middle">Rekapitulasi
                                        Data</span>
                                </a>
                            </li>

                            <li class="sidebar-item active">
                                <a class="sidebar-link" href="reminder_tagihan.php">
                                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Reminder
                                        Tagihan</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- End of Data Master -->
                    <script>
                    // JavaScript to handle click event for the Data Master dropdown
                    const dataMasterLink = document.getElementById('dataMaster');
                    const dataMasterDropdown = dataMasterLink.nextElementSibling;

                    dataMasterLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        dataMasterDropdown.style.display = (dataMasterDropdown.style.display === 'block') ?
                            'none' : 'block';
                    });
                    // JavaScript to handle click event for the Data Master dropdown
                    const dataTransaksiLink = document.getElementById('dataTransaksi');
                    const dataTransaksiDropdown = dataTransaksiLink.nextElementSibling;

                    dataTransaksiLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        dataTransaksiDropdown.style.display = (dataTransaksiDropdown.style.display ===
                                'block') ? 'none' :
                            'block';
                    });
                    </script>



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
                                    <h1 class="mb-5">Reminder Tagihan</h1>
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-hover text-dark text-center">
                                            <thead>
                                                <tr class="table table-primary">
                                                    <th>Nama</th>
                                                    <th>Nama Kamar</th>
                                                    <th>No HP</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pembelian as $td) : ?>
                                                <tr>
                                                    <?php $id_us = $td['id_user']; ?>
                                                    <?php $user_detail = query("SELECT * FROM pelanggan WHERE id_user = '$id_us'")[0]; ?>
                                                    <td><?= $user_detail['nama'] ?></td>
                                                    <td><?= $user_detail['alamat'] ?></td>
                                                    <td><?= $user_detail['nohp'] ?></td>
                                                    <td>
                                                        <?php
                                                            $text = "Sdr " . $user_detail['nama'] . ", Mohon untuk segera membayar tagihan depot air berikut:\n\n";
                                                            $text .= "Tanggal | Jenis | Jumlah | Nominal\n";
                                                            $pesanan_user = mysqli_query($conn, "SELECT p.tanggal, p.jenis_galon, p.jumlah_galon, p.nominal
                                     FROM pesanan p
                                     INNER JOIN tagihan t ON p.id_pesanan = t.id_pesanan
                                     WHERE p.id_user = '$id_us' AND t.pembayaran = 'Belum Bayar'");
                                                            $total = 0;
                                                            while ($td = mysqli_fetch_assoc($pesanan_user)) {
                                                                $total += $td['nominal'];
                                                                $text .= "{$td['tanggal']} | {$td['jenis_galon']} | {$td['jumlah_galon']} | {$td['nominal']}\n";
                                                            }
                                                            $text .= "Total : {$total} ";
                                                            ?>


                                                        <a href="https://wa.me/<?= $user_detail['nohp']; ?>?text=<?= urlencode($text); ?>"
                                                            class="btn btn-success mb-2">Kirim Reminder (WhatsApp)</a>
                                                    </td>
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