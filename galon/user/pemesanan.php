<?php

session_start();
include '../config.php';

$id_user = $_SESSION['id_user'];

if (isset($_POST['input'])) {
    $tanggal = $_POST['tanggal'];
    $jenis_galon = $_POST['jenis_galon'];
    $jumlah_galon = $_POST['jumlah_galon'];

    if ($jenis_galon == 'Besar') {
        $nominal = $jumlah_galon * 3000;
    } elseif ($jenis_galon == 'Kecil') {
        $nominal = $jumlah_galon * 2000;
    }

    $pembayaran = 'Belum Bayar';

    mysqli_query($conn, "INSERT INTO pesanan VALUES(NULL, '$id_user', '$tanggal', '$jenis_galon', '$jumlah_galon', '$nominal')");
    $last_inserted_id = mysqli_insert_id($conn);
    mysqli_query($conn, "INSERT INTO tagihan VALUES(NULL, '$last_inserted_id', '$pembayaran')");

    echo "
        <script>
            alert('Berhasil Pesan!');
            window.location.href='tagihan.php';
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
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="history_pembelian.php">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">History
                                Pembelian</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="tagihan.php">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">
                                Tagihan</span>
                        </a>
                    </li>

                    <li class="sidebar-item active">
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

                                    <h1 class="mb-5">Pemesanan</h1>
                                    <form action="" method="POST">
                                        <input type="date" class="form-control mb-3" name="tanggal" required>
                                        <select name="jenis_galon" class="form-control mb-3" required>
                                            <option style="display:none"> -- Pilih Jenis Galon -- </option>
                                            <option value="Besar">Besar</option>
                                            <option value="Kecil">Kecil</option>
                                        </select>
                                        <input type="number" class="form-control mb-3" name="jumlah_galon" placeholder="Jumlah Galon" required>
                                        <button type="submit" name="input" class="btn btn-primary w-100">Submit</button>
                                    </form>

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