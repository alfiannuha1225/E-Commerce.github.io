<h2>Tambah Produk</h2>

<form enctype="multipart/form-data" method="post">
<div class="form-group">
    <label>Nama Barang</label>
    <input class="form-control" type="text" name="nama">
</div>
<div class="form-group">
    <label>Jumlah</label>
    <input class="form-control" type="number" name="jumlah">
</div>
<div class="form-group">
    <label>Harga (Rp.)</label>
    <input class="form-control" type="number" name="harga">
</div>
<div class="form-group">
    <label>Berat</label>
    <input class="form-control" type="number" name="berat">
</div>
<div class="form-group">
    <label>Foto</label>
    <input class="form-control" type="file" name="foto">
</div>
<div class="form-group">
    <label>Deskripsi</label>
    <input class="form-control" type="text" name="deskripsi" rows="10">
</div>
<button class="btn btn-info" name="save">Simpan</button>
</form>

<?php
if(isset($_POST['save'])) 
{
    include '../koneksi.php';
    $nama = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasi,"../foto_produk/".$nama);
    $conn->query("INSERT INTO produk (nama_produk,jumlah_produk,harga_produk,berat_produk,foto_produk,deskripsi_produk) VALUES ('$_POST[nama]','$_POST[jumlah]','$_POST[harga]','$_POST[berat]','$nama','$_POST[deskripsi]')");
    
    echo "<div class='alert alert-info'>Data Tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?hal=produk/produk'>";

}
?>



