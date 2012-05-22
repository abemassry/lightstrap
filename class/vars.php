<?php

//commented while working on this code, will replace when project is further 
//along
//replaced with this line
require_once '../../vars.php';

//SQL vars
//$sql_host = 'localhost';
//$sql_user = 'gravity-user';
//$sql_pass = 'gravity-pass';
//$sql_db = 'gravity';

//directory vars
//$php_dir = '';
//$html_dir = '';
//
//function getPHPDir() {
//    $php_dir = '/var/www/gravity';
//    return $php_dir;
//}
//
//function getHTMLDir() {
//    $html_dir = '/gravity';
//    return $html_dir;
//}

function getPage() {
    if ($_GET['page']) {
        $page = mysql_real_escape_string(stripslashes($_GET['page']));
    } else {
        $page = '';
    }
    return $page;
}

require_once "class/connection.php";
require_once "class/dbq.php";
require_once "class/inputfunctions.php";
require_once "class/outputfunctions.php";
require_once "class/displayfunctions.php";
?>