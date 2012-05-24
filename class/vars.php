<?php

//commented while working on this code, will replace when project is further 
//along
//replaced with this line
require_once 'vars2.php';

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

function getLoggedPage() {
    if ($_SESSION['user_logged']) {
        if ($_GET['loggedpage']) {
            $loggedpage = mysql_real_escape_string(stripslashes($_GET['loggedpage']));
        } else {
            $loggedpage = '';
        }
        return $loggedpage;
    } else {
        return '';
    }
}

require_once "connection.php";
require_once "dbq.php";
require_once "inputfunctions.php";
require_once "outputfunctions.php";
require_once "displayfunctions.php";
?>
