<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - E-Laundry</title>
    <link rel="stylesheet" href="login_style.css">
    <link rel="icon" href="gambar/favicon.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="wrapper">
        <form action="login.php" method="POST" id="login-form">
            <h1><img src="gambar/logo.png" alt="logo e-laundry"></h1>
            <h2>Masuk</h2>
            <h3>Selamat Datang. Masuk menggunakan akun Anda.</h3>
            <div class="input-box">
                <input type="text" name="uname" autocomplete="off" required>
                <label class="placeholder">Username</label>
                <i class='bx bx-user'></i>
                <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
            </div>
            <div class="input-box">
                <input id="password" type="password" name="password" required>
                <label class="placeholder">Password</label>
                <i class='bx bx-lock-alt'></i>
                <i class="fa-solid fa-eye" id="eye" onclick="toggle()"></i>
            </div>
            <input type="submit" value="Masuk" class="btn" id="masuk">
        </form>
    </div>
    <script>
        var state = false;
        function toggle(){
            if(state){
                document.getElementById("password").setAttribute("type","password");
                document.getElementById("eye").style.color='#ABABAB';
                state = false;
            }
            else{
                document.getElementById("password").setAttribute("type","text");
                document.getElementById("eye").style.color='#6F6CEC';
                state = true;
            }
        }
    </script>
</body>

</html>