<?php
session_start();
include 'koneksi.php';
//jika tidak ada session customer
if(!isset($_SESSION["customer"]) OR empty($_SESSION["customer"]))
{
    echo "<script>alert('Silahkan Login Terlebih Dahulu'); document.location='index.php?hal=login';</script>";
    exit();
}
//mendapatkan id_customer dri url
$idpem = $_GET["id"]; 
$ambil = $conn->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($detpem);
// echo "</pre>";
//mendapatkan id_customer yang beli
$id_customer_beli = $detpem["id_customer"];
//mendapatkan id_customer yg login
$id_customer_login = $_SESSION["customer"]["id_customer"];

if($id_customer_login !==$id_customer_beli)
{
    echo "<script>alert('Ra entuk GOBLOK'); document.location='riwayat_belanja.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pembayaran</title>
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
        <h2>Konfirmasi Pembayaran</h2>
        <p>Kirim Bukti Pebayaran Anda disini :</p>
        <div class=" alert alert-info">Total Tagihan Anda : <strong><?php echo "Rp. ".number_format($detpem["total_pembelian"],2,",",".");  ?></strong> </div>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Nama Penyetor</label>
                <input type="text" name="nama" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Bank</label>
                <select class="form-control" name="bank">
                    <option value="">Pilih Pembayaran</option>
                    <option value="BANK MANDIRI">BANK MANDIRI</option>
                    <option value="BANK BCA">BANK BCA</option>
                    <option value="BANK BRI">BANK BRI</option>
                    <option value="INDOMART">INDOMART</option>
                    <option value="ALFAMART">ALFAMART</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Jumlah</label>
                <input name="jumlah" class="form-control" type="number"> 
            </div>
            <div class="form-group">
                <label for="">Foto Bukti</label>
                <input type="file" name="bukti" id="" class="form-control">
                <p class="text-danger">*Format gambar harus JPG max 2MB</p>
            </div>
            <button type="submit" class="btn btn-primary" name="kirim">KIRIM</button>
        </form>
        <?php
        if(isset($_POST["kirim"]))
        {
            //upload foto
            $namabukti = $_FILES["bukti"]["name"];
            $lokasibukti = $_FILES["bukti"]["tmp_name"];
            $namafiks = date(YmdHis).$namabukti;
            move_uploaded_file($lokasibukti,"bukti_pembayaran/$namafiks");
            $nama = $_POST["nama"];
            $bank = $_POST["bank"];
            $jumlah = $_POST["jumlah"];
            $tanggal = date("Y-m-d");

        //     //simpan pembayaran
            $conn->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal_pembayaran,bukti_pembayaran) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks')");

        //     //update status pembayaran
            $conn->query("UPDATE pembelian SET status_pembayaran='Terbayar Sudah' WHERE id_pembelian='$idpem'");
             echo "<script>alert('Terima Kasih sudah melakukan pembayaran'); document.location='riwayat_belanja.php';</script>";
             exit();

        }
        ?>

    </div>
</body>
</html>