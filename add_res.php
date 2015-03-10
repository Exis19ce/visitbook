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
        require_once "setting.php";
    ?>
        <?php
        if (isset($_POST["name"])) {
            $file_type = $_FILES['load']['type'];
            $file_name = $_FILES['load']['name'];


            if ($_FILES['load']['error'] != 0) {
            } elseif ($file_type == 'text/plain') {
                if ($_FILES['load']['size'] < 102400) {
                    $file_name_save = '/file/' . date("Ymd_His") . 'txt' . rand(100, 999) . '.txt';
                    move_uploaded_file($_FILES['load']['tmp_name'], '.' . $file_name_save);
                } else {
                    echo "<p3>Размер файла больше 100кб! Файл не был загружен!</p3>";
                }

            } else {
                $temp = getimagesize($_FILES['load']['tmp_name']);
                $tmp_name = $_FILES['load']['tmp_name'];
                $filename = $file_name;
                $file_name_save = '/file/' . date("Ymd_His") . 'img' . rand(100, 999) . '.png';

                // Пропорциональное уменьшение
                list($width_orig, $height_orig) = $temp;

                if ($width_orig / $height_orig >= 320 / 240) {
                    $width = 320;
                    $height = $height_orig / ($width_orig / 320);
                } else {
                    $height = 240;
                    $width = ceil($width_orig / ($height_orig / 240));
                }

                $image_p = imagecreatetruecolor($width, $height);

                if ($file_type == 'image/jpeg') {
                    $image = imagecreatefromjpeg($tmp_name);
                } elseif ($file_type == 'image/png') {
                    $image = imagecreatefrompng($tmp_name);
                } elseif ($file_type == 'image/gif') {
                    $image = imagecreatefromgif($tmp_name);
                }
                imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                imagepng($image_p, $tmp_name, 0);
                imagedestroy($image_p);
                move_uploaded_file($_FILES['load']['tmp_name'], '.' . $file_name_save);
            }

            $name = mysql_real_escape_string(htmlspecialchars($_POST["name"]));
            $email = mysql_real_escape_string(htmlspecialchars($_POST["mail"]));
            $home_page = mysql_real_escape_string(htmlspecialchars($_POST["home_page"]));
            $message = mysql_real_escape_string(htmlspecialchars($_POST["message"]));

            $ip = $_SERVER['SERVER_ADDR'];
            $browser = $_SERVER['HTTP_USER_AGENT'];


            $connection = mysql_connect("$bd_host_name", "$bd_user_name", "$bd_user_password");
            if(!$connection){
                exit(mysql_error());
            }
            if(!mysql_select_db($bd_table_name, $connection)){
                exit(mysql_error());
            }

            $result = mysql_query("INSERT INTO message(name, date, home_page, mail, text, ip, browser, file)
                           VALUES ('$name', now(), '$home_page', '$email',  '$message', '$ip', '$browser', '$file_name_save')");

            if ($result) {
                echo '<h1 style="color: green; font-size: 24px">Сообщение успешно добавлено</h1>';
            } else {
                echo '<h1>Произошла ошибка базы данных. Сообщение не добавлено</h1>';
            }
        }
        ?>
        <!-- Document ends. -->
</div>
</body>
