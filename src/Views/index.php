<?php include(__DIR__ . "/common/header.php");?>
<h1><?php echo $header;?></h1>
<?php if(count($albums) > 0){?>
    <ol>
        <?php foreach($albums as $album){?>
            <li><?php echo $album["name"];?></li>
        <?php }?>
    </ol>
<?php }?>
<?php include(__DIR__ . "/common/footer.php");?>