<?php session_start();
require_once "class/vars.php";

if ($_POST['register-pressed']) {
    $email = mysql_real_escape_string(trim(stripslashes($_POST['email'])));
    $password = mysql_real_escape_string(stripslashes($_POST['password']));
    $rpasswd1 = mysql_real_escape_string(stripslashes($_POST['retyped-password']));
    $success = register1($email, $password, $rpasswd1);
    if ($success == 2) {
        $alt_page = 'main_logged';
    } else {
        $message = '<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button>'.$success.'</div>';
    }
}

if ($_POST['login-pressed']) {
    $username = mysql_real_escape_string(stripslashes($_POST['username']));
    $password = mysql_real_escape_string(stripslashes($_POST['password']));
    $success = checkLogin($username, $password);
    if ($success == 2) {
        $alt_page = 'main_logged';
    } else {
        $message = '<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button>'.$success.'</div>';
    }
}

if ($_POST['emailpressed']) {
    $email = mysql_real_escape_string(trim(stripslashes($_POST['email'])));
    $subject = mysql_real_escape_string(trim(stripslashes($_POST['subject'])));
    $message = mysql_real_escape_string(trim(stripslashes($_POST['message'])));
    $success = contactCheckSend($email, $subject, $message);
}
if ($alt_page) {
    $page = $alt_page;
} else {
    $page = getPage();
}
if ($page) {
    $page_content = displayContent($page);
} else {
    if ($_SESSION['user_logged']) {
        $page_content = displayContent('main_logged');
    } else {
        $page_content = displayMain();
    }
}
if ($page == 'logout') {
    session_destroy();
    $page_content = displayMain();
    $message = '<div class="alert alert-success"><button class="close" data-dismiss="alert">×</button>You have successfully logged out</div>';
}
$mastHead = displayMasthead();
$footer = displayFooter();
$head = displayHTMLHead();
//head
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo $head;
$body = <<< EOF
    $mastHead
    $message
    $page_content
    $footer
EOF;
echo $body;
?>