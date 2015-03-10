<?php

if ($_POST) {
    $name = mysql_real_escape_string(htmlspecialchars($_POST["name"]));
    $email = mysql_real_escape_string(htmlspecialchars($_POST["mail"]));
    $home_page = mysql_real_escape_string(htmlspecialchars($_POST["home_page"]));
    $message = mysql_real_escape_string(htmlspecialchars($_POST["message"]));
    $captcha = htmlspecialchars($_POST["check_captcha"]);
    $json = array();

    if (!$name or !$email or !$message) {
        $json['error'] = 'Вы заполнили не все поля!';
        echo json_encode($json);
        die();
    }
    if (!preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $email)) {
        $json['error'] = 'Не верный формат email!';
        echo json_encode($json);
        die();
    }
    if (!preg_match('/^[a-zA-Z0-9]+$/', trim($name))) {
        $json['error'] = 'Имя пользователя введено не корректно!';
        echo json_encode($json);
        die();
    }


    $openbb = array("[strong]", "[strike]", "[italic]", "[url=", "[code]");
    $closebb = array("[/strong]", "[/strike]", "[/italic]", "[/url]", "[/code]");

    function substr_count_array($needle) {
        $mm = $_POST["message"];
        $count = 0;
        foreach ($needle as $haystack) {
            $count += substr_count( $mm, $haystack);
        }
        return $count;
    }

    if(substr_count_array($openbb) != substr_count_array($closebb)) {
        $json['error'] = 'Не корректные теги' ;
        echo json_encode($json);
        die();
    }


    session_start();
    if($captcha != $_SESSION['captcha']) {
        $json['error'] = 'Не правильный проверочный код!! ' ;
        echo json_encode($json);
        die();
    }

    echo json_encode($json);
} else {
    echo 'GET LOST!';
}

?>