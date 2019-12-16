<?=
include '../koneksi.php';
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
<h2>Data Pembelian</h2>

<table class="table table-striped table-bordered table-responsive" id="dataTables-example">
  <thead>
    <tr>
      <th>No.</th>
      <th>Nama Pelanggan</th>
      <th>Tanggal</th>
      <th>Status</th>
      <th>Total</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $no=1;
        $ambil = $conn->query("SELECT * FROM pembelian JOIN customer ON pembelian.id_customer=customer.id_customer");
        while($pecah = $ambil->fetch_assoc()) {
    ?>
    <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $pecah['nama_customer']; ?></td>
        <td><?php echo $pecah['tanggal_pembelian']; ?></td>
        <td><?php echo $pecah['status_pembayaran']; ?></td>
        <td><?php echo "Rp. ". number_format($pecah['total_pembelian'],2,",","."); ?></td>
        <td>
            <a href="index.php?hal=pembeli/detail&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-info">Detail</a>
            <?php if($pecah['status_pembayaran']!=="pending") : ?>
            <a href="index.php?hal=pembeli/pembayaran&id=<?php echo $pecah['id_pembelian']?>" class="btn btn-success">Lihat Pembayaran</a>
            <?php endif ?>
        </td>
    </tr>
    <?php 
    $no++;
    } 
    ?> 
  </tbody>
</table>
</body>
<!-- <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script> -->
</html>

