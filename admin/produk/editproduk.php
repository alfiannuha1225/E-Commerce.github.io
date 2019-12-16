<h2>Edit Produk</h2>

<?php
include '../koneksi.php';
$ambil = $conn->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
// echo "<pre>";
// print_r($pecah);
// echo "</pre>"
?>

<form enctype="multipart/form-data" method="post">
<div class="form-group">
    <label>Nama</label>
    <input class="form-control" type="text" name="nama" value="<?php echo $pecah['nama_produk'] ?>">
</div>
<div class="form-group">
    <label>Jumlah</label>
    <input class="form-control" type="number" name="jumlah" value="<?php echo $pecah['jumlah_produk'] ?>">
</div>
<label>Harga (Rp.)</label>
<div class="form-group input-group">
    <span class="input-group-addon">Rp.</span>
    <input class="form-control" type="number" name="harga" value="<?php echo $pecah['harga_produk'] ?>">
    <span class="input-group-addon">.00</span>
</div>
<label>Berat</label>
<div class="form-group input-group">
    <input class="form-control" type="text" name="berat" value="<?php echo $pecah['berat_produk'] ?>">
    <span class="input-group-addon">gram</span>
</div>
<div class="form-group">
    <label>Foto</label>
    <img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200"> 
    <br> <br>
    <input class="form-control" type="file" name="foto">
</div>
<div class="form-group">
    <label>Deskripsi</label>
    <textarea class="form-control" name="deskripsi" rows="10" ><?php echo $pecah['deskripsi_produk'] ?>
    </textarea>
</div>
<button class="btn btn-info" name="edit">Edit</button>
</form>

<?php
    if(isset($_POST['edit']))
    {
        $namafoto = $_FILES['foto']['name'];
        $lokasifoto = $_FILES['foto']['tmp_name'];
        //jika foto dirubah
        if(!empty($lokasifoto))
        {
            move_uploaded_file($lokasifoto,"../foto_produk/$namafoto");

            $conn->query("UPDATE produk SET nama_produk='$_POST[nama]',jumlah_produk='$_POST[jumlah]',harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',foto_produk= '$namafoto',deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
        }
        else 
        {
            $conn->query("UPDATE produk SET nama_produk='$_POST[nama]',jumlah_produk='$_POST[jumlah]',harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
        }
        echo "<script>alert('Berhasil mengedit data.'); document.location='index.php?hal=produk/produk';</script>";        
    }
?>
