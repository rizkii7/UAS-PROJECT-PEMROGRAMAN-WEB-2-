<?php

session_start();
include '../config.php';
$id_pesanan = $_GET['id_pesanan'];
$query = "SELECT *
          FROM pesanan 
          INNER JOIN tagihan ON pesanan.id_pesanan = tagihan.id_pesanan
          INNER JOIN user ON pesanan.id_user = user.id_user
          WHERE pesanan.id_pesanan = '$id_pesanan'";

$pembelian = query($query)[0];


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

        <div class="main ">

            <main class="content p-4">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body p-5 text-dark">
                                    <h1 class="text-center">Nota Pesanan </h1>
                                    <br>
                                    <p>
                                        Tanggal :
                                        <?= date('d F Y', strtotime($pembelian['tanggal'])) ?>
                                    </p>
                                    <p>
                                        Nama :
                                        <?php $id_us = $pembelian['id_user']; ?>
                                        <?php $user_detail = query("SELECT * FROM pelanggan WHERE id_user = '$id_us'")[0]; ?>
                                        <?= $user_detail['nama'] ?>
                                    </p>
                                    <p>
                                        Nama Kamar :
                                        <?= $user_detail['alamat'] ?>
                                    </p>
                                    <p>
                                        No Hp :
                                        <?= $user_detail['nohp'] ?>
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table table-responsive table-hover text-dark text-center">
                                            <thead>
                                                <tr class="table table-primary">
                                                    <th>Jenis Galon</th>
                                                    <th>Jumlah Galon</th>
                                                    <th>Nominal</th>
                                                    <th>Ket</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>


                                                    <td><?= $pembelian['jenis_galon'] ?></td>
                                                    <td><?= $pembelian['jumlah_galon'] ?></td>
                                                    <td><?= number_format($pembelian['nominal'], 0); ?></td>
                                                    <td>
                                                        <strong>LUNAS</strong>
                                                    </td>
                                                </tr>
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

    <script>
    window.print();
    </script>
</body>

</html>