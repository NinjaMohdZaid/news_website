<?php
require("../entities/func.php");
$obj= new news_functions();
header('Access-control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-control-Allow-Methods:GET');
header('Access-control-Allow-Headers:Content-type,Access-Control-Allow-Headers,Authorization,X-Request-With');
$data = json_decode(file_get_contents("php://input"));
if(empty($_REQUEST['id'])){
    if(!empty($_REQUEST['lang_code'])){
        $lang_code = $_REQUEST['lang_code'];
    }else{
        $lang_code = 'en';
    }
    $categories = $obj->fn_get_categories($_REQUEST,0,$lang_code);
}else{
    if(!empty($_REQUEST['lang_code'])){
        $lang_code = $_REQUEST['lang_code'];
    }else{
        $lang_code = 'en';
    }
    $categories = $obj->fn_get_category_data($_REQUEST['id'],$lang_code);
}
echo json_encode($categories);
