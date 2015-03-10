<?php
    function changeTag($str){
        $bbcode = array("[strong]", "[strike]", "[italic]", "[code]", "[/strong]", "[/strike]", "[/italic]", "[/code]");
        $htmltag   = array("<strong>", "<strike>", "<i>", "<code>", "</strong>", "</strike>", "</i>", "</code>");
        $newphrase = str_replace($bbcode, $htmltag, $str);

        $newphrase = preg_replace_callback('/\[url=(.*)\](.*)\[\/url\]/Usi', function($match) {
            return '<a href="'.$match[1].'" target="_blank">'.(empty($match[2]) ? $match[1] : $match[2]).'</a>';
        }, $newphrase);
        return $newphrase;
    }
?>
