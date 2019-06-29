<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$title?></title>
    <link rel="icon" href="./img/czx.ico">
    <link rel="shortcut icon" href="./img/czx.ico">    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="./main.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="./main.js"></script>
</head>
<body>
    <div class="container">
        <!-- 加载网页头 -->
        <?php include __DIR__.DS.$__layout.DS.'header.tpl.php'; ?>  

        <div class="page_box">
            <h1 class="title"><?=$title?></h1>
            <?php 
                $cont_blk = __DIR__.DS.$__layout.DS.$__cont_blk;
                if( file_exists( $cont_blk ) ) include $cont_blk;
            ?>
        </div>
    </div>
</body>
</html>
