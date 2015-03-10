<!DOCTYPE html>
<head>
    <title>Добавить данные</title>
    <meta http-equiv="content-type" content="text/html; charset=utf8" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script type="text/javascript" src="lib/jquery-2.1.3.min.js"> </script>
</head>
<body>
<div id="holder">

    <?php
    require_once "blocks/header.php";
    require_once "blocks/menu.php";
    require_once "blocks/undermenu.php";
    require_once "lib/add_message_henlder.php";
    ?>

    <div id="content" >
        <!-- Document starts. -->
        <p id="error"></p>
        <form action="add_res.php" method="post" id="ajaxform" enctype="multipart/form-data"
            Поля с <span>*</span> обязательны для заполнения!<br><br>

            Ваше имя <span>*</span> <br>
            <input type="text" name="name" size="40"/><br><br>
            E-mail  <span>*</span><br>
            <input type="text" name="mail" size="40"/><br><br>
            Home page  <br>
            <input type="text" name="home_page" size="40"/><br><br>

            Сообщение <span>*</span> <br>
            <button form="" id="button_strong">[<strong>strong</strong>]</button>
            <button form="" id="button_strike">[<strike>strike</strike>]</button>
            <button form="" id="button_italic">[<i>italic</i>]</button>
            <button form="" id="button_code">[code]</button>
            <button form="" id="button_link">[link]</button>

            <textarea id="message" name="message" rows="7" cols="70"></textarea> <br>

            <button form="preview" id="button_preview">Предпросмотр</button> <br><br>
            Картинка или тектовый файл <br>
            <input type="file" name="load" id="fileload" accept="image/jpeg, image/png, image/gif, .txt"/><br><br>

            <img id="captcha" style="border: 1px solid gray;" src = "captcha/captcha.php" width="120" height="40"/>
            <img id="refresh" src="img/refresh.png"><br><br>
            Введите текст с картинки <span>*</span> <br>
            <input type="text" name="check_captcha" size="10" />

            <input type="hidden" value="submit">

            <br><br>
            <input type="submit" value="Добавить">


        </form>

        <form action="lib/preview_message.php" method="post" id="preview" target="_blank">
            <input id="preview_message" name="preview_message" type="hidden" value="">
        </form>

        <!-- Document ends. -->
    </div>
</div>
</body>
