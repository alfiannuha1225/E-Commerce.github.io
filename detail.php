<?php  
include 'koneksi.php';

//mendapatkan id_produk
$id_produk = $_GET['id'];

//ambil database
$ambil = $conn->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();
// echo "<pre>"; 
// print_r ($detail);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Produk</title>
</head>

<body>
<?php
//include 'navbar.php';
?>
    <section class="konten">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="foto_produk/<?php echo $detail['foto_produk'];  ?>" alt="" class="image-responsive">
                </div>
                <div class="col-md-6">
                    <h2><?php echo $detail['nama_produk'] ?></h2>
                    <h4><?php echo "Rp. ".number_format($detail ['harga_produk'],2,",","."); ?></h4>
                    <h5>Stok Barang : <?php echo $detail["jumlah_produk"]; ?> </h5>
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" min="1" id="" class="form-control" name="jumlah" max="<?php echo $detail["jumlah_produk"]; ?>">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary" name="beli">BUY</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                        if(isset($_POST["beli"]))
                        {
                            $jumlah = $_POST["jumlah"];
                            $_SESSION["keranjang"]["$id_produk"] = $jumlah;
                            echo "<script>alert('Produk Sudah Masuk ke keranjang'); document.location='index.php?hal=keranjang';</script>";

                        }

                    ?>
                    <p><?php echo $detail['deskripsi_produk']; ?></p>
                </div>
            </div>
        </div>
    </section>
</body>

</html>