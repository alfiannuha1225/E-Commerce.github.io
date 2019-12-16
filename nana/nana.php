<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div id="wrapper">
        <form action="" method="post" onsubmit="return Validate()" name="vform">
            <div>
                <input type="text" name="username" id="" class="textInput" placeholder="Username">
                <div id="name_error" class="val_error"></div>
            </div>
            <div>
                <input type="email" name="email" id="" class="textInput" placeholder="Email">
                <div id="email_error" class="val_error"></div>
            </div>
            <div>
                <input type="password" name="password" id="" class="textInput" placeholder="Password">
            </div>
            <div>
                <input type="password" name="password_confirmation" id="" class="textInput" placeholder="Password Confirmation">
                <div id="password_error" class="val_error"></div>
            </div>
            <div>
                <input type="submit" value="Register"  id="" class="btn btn-danger" name="register" >
            </div>
        </form>
    </div>
</body>

</html>