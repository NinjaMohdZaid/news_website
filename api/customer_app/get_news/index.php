<?php
require("../entities/func.php");
$obj= new news_functions();
header('Access-control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-control-Allow-Methods:GET');
header('Access-control-Allow-Headers:Content-type,Access-Control-Allow-Headers,Authorization,X-Request-With');
$data = json_decode(file_get_contents("php://input"));
if(empty($_REQUEST['id'])){
    $news = $obj->fn_get_news($_REQUEST);
}else{
    $news = $obj->fn_get_news_data($_REQUEST['id']);
}
echo json_encode($news);
