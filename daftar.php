<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Daftar Pelanggan</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">Nama</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="nama" id="nama" 
                                    >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">Email</label>
                                <div class="col-md-7">
                                    <input type="email" class="form-control" name="email"id="email" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">Password</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="password" id="password" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">Alamat</label>
                                <div class="col-md-7">
                                    <textarea name="alamat" class="form-control" id="alamat" ></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">Telepon</label>
                                <div class="col-md-7">
                                    <input type="number"  class="form-control" name="telepon" id="telepon" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary" name="daftar" id="daftar">Daftar</button>
                                </div>
                            </div>
                        </form>
                        <?php
                        if(isset($_POST["daftar"]))
                        {
                           // mengambil isian diatas
                           $nama = $_POST["nama"];
                           $email = $_POST["email"];
                           $password = $_POST["password"];
                           $alamat = $_POST["alamat"];
                           $telepon = $_POST["telepon"];
                            //check apakah email sudah digunakan
                           $ambil = $conn->query("SELECT * FROM customer WHERE email_customer='$email'");
                           $emailcocok = $ambil->num_rows;
                           if($emailcocok==1)
                           {
                            echo "<script>alert('Pendaftaran gagal, Email sudah digunakan.'); document.location='index.php?hal=daftar';</script>";
                           }
                           else 
                           {
                            $conn->query("INSERT INTO customer(email_customer,password_customer,nama_customer,telepon_customer,alamat_customer) VALUES ('$email','$password','$nama','$telepon','$alamat')");
                            echo "<script>alert('Pendaftaran sukses, Silahkan Login.'); document.location='index.php?hal=login';</script>";
                           }
                        }
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script> 
 $(document).ready(function(){ 
   
   $('#myform').submit(function(){ 
    var nama = $('#nama').val().length; 
    var email = $('#email').val().length; 
    var password = $('#password').val().length; 
    var alamat = $('#alamat').val().length; 
    var telepon = $('#telepon').val().length; 
    $(".error").remove(); 
    if (nama == 0 ) { 
      $('#nama').after('<span class="error" style="color:red">Karakter Tidak Boleh Kosong</span>'); 
      return false; 
    }else if (nama > 50 ) { 
      $('#nama').after('<span class="error" style="color:red"><strong>MAX 50 character</strong></span>'); 
      return false; 
    } 
    else if(email == 0){ 
      $('#email').after('<span class="error" style="color:red">Karakter Tidak Boleh Kosong</span>'); 
      return false; 
    }else if(email > 30){ 
      $('#email').after('<span class="error" style="color:red"><strong>MAX 30 character</strong></span>'); 
      return false; 
    } 
    else if(password == 0){ 
      $('#password').after('<span class="error" style="color:red">Karakter Tidak Boleh Kosong</span>'); 
      return false; 
    }else if(password > 15){ 
      $('#password').after('<span class="error" style="color:red"><strong>MAX 15 character</strong></span>'); 
      return false; 
    }
    else if(alamat == 0){ 
      $('#alamat').after('<span class="error" style="color:red">Karakter Tidak Boleh Kosong</span>'); 
      return false; 
    }else if(alamat > 50){ 
      $('#alamat').after('<span class="error" style="color:red"><strong>MAX 50 character</strong></span>'); 
      return false; 
    }
    else if(telepon == 0){ 
      $('#telepon').after('<span class="error" style="color:red">Karakter Tidak Boleh Kosong</span>'); 
      return false; 
    }
    else{ 
      return true; 
    } 
   }); 
 
 
 }); 
</script>
</html>