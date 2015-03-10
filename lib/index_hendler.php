<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf8" />
    <script type="text/javascript" src="lib/jquery-2.1.3.min.js"> </script>
</head>

    <?php
    require_once "setting.php";

        $connection = mysql_connect("$bd_host_name", "$bd_user_name", "$bd_user_password");

        if(!$connection){
            exit(mysql_error());
        }
        if(!mysql_select_db($bd_table_name, $connection)){
            exit(mysql_error());
        }

        if (isset($_GET['page']))
            $page=($_GET['page']-1);
        else $page=0;

        $startpage = $page * $msg_per_page;

        if (!isset($_GET[type])){
            $sorting = "date";
        }else{
            $sorting = $_GET[type];
        }

        if (!isset($_GET[order])){
           $order = "DESC";
        }else{
            $order = $_GET[order];
        }

        $result = mysql_query("SELECT * FROM message ORDER BY $sorting $order LIMIT $startpage,$msg_per_page");
        if(!$result){
            exit(mysql_error());
        }

    function changeFormatDate($date){
        $time = strtotime($date);

        if (date("m.d.y") == date("m.d.y",$time)){
            return date("H:i:s",$time);
        }else{
            return date("d M Y", $time);
        }
    }

    ?>

<script>
    function buttonFotoFunction(foto_id){
        $( "#"+foto_id ).slideToggle(300);
    }
</script>


