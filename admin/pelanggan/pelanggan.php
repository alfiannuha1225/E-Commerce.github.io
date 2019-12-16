<?=
include 'koneksi.php';
?>

<h2>Data Pelanggan</h2>

<table class="table table-striped table-bordered table-responsive">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>No. Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $no=1;
        $ambil = $conn->query("SELECT * FROM customer");
        while($pecah = $ambil->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $pecah['nama_customer'] ?></td>
            <td><?php echo $pecah['email_customer'] ?></td>
            <td><?php echo $pecah['nama_customer'] ?></td>
            <td><?php echo $pecah['telepon_customer'] ?></td>
            <td>
                <a href="" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php 
        $no++;
        }
        ?>
    </tbody>
</table>