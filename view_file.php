<!DOCTYPE html>
<head>
    <title>Текстовый файл</title>
    <meta http-equiv="content-type" content="text/html; charset=utf8" />
    <link rel="stylesheet" type="text/css" href="../style.css" />
</head>
<body>
<div id="holder" style="padding-top: 30px">
<?php
        $fh = fopen( substr("$_GET[file]", 1), "r") or die("Can't open file!");
        while(!feof($fh)) {
            echo fgets($fh) . "<br />";
        }

        fclose($fh);
?>
</div>
</body>


