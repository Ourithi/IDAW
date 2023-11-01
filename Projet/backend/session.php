<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
header("Cache-Control: no-cache");

session_start();


if(isset($_POST['id_user'])){
    $_SESSION['id_user'] = $_POST['id_user'];
    http_response_code(200);
    echo json_encode(array("message"=>"Session créée"));
}
elseif(isset($_SESSION['id_user'])){
    session_unset();
    session_destroy();
    http_response_code(200);
    echo json_encode(array("message"=>"Session détruite"));
}
else{
    http_response_code(500);
    echo json_encode(array("message"=>"Server error"));
}
