<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script type="text/javascript" src="./public/js/script.js" defer></script>
    <title>Button Clicker</title>
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
        <div class="menu">
            <div class="tab">
                <button id="profileButton" class="tablinks" onclick="showTab('profile')">Profile</button>
                <button id="rankingButton" class="tablinks" onclick="showTab('ranking')">Top 100</button>
                <button id="settingButton" class="tablinks" onclick="showTab('settings')">Settings</button>
            </div>
            <div class="body">
                <div id="profile">
                    <div class="score">Your Score:</div>
                    <div class="clicks">1234566789</div>
                </div>
                <div id="ranking" style="display: none">
                    <h1>hej</h1>
                </div>
                <div id="settings" style="display: none">
                    <h1>siema</h1>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
