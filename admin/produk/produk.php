<?=
include '../koneksi.php';
?>

<h2>Data Produk</h2>

<a href="index.php?hal=produk/tambahproduk" class="btn btn-success">Tambah Produk</a>
<br> <br>
<table class="table table-striped table-bordered table-responsive table-condensed table-hover">
  <thead>
    <tr>
      <th>No. </th>
      <th>Nama Produk</th>
      <th>Jumlah</th>
      <th>Harga</th>
      <th>Berat(gram)</th>
      <th>Picture</th>
      <th>Description</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php $no=1; 
            $ambil = $conn->query("SELECT * FROM produk"); 
            while($pecah = $ambil->fetch_assoc()) 
            {       
        ?>
      <td><?php echo $no; ?></td>
      <td><?php echo $pecah['nama_produk']; ?></td>
      <td><?php echo $pecah['jumlah_produk']; ?></td>
      <td><?php echo "Rp. ". number_format($pecah['harga_produk'],2,",","."); ?></td>
      <td><?php echo $pecah['berat_produk']; ?></td>
      <td>
        <img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100">
      </td>
      <td><?php echo $pecah['deskripsi_produk']; ?></td>
      <td>
        <a href="index.php?hal=produk/hapusproduk&id=<?php echo $pecah['id_produk']; ?>"
          class="btn btn-danger">Hapus</a>
        <a href="index.php?hal=produk/editproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-primary">Edit</a>
      </td>
    </tr>
    <?php 
        $no++; 
        } 
     ?>
  </tbody>
</table>