<?php
// session_start();
//mendapatkan idproduk dri url
$idproduk = $_GET['id'];

//jika sudah ada produk dikeranjang, maka produk itu jumlahnya di + 1
if(isset($_SESSION['keranjang'][$idproduk]))
{
    $_SESSION['keranjang'][$idproduk]+=1;
}
//selain itu (blm ada dikeranjang), maka dianggap beli 1
else 
{
    $_SESSION['keranjang'][$idproduk]=1;
}

echo "<script>alert('Produk Sudah dimasukkan ke Dalam Keranjang.'); document.location='index.php?hal=keranjang';</script>"
?>