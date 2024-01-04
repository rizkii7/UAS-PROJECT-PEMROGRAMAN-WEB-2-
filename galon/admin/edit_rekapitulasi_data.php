<?php

session_start();
include '../config.php';
$id_pembelian = $_GET['id_pembelian'];
$pembelian = query("SELECT * FROM pembelian WHERE id_pembelian = '$id_pembelian'")[0];

$user = mysqli_query($conn, "SELECT * FROM user WHERE id_level = '2'");

if (isset($_POST['edit'])) {
    $id_user = $_POST['id_user'];
    $tanggal = $_POST['tanggal'];
    $jenis_galon = $_POST['jenis_galon'];
    $jumlah_galon = $_POST['jumlah_galon'];

    if ($jenis_galon == 'Besar') {
        $nominal = $jumlah_galon * 3000;
    } elseif ($jenis_galon == 'Kecil') {
        $nominal = $jumlah_galon * 2000;
    }

    mysqli_query($conn, "UPDATE pembelian SET 
        id_user = '$id_user',
        tanggal = '$tanggal',
        jenis_galon = '$jenis_galon',
        jumlah_galon = '$jumlah_galon',
        nominal = '$nominal'
        WHERE id_pembelian = '$id_pembelian'
    ");

    echo "
        <script>
            alert('Berhasil Edit Rekapitulasi Data!');
            window.location.href='rekapitulasi_data.php';
        </script>
    ";
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

                            <li class="sidebar-item active">
                                <a class="sidebar-link" href="rekapitulasi_data.php">
                                    <i class="align-middle" data-feather="user"></i> <span
                                        class="align-middle">Rekapitulasi
                                        Data</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
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
                                    <h1 class="mb-5">Edit Rekapitulasi Data</h1>
                                    <form action="" method="POST">
                                        <select name="id_user" class="form-control mb-3" required>
                                            <?php
                                            $id_us_detail = $pembelian['id_user'];
                                            $us_detail = query("SELECT * FROM user WHERE id_user = '$id_us_detail'")[0];
                                            ?>
                                            <option value="<?= $us_detail['id_user']; ?>">
                                                ID : <?= $us_detail['id_user']; ?>, <?= $us_detail['nama']; ?>,
                                                <?= $us_detail['alamat']; ?>,
                                                <?= $us_detail['nohp']; ?>
                                                <i> (data saat ini) </i>
                                            </option>
                                            <?php foreach ($user as $us) : ?>
                                            <option value="<?= $us['id_user']; ?>">
                                                ID : <?= $us['id_user']; ?>, <?= $us['nama']; ?>, <?= $us['alamat']; ?>,
                                                <?= $us['nohp']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="date" value="<?= $pembelian['tanggal']; ?>"
                                            class="form-control mb-3" name="tanggal" required>
                                        <select name="jenis_galon" class="form-control mb-3" required>
                                            <option value="<?= $pembelian['jenis_galon']; ?>">
                                                <?= $pembelian['jenis_galon'] ?> </option>
                                            <option value="Besar">Besar</option>
                                            <option value="Kecil">Kecil</option>
                                        </select>
                                        <input type="number" value="<?= $pembelian['jumlah_galon']; ?>"
                                            class="form-control mb-3" name="jumlah_galon" placeholder="Jumlah Galon"
                                            required>
                                        <button type="submit" name="edit" class="btn btn-primary w-100">Edit</button>
                                    </form>
                                    <br>
                                    <a href="rekapitulasi_data.php">Kembali</a>
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