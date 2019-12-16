<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>form</title>
    <!-- <script src="script.js"></script> -->
</head>
<body>
    <div id="error"></div>
    <form id="form" action="" method="get"> 
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="password">password</label>
            <input type="password" name="password" id="password">
        </div>
        <button type="submit">KIRIM</button>
    </form>

    <script>
    const name = document.getElementById('name')
    const password = document.getElementById('password')
    const form = document.getElementById('form')
    const errorElement = document.getElementById('error')

form.addEventListener('submit', (e) => {
    let messages = []
    if (name.value === '' || name.value == null) {
        messages.push("Nama Kosong silahkan Di Isi BOS")
    }
    if (password.value.length <= 6) {
        messages.push("MIN Password 6 huruf")
    }
    if (messages.length > 0) {
        e.preventDefault()
        errorElement.innerText = messages.join(', ')
    }
})
    
    </script>
</body>
</html>

