<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf8" />
    <link rel="stylesheet" type="text/css" href="../style.css" />
    <title>Предпросмотр сообщения</title>
</head>
<body>
<div id="holder" style="padding-top: 30px">
    <?php

    require_once "change_tag.php";

    echo changeTag($_POST["preview_message"]);

    ?>
</div>
</body>

