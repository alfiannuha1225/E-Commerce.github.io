<?php
session_start();
include 'koneksi.php';
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
    <?php
//include 'navbar.php';
?>
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- brand -->
            <a href="index.php" class="navbar-brand" style="color: black">MEMBER AREA</a>
            <div class="container">
                <ul class="nav navbar-nav">
                    <li><a href="barang.php">Barang</a></li>
                    <li><a href="keranjang.php">Keranjang</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="daftar.php">Daftar</a></li>
                    <li><a href="checkout.php">Checkout</a></li>
                    <li><a href="riwayat_belanja.php">Riwayat Belanja</a></li>

                </ul>
            </div>
        </div>
    </nav>

    <section class="konten">
        <div class="container">
            <h2>Nota Pembelian</h2>
            <?php
            // include '../koneksi1.php';
            $id = $_GET["id"];
            $sql= "SELECT * FROM pembelian JOIN customer ON pembelian.id_pembelian='$id'";
            $result = $conn->query($sql);
            $detail = mysqli_fetch_assoc($result);
            ?>
            <pre><?php print_r($detail); ?> </pre>


            <p>
                <div class="row">
                    <div class="col-md-4">
                        <h3>Pembelian</h3>
                        <p>
                            Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
                            Jumlah : <?php echo "Rp. ".number_format($detail['total_pembelian'],2,",","."); ?> <br>
                            Status : <?php echo $detail['status_pembayaran'] ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h3>Palanggan</h3>
                        <strong><?php echo $detail['nama_customer']; ?></strong> <br>
                        <p>
                            Telepon : <?php echo $detail['telepon_customer']; ?> <br>
                            Email : <?php echo $detail['email_customer']; ?>
                        </p>

                    </div>
                    <div class="col-md-4">
                        <h3>Pengiriman</h3>
                        <strong><?php echo $detail['nama_kota'] ?></strong>
                        <p>
                            Tarif : <?php echo "Rp. ".number_format($detail['tarif_ongkir'],2,",",".") ?> <br>
                            Alamat : <?php echo $detail['alamat_pengiriman'] ?>
                        </p>
                    </div>
                </div>
            </p>

            <table class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtottal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
            $no=1;
            $ambil = $conn->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$id'");
            while ($pecah = $ambil->fetch_assoc()) {  
        ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $pecah['nama_produk']; ?></td>
                        <td><?php echo "Rp. ".number_format($pecah['harga_produk'],2,",","."); ?></td>
                        <td><?php echo $pecah['jumlah']; ?></td>
                        <td><?php echo "Rp. ".number_format($pecah['harga_produk']*$pecah['jumlah'],2,",","."); ?></td>
                    </tr>
                    <?php 
        $no++;
        }
        ?>
                </tbody>
            </table>

            <div class="row">
                <div class="col-md-7">
                    <div class="alert alert-info">
                        <p>
                            Silahkan Melakukan Pembayaran Rp . <?php echo number_format($detail['total_pembelian']);  ?> ke 
                            <br> <strong>BANK MANDIRI 137-4394302-2323 AN. Alfian An-Naufal Nuha</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>