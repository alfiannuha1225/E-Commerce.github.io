<?php
include '../koneksi.php';
$semuadata=array();
$tgl_mulai="-";
$tgl_selesai="-";
if(isset($_POST["kirim"]))
{
    $tgl_mulai = $_POST["tglm"];
    $tgl_selesai = $_POST["tgls"];
    $ambil = $conn->query("SELECT * FROM pembelian LEFT JOIN customer ON pembelian.id_customer=customer.id_customer WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
    while($pecah = $ambil->fetch_assoc())
    {
        $semuadata[]=$pecah;
    }
    // echo "<pre>";
    // print_r($semuadata);
    // echo "</pre>";

}

?> 

<h2>Laporan Pembelian dari <?php echo $tgl_mulai ?> hingga <?php echo $tgl_selesai ?></h2>
<hr>

<form action="" method="post">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Tanggal Mulai</label>
                <input type="date" name="tglm" class="form-control">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Tanggal Selesai</label>
                <input type="date" name="tgls" class="form-control">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
            <label for="">&nbsp;</label> <br>
                <button type="submit" class="btn btn-success" name="kirim">Search</button>
            </div>
        </div>
    </div>
</form>


<table class="table table-striped table-bordered table-responsive">
    <thead>
        <tr>
            <th>No. </th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $total=0;
        $no=1;
        foreach($semuadata as $rows) :
            $total+=$rows["total_pembelian"];
    ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $rows["nama_customer"] ?></td>
            <td><?= $rows["tanggal_pembelian"] ?></td>
            <td>Rp<?= number_format($rows["total_pembelian"],2,",",".") ?></td>
            <td><?= $rows["status_pembayaran"] ?></td>
        </tr>
        <?php $no++; ?>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" class="text-center">TOTAL</th>
            <th><?= "Rp. ".number_format($total,2,",","."); ?></th>
            <th></th>
        </tr>
    </tfoot>
</table>