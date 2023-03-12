<?php
require("../entities/func.php");
$obj= new news_functions();
header('Access-control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-control-Allow-Methods:PUT');
header('Access-control-Allow-Headers:Content-type,Access-Control-Allow-Headers,Authorization,X-Request-With');
$data = json_decode(file_get_contents("php://input"));
$error = false;
if(empty($data->user_id)){
    $error = true;
    $msg = 'user_id is required';
}elseif(empty($data->user_id)){
    $error = true;
    $msg = 'user_id is required';
}
if(empty($error)){
    $_data = ['postId'=>$data->postId,'user_id'=>$data->user_id,'comment'=>$data->comment,'status'=>$data->status];
    $comment_id = $obj->fn_update_news_comment(0,$_data);
    if(empty($comment_id)){
        $error = true;
        $msg = 'comment not added successfully';
    }
}

if(!empty($error)){
    $error_array = ['success'=> false,'message' => $msg];
    echo json_encode($error_array);
}else{
    $msg = 'Comment Added Successfully';
    $success_array = ['success'=> true,'message' => $msg,'comment_id' => $comment_id];
    echo json_encode($success_array);
}
