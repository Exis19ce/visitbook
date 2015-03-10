<!DOCTYPE html>
<head>
    <title>Книга посетителей</title>
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
    require_once "lib/index_hendler.php";
    require_once "lib/change_tag.php";
    ?>

    <div id="content1">
        <!-- Document starts. -->


    <?php
        echo "<h2 style='text-align: center'><a href='add_message_view.php'>[Добавить запись]</a></h2>";

    $count_id = 0;
    while($myrow = mysql_fetch_array($result)):
            if(!$myrow){
                exit(mysql_error());
            }
    $count_id++;

    ?>

        <table class='table_usl'>
           <tr>
               <td class='td_name'>
                    <a><? echo $myrow[name]?>, </a>
                    <img class = "img_mail" src="/img/mail.png"><span class="mail"><? echo $myrow[mail]?></span>
               </td>

               <td class="date">
                    <span style="color : white"> <? echo changeFormatDate($myrow[date])?></span>
               </td>
           </tr>

           <tr>
               <td colspan="2" class='td_text'><p><? echo changeTag($myrow[text])?></p></td>
           </tr>

           <? if(file_exists(substr("$myrow[file]", 1))): ?>
               <tr>
                   <td colspan="2" class='td_text'>

               <?php

                    if (strpos("$myrow[file]", "txt")){
                        echo "<a target='_blank' style='font-size: 12px' href='view_file.php?type=txt&file=$myrow[file]'><i>Тектовый файл</i></a>";
                    }else{
                        echo "<button onclick='buttonFotoFunction($count_id)' style='font-size: 12px; background-color: inherit'>Фото</button><br>";
                        echo "<img id='$count_id'  src='$myrow[file]' style='display: none;  border:1px solid black;'>";

                    }
               ?>

                   </td>
               </tr>
           <? endif ?>

        </table>
    <? endwhile;?>

    <?php
        $res=mysql_query("SELECT count(*) FROM `message`");
        $row=mysql_fetch_row($res);
        $total_rows=$row[0];

        $num_pages=ceil($total_rows/$msg_per_page);

        for($i=1;$i<=$num_pages;$i++) {
            if ($i-1 == $page) {
                echo '<a class="page_non" >'.$i.'</a>';
            } else {
                echo '<a class="page" href='.$_SERVER['PHP_SELF'].'?page='.$i.'&type='.$sorting.'&order='.$order.'>'.$i."</a> ";
            }
        }

    ?>

        <!-- Document ends. -->
    </div>
</div>
</body>


