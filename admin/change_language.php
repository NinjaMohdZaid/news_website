<?php
 session_start();
if(!empty($_REQUEST['lang_code']) && !empty($_REQUEST['redirect_url'])){
    $_SESSION['lang_code'] = $_REQUEST['lang_code'];
    // print_r($_REQUEST['lang_code']);
    // print_r($_SESSION['lang_code']);
    // die($_REQUEST['redirect_url']);
    header('Location:'.$_REQUEST['redirect_url']);
}