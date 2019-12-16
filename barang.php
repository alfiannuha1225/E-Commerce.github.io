<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
//include 'navbar.php';
?>
<div class="content">
        <div class="container">
            <h3>Produk-Produk Indonesia</h3>
            <div class="row">
                <?php
                    $ambil = $conn->query("SELECT * FROM produk");
                    while($perproduk = $ambil->fetch_assoc()) {
                ?>
                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="foto_produk/<?php echo $perproduk['foto_produk'];  ?>" alt="" class="image-responsive">
                        <div class="caption">
                            <h3><?php echo $perproduk['nama_produk'] ?></h3>
                            <h5><?php echo "Rp. ".number_format($perproduk['harga_produk'],2,",","."); ?></h5>
                            <a href="index.php?hal=beli&id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">BUY</a>
                            <a href="index.php?hal=detail&id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-info">Detail</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
        </div>
    </div>
</body>
</html>