<?php
require("../entities/func.php");
$obj = new news_functions();
header('Access-control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-control-Allow-Methods:GET');
header('Access-control-Allow-Headers:Content-type,Access-Control-Allow-Headers,Authorization,X-Request-With');
$data = json_decode(file_get_contents("php://input"));
$error = false;
if(empty($_REQUEST['phone_number'])){
    $error = true;
    $msg = 'phone_number field is required';
}
if(empty($error)){
    //data return for user login
    $user_id = $obj->fn_check_user_available($_REQUEST['phone_number']);
}

if(!empty($error)){
    $error_array = ['success'=> false,'message' => $msg];
    echo json_encode($error_array);
}else{
    if(!empty($user_id)){
        $msg = 'User Found in db you can logged it in';
    }else{
        $msg = 'User not Found in db you can not logged it in';
    }
    $success_array = ['success'=> true,'message' => $msg,'user_id' => $user_id];
    echo json_encode($success_array);
}
