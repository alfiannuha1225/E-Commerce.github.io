<?php
// session_start();
include 'koneksi.php';

// echo "<pre>";
// print_r($_SESSION['keranjang']);
// echo "</pre>";

if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
    // header("location:index.php?hal=barang");
    echo "<script>alert('Keranjang Kosong, Silahkan Belanja Terlebih Dahulu.'); document.location='index.php?hal=barang';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>keranjang</title>
</head>
<body>
<?php
//include 'navbar.php';
?>
<!-- <nav class="navbar navbar-default">
    <div class="container">
        brand
        <a href="index.php" class="navbar-brand" style="color: black">MEMBER AREA</a>
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="barang.php">Barang</a></li>
                <li><a href="keranjang.php">Keranjang</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="daftar.php">Daftar</a></li>
                <li><a href="checkout.php">Checkout</a></li>
            </ul>
        </div>
    </div>
</nav>     -->
    <section>
    <div class="container">
        <h1>Keranjang Belanja</h1>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no=1;
                    foreach($_SESSION['keranjang'] as $idproduk=>$jumlah):
                    $ambil = $conn->query("SELECT * FROM produk WHERE id_produk='$idproduk'");
                    $pecah = $ambil->fetch_assoc();
                    $subharga = $pecah['harga_produk']*$jumlah;
                ?>

                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $pecah['nama_produk']; ?></td>
                    <td><?php echo "Rp. ".number_format($pecah['harga_produk'],2,",","."); ?></td>
                    <td><?php echo $jumlah; ?></td>
                    <td><?php echo "Rp. ".number_format($subharga,2,",","."); ?></td>
                    <td>
                        <a href="index.php?hal=hapus&id=<?php echo $idproduk;?>" class="btn btn-warning">Hapus</a>
                    </td>
                </tr>
                <?php 
                 $no++;
                ?>
                <?php 
                endforeach;
                ?>
            </tbody>
        </table>
        <a href="index.php?hal=barang" class="btn btn-primary">Lanjutkan Belanja</a>
        <a href="index.php?hal=login" class="btn btn-default">Checkout</a>
    </div>
    </section>
    </body>
    </html>