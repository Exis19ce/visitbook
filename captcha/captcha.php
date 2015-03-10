<?php
$letters = '0123456789QWERTYUOPASDFGHJKLZXCVBNMqwertyuiopasdfghjkzxcvbnm';

$captcha_length = 5;
$width = 120; $height = 30;
$font = 'arial.ttf';
$fontsize = 14;

header('Content-type: image/png');

$im = imagecreatetruecolor($width, $height);
imagesavealpha($im, false);
$bg = imagecolorallocatealpha($im, rand(0, 150), rand(0, 150), rand(0, 150), 127);
imagefill($im, 0, 0, $bg);

putenv( 'GDFONTPATH=' . realpath('.') );

$captcha = '';
for ($i = 0; $i < $captcha_length; $i++)
{
    $captcha .= $letters[ rand(0, strlen($letters)-1) ];
    $x = ($width - 20) / $captcha_length * $i + 10;
    $x = rand($x, $x+4);
    $y = $height - ( ($height - $fontsize) / 2 );
    $curcolor = imagecolorallocate( $im, rand(0, 150), rand(0, 150), rand(0, 150) );
    $angle = rand(-25, 25);
    imagettftext($im, $fontsize, $angle, $x, $y, $curcolor, $font, $captcha[$i]);
}

session_start();
$_SESSION['captcha'] = $captcha;

imagepng($im);
imagedestroy($im);
?>