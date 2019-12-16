<h2>DATA PEMBAYARAN</h2>
<?php
include '../koneksi.php';

$id = $_GET["id"];
$ambil = $conn->query("SELECT * FROM pembayaran WHERE id_pembelian='$id'");
$pecah = $ambil->fetch_assoc();

?>

<!-- <pre><?php //echo //print_r($pecah); ?></pre> -->

<div class="row">
    <div class="col-md-6">
        <table class="table">
                <tr>
                    <th>Nama</th>
                    <th><?php echo $pecah["nama"] ?></th>
                </tr>
                <tr>
                    <th>Bank</th>
                    <th><?php echo $pecah["bank"] ?></th>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <th><?php echo "Rp. ".number_format($pecah["jumlah"],2,",",".") ?></th>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <th><?php echo $pecah["tanggal_pembayaran"] ?></th>
                </tr>
        </table>
    </div>
    <div class="col-md-6">
        <img src="../../bukti_pembayaran/<?php echo $pecah['bukti_pembayaran'] ?>" class="img-responsive">
    </div>
</div>


<form action="" method="post">
    <div class="form-group">
        <label for="">No Resi Pengiriman</label>
        <input type="text" name="resi" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Status</label>
        <select name="status" id="" class="form-control">
            <option value="">Pilih Status</option>
            <option value="lunas">Lunas </option>
            <option value="barang dikirim">Barang Dikirim</option>
            <option value="batal">Batal</option>
        </select>
    </div>
    <button type="submit"class="btn btn-primary" name="proses">Proses</button>
</form>

<?php
if(isset($_POST["proses"]))
{
    $resi = $_POST["resi"];
    $status = $_POST["status"];
    $conn->query("UPDATE pembelian SET resi_pengiriman='$resi' ,status_pembayaran='$status' WHERE id_pembelian='$id'");
    echo "<script>alert('Data Pembelian Terupdate'); document.location='index.php?hal=pembeli/pembeli';</script>";
}

?>