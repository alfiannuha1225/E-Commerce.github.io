<?php

session_start();

include 'koneksi.php';
if(!isset($_SESSION["customer"]))
{
    echo "<script>alert('Silahkan Login Terlebih Dahulu'); document.location='index.php?hal=login';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body>
<?php
//include 'navbar.php';
?>
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
    <section>
        <div class="container">
            <h1>Checkout</h1>
            <table class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    $totalbelanja = 0;
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
                    </tr>
                    <?php 
                    $no++;
                    $totalbelanja+=$subharga;
                    ?>
                    <?php 
                    endforeach;
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Belanja</th>
                        <th><?php echo "Rp. ".number_format($totalbelanja,2,",","."); ?> </th>
                    </tr>
                </tfoot>
            </table>
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo $_SESSION['customer']['nama_customer'] ?>"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo $_SESSION['customer']['telepon_customer'] ?>"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="id_ongkir" class="form-control">
                            <option value="">Pilih Ongkor Kirim</option>
                            <?php
                                $ambil = $conn->query("SELECT * FROM ongkir"); 
                                while($perongkir = $ambil->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $perongkir['id_ongkir']; ?>">
                                <?php echo $perongkir['nama_kota']; ?> -
                                <?php echo "Rp. ".number_format($perongkir['tarif_ongkir'],2,",","."); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="from-group">
                <label for="">Alamat Pengiriman</label>
                <textarea name="alamat_pengiriman" class="form-control" id="" cols="30" placeholder="Masukkan Alamat Pengiriman dan Kode Pos Anda"></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="checkout">Checkout</button>
            </form>
            <?php
            if(isset($_POST["checkout"]))
            {
                $id_customer = $_SESSION["customer"]["id_customer"];
                $id_ongkir = $_POST["id_ongkir"];
                $tanggal = date("Y-m-d");
                $alamat = $_POST['alamat_pengiriman'];

                $ambil = $conn->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
                $ongkir = $ambil->fetch_assoc();
                // $nama_kota = $ongkir['nama_kota'];
                $tarif = $ongkir['tarif_ongkir'];
                $total_pembelian = $totalbelanja + $tarif; 

                //1. menyimpan data ke tabel pembelian
                // $conn->query("INSERT INTO pembelian (id_customer,id_ongkir,tanggal_pembelian,total_pembelian,tarif_ongkir) VALUES ('$id_customer','$id_ongkir','$tanggal', '$total_pembelian','$tarif')");
                $conn->query("INSERT INTO pembelian(id_customer,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif_ongkir,alamat_pengiriman) VALUES ('$id_customer','$id_ongkir','$tanggal', '$total_pembelian','$nama_kota','$tarif','$alamat')");

                //mendapatkan id pembelian barusan

                $id_pembelian_barusan = $conn->insert_id;

                foreach($_SESSION["keranjang"] as $id_produk => $jumlah)
                 {

                //   //mendapatkna data produk berdasarkan id_produk
                $ambil = $conn->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                $perproduk = $ambil->fetch_assoc();

                $nama = $perproduk['nama_produk'];
                $jumlah_produk = $perproduk['jumlah_produk'];
                $harga = $perproduk['harga_produk'];
                $berat = $perproduk['berat_produk'];
                $subberat = $perproduk['berat_produk']*$jumlah;
                $subharga = $perproduk['harga_produk']*$jumlah;
                

                $conn->query("INSERT INTO pembelian_produk(id_pembelian, id_produk,nama,harga,berat,subberat,subharga,jumlah) VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");

                // //update database 
                $conn->query("UPDATE produk SET jumlah_produk=jumlah_produk - $jumlah WHERE id_produk='$id_produk'");

                }

                // // //mengosongkan keranjang

                unset($_SESSION["keranjang"]);
                // // //tampilan dialihkan kehalaman nota
                echo "<script>alert('Pembelian Sukses');document.location='nota.php?id=$id_pembelian_barusan';</script>";
            }
            ?>
        </div>
    </section>

    <pre>
        <?php print_r($_SESSION["customer"]) ?>
        <?php print_r($_SESSION["keranjang"]) ?>
    </pre>
</body>

</html>