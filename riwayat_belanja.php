<?php
    session_start();
include 'koneksi.php';

//jika tidak ada session customer
// if(!isset($_SESSION["customer"]) OR empty($_SESSION["customer"]))
// {
//     echo "<script>alert('Silahkan Login Terlebih Dahulu'); document.location='index.php?hal=login';</script>";
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Riwayat Belanja</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- brand -->
    <a href="index.php" class="navbar-brand" style="color: black">MEMBER AREA</a>
            <div class="container">
                <ul class="nav navbar-nav">
                    <li><a href="index.php?hal=barang">Barang</a></li>
                    <li><a href="keranjang.php">Keranjang</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="#">Daftar</a></li>
                    <li><a href="checkout.php">Checkout</a></li>
                    <li><a href="riwayat_belanja.php">Riwayat Belanja</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- <pre><?php //print_r($_SESSION); ?></pre> -->
    <section class="riwayat">
        <div class="container">
            <h3>Riwayat Belanja <?php echo $_SESSION["customer"]["nama_customer"] ?></h3>

            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Status Pembayaran</th>
                        <th>Total</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        //mendapatkan id_customer yg login dri session
                        $id_customer = $_SESSION["customer"]["id_customer"];

                        $ambil = $conn->query("SELECT * FROM pembelian WHERE id_customer='$id_customer'");

                        while($pecah = $ambil->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $pecah["tanggal_pembelian"]; ?></td>
                        <td>
                            <?php echo $pecah["status_pembayaran"]; ?>
                            <br>
                            <?php if(!empty($pecah["resi_pengiriman"])) : ?>
                            Resi : <?php echo $pecah["resi_pengiriman"]; ?>
                            <?php endif ?>
                        </td>
                        <td><?php echo "Rp. ".number_format( $pecah["total_pembelian"],2,",","."); ?></td>
                        <td>
                            <a href="nota.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-info">Nota</a>
                            <?php if($pecah['status_pembayaran']=="pending") : ?>
                            <a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>"
                                class="btn btn-success">Pembayaran</a>
                            <?php else : ?>
                            <a href="lihat_pembayaran.php?id=<?php echo  $pecah["id_pembelian"] ?>"
                                class="btn btn-warning">Lihat Pembayaran</a>
                            <?php endif ?>
                        </td>
                    </tr>
                    <?php
                        $no++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>