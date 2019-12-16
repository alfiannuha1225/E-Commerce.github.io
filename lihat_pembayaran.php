<?php
    session_start();
include 'koneksi.php';
$id = $_GET["id"];
$data = $conn->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE pembelian.id_pembelian='$id'");
$detbuy = $data->fetch_assoc();

// echo "<pre>";
//print_r($detbuy);
// echo "</pre>";

if(empty($detbuy))
{
    echo "<script>alert('Belum Ada Data Pembayaran'); document.location='index.php?hal=riwayat_belanja';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lihat Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<nav class="navbar navbar-default">
        <div class="container">
            <!-- brand -->
            <a href="index.php" class="navbar-brand" style="color: black">MEMBER AREA</a>
            <div class="container">
                <ul class="nav navbar-nav">
                    <li><a href="#">Barang</a></li>
                    <li><a href="#">Keranjang</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="#">Daftar</a></li>
                    <li><a href="checkout.php">Checkout</a></li>
                    <li><a href="riwayat_belanja.php">Riwayat Belanja</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>Lihat Pembayaran</h1>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-responsive">
                        <tr>
                            <th>Nama</th>
                            <th><?php echo $detbuy["nama"] ?><x/th>
                        </tr>
                        <tr>
                            <th>Bank</th>
                            <th><?php echo $detbuy["bank"] ?><x/th>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <th><?php echo $detbuy["tanggal_pembayaran"] ?><x/th>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <th><?php echo "Rp. ".number_format($detbuy["jumlah"],2,",",".") ?><x/th>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <img src="bukti_pembayaran/<?php echo $detbuy["bukti_pembayaran"] ?>" alt="" class="img-responsive">
                </div>
            </div>
    </div>
</body>
</html>