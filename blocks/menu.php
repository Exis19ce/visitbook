<div id="menu">
    <style>
        .img{
            height: 10px;
            width: auto;
        }
    </style>

    <?php
        if ($_GET['order'] == 'DESC'){
            echo <<<HERE

            <style>
                .img{
                    height: 10px;
                    width: auto;
                    transform: rotate(180deg);
                }
            </style>

HERE;
        }
    ?>

    <?php $order = ASC; ?>

    Упорядочить по:

    <? if ($_GET['type']== 'name'): ?>

        <?php
            if ($_GET['order']== 'ASC'){
                $order = DESC;
            }
        ?>

        <img  class="img" src="../img/arrow1.png">
    <?endif?>
    <a href="index.php?type=name&order=<? echo $order ?>">Имени </a>


    <? if ($_GET['type']== 'mail'): ?>

        <?php
            if ($_GET['order']== 'ASC'){
                $order = DESC;
            }
        ?>

        <img  class="img" src="../img/arrow1.png">
    <?endif?>
    <a href="index.php?type=mail&order=<? echo $order ?>">Почте </a>


    <? if ($_GET['type']== 'date'): ?>

        <?php
            if ($_GET['order']== 'ASC'){
                $order = DESC;
            }
        ?>

        <img  class="img" src="../img/arrow1.png">
    <?endif?>
    <a href="index.php?type=date&order=<? echo $order ?>">Дате </a>

</div>
