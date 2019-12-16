<?php
        session_start();
    include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script> -->

	<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
</head>

<body>
<?php
//include 'navbar.php';
?>
<!-- <nav class="navbar navbar-expand-md navbar-light bg-light">
  <a class="navbar-brand" href="index.php">MEMBER AREA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active" >
        <a class="nav-link" href="index.php?hal=barang">Barang</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?hal=keranjang">Keranjang</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?hal=login">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?hal=daftar">Daftar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?hal=checkout">Checkout</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="pencarian.php" method="get">
      <input class="form-control mr-sm-2" name="keyword" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav> -->
<nav class="navbar navbar-default">
    <div class="container">
        <a href="index.php" class="navbar-brand" style="color: black">MEMBER AREA</a>
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="index.php?hal=barang">Barang</a></li>
                <li><a href="index.php?hal=keranjang">Keranjang</a></li>
                <li><a href="index.php?hal=login">Login</a></li>
                <li><a href="index.php?hal=daftar">Daftar</a></li>
                <li><a href="index.php?hal=checkout">Checkout</a></li>

            </ul>
            <form action="pencarian.php" method="get" class="navbar-form navbar-right">
                <input type="text" name="keyword" id="" class="form-control">
                <button name="cari" class="btn btn-primary">GO</button>
            </form>

        </div>
    </div>
</nav>    
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
                    if(!isset($_GET['hal'])){
                        echo "<h3 style='align:center'>SELAMAT DATANG DAN SELAMAT BERBELANJA</h3>";
                    }
                    else
                    {
                        include "$_GET[hal].php";
                    }
                    ?>
        </div>
    </div>
</div>
</body>

</html>
