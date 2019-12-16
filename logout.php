<?php
    session_start();

session_destroy();
header("location:index.php?hal=barang");

// echo "<script>alert('Anda Berhasil Logout'); document.location='index.php';</script>"; 
?>