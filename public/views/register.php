<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script type="text/javascript" src="./public/js/script.js" defer></script>
    <title>Button Clicker Register</title>
</head>
<body>
    <div class="container">
        <div class="logo-title">
            <div class="title">BUTTON</div>
            <div class="title">CLICKER</div>
            <div class="logo">
                <img src="public/img/logo.svg">
            </div>
        </div>
        <div class="login-container">
            <form action="registerUser" method="POST">
                <h1>REGISTER</h1>
                <h3>Email</h3>
                <input name="email" type="text" placeholder="jan.kowalski@email.com">
                <h3>Password</h3>
                <input name="password" type="password" placeholder="***********">
                <div class="messages">
                    <?php if(isset($messages)) {
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <div class="buttons">
                    <button>LOGIN</button>
                    <button type="sumbit">OK</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
