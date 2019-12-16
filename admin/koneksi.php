<?php
    $conn = mysqli_connect('localhost', 'root', '', 'toko');

//check conection
if(mysqli_connect_errno()){
    echo "koneksi gagal :" .mysqli_connect_error();
}

?>