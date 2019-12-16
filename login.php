<?php
// session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="admin/assets/font-awesome/fonts/fontawesome-webfont.svg">
</head>
<body>
<?php
//include 'navbar.php';
?>  
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Pelanggan</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post">
                        <label for="">Email</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <label for="">Password</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon fa fa-key">#</span>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary" name="login">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
//jika tombol simpan ditekan
if(isset($_POST["login"]))
{
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $ambil = $conn->query("SELECT * FROM customer WHERE email_customer='$email' AND password_customer='$pass'");

    //hitung akun yang ada
    $akuncocok = $ambil->num_rows;

    //jika 1 akun yg cocok maka login berhasil
    if($akuncocok==1)
    {
        //anda sudah login
        //mendapatkan akun dalam array
        $akun = $ambil->fetch_assoc();
        //simpan di session customer
        $_SESSION["customer"] = $akun;
        echo "<script>alert('Anda Berhasil Login');</script>";

        //jika sudah belanja
        if(isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
        {
            echo "<script>location='checkout.php';</script>";
        }
        else
        {
            echo "<script>location='riwayat_belanja.php';</script>";
        }
    } 
    else 
    {
        echo "<script>alert('Anda Gagal Login, Periksa Kembali Akun Anda'); document.location='index.php?hal=login';</script>";
    }
}
?>
</body>
</html>