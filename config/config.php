<?php

$GLOBALS['FWCONFIG']['MYSQL_HOST'] = "localhost";
$GLOBALS['FWCONFIG']['MYSQL_PORT'] = 3306;
$GLOBALS['FWCONFIG']['MYSQL_DBNAME'] = "czx_cv";
$GLOBALS['FWCONFIG']['MYSQL_USER'] = "root";
$GLOBALS['FWCONFIG']['MYSQL_PASSWD'] = "1208396032fcFC";
$GLOBALS['FWCONFIG']['MYSQL_DCN'] = "mysql:host=".$GLOBALS['FWCONFIG']['MYSQL_HOST'].";port=".$GLOBALS['FWCONFIG']['MYSQL_PORT'].";dbname=".$GLOBALS['FWCONFIG']['MYSQL_DBNAME'];


// $GLOBALS['TOKEN'] = 'oops';

// $pdo = new PDO($GLOBALS['FWCONFIG']['MYSQL_DCN'],$GLOBALS['FWCONFIG']['MYSQL_USER'],$GLOBALS['FWCONFIG']['MYSQL_PASSWD']);
// $pdo = new PDO(c('MYSQL_DCN'),c('MYSQL_USER'),c('MYSQL_PASSWD'));