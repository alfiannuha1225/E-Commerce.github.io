<?php
include 'koneksi.php';

$keyword = $_GET["keyword"];
$semuadata=array();
$ambil = $conn->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk='%$keyword%'");
while($pecah = $ambil->fetch_assoc())
{
    $semuadata[]=$pecah;
}

// echo "<pre>";
// print_r($semuadata);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
                <li><a href="index.php?hal=keranjang">Keranjang</a></li>
                <li><a href="index.php?hal=login">Login</a></li>
                <li><a href="index.php?hal=daftar">Daftar</a></li>
                <li><a href="index.php?hal=checkout">Checkout</a></li>

            </ul>
            <form action="pencarian.php" method="get" class="navbar-form navbar-right">
                <input type="text" name="keyword" id="" class="form-control">
                <button name="cari" class="btn btn-primary">GO</button>
            </form>

        </div>
    </div>
</nav>    


    <div class="container">
        <h3>Hasil Pencarian : <?= $keyword ?></h3>
        <?php if(empty($semuadata)) : ?>
        <div class="alert alert-danger">Pencarian <strong><?php echo $keyword ?></strong> Tidak Ditemukan</div>
        <?php endif ?>
        <div class="row">
        <?php
            foreach($semuadata as $rows) :
        ?>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="foto_produk/<?php echo $rows['foto_produk'];  ?>" alt="" class="image-responsive">
                    <div class="caption">
                        <h3><?php echo $rows['nama_produk'] ?></h3>
                        <h5><?php echo "Rp. ".number_format($rows['harga_produk'],2,",","."); ?></h5>
                        <a href="index.php?hal=beli&id=<?php echo $rows['id_produk']; ?>" class="btn btn-primary">BUY</a>
                        <a href="index.php?hal=detail&id=<?php echo $rows['id_produk']; ?>" class="btn btn-info">Detail</a>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</body>
</html>  