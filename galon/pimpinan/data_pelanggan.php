<?php

session_start();
include '../config.php';
$user = mysqli_query($conn, "SELECT * FROM pelanggan");

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

                    <li class="sidebar-item active">
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

                    <li class="sidebar-item">
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
                                    <h1 class="mb-5">Data Pelanggan</h1>
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-hover text-dark text-center">
                                            <thead>
                                                <tr class="table table-primary">
                                                    <th>ID Pelanggan</th>
                                                    <th>Nama</th>
                                                    <th>Nama Kamar</th>
                                                    <th>No HP</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($user as $td) : ?>
                                                <tr>
                                                    <td><?= $td['id_user'] ?></td>
                                                    <td><?= $td['nama'] ?></td>
                                                    <td><?= $td['alamat'] ?></td>
                                                    <td><?= $td['nohp'] ?></td>
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