<?php
require("../entities/func.php");
$obj= new news_functions();
header('Access-control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-control-Allow-Methods:DELETE');
header('Access-control-Allow-Headers:Content-type,Access-Control-Allow-Headers,Authorization,X-Request-With');
$data = json_decode(file_get_contents("php://input"));
if(!empty($data->comment_id)){
    $response = $obj->fn_delete_news_comment($data->comment_id);
}else{
    $error = true;
    $msg = 'comment_id is required';
}
if(!empty($error)){
    $error_array = ['success'=> false,'message' => $msg];
    echo json_encode($error_array);
}else{
    $msg = 'Comment Deleted Successfully';
    $success_array = ['success'=> true,'message' => $msg];
    echo json_encode($success_array);
}
