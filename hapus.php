<?php
    session_start();

$idproduk = $_GET["id"];
unset($_SESSION["keranjang"][$idproduk]);

header("location:index.php?hal=keranjang");
// echo "<script>alert('Produk telah dihapus'); document.location='memberarea.php?hal=keranjang';</script>"; 


?>