<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('config.php');
require_once('db_conn.php');

$method=$_SERVER['REQUEST_METHOD'];
switch ($method){
    case 'GET':

        $get=json_decode(file_get_contents('php://input'),true);
        if(isset($get['id'])){
            $id=$get['id'];
            $query=$pdo->prepare("SELECT * FROM `users` where `id` =".$id);
            $success=$query->execute();
            if($success){
                $user=$query->fetch(PDO::FETCH_OBJ);
                $user=array(
                    "id"=> $user->id,
                    "name"=> $user->name,
                    "email"=>$user->email
                );
                http_response_code(200);
                echo json_encode($user);
            }
            else{
                http_response_code(500);
                echo json_encode(array("message"=>"Internal server error"));
            }
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=> "Bad request"));
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(array("message"=> "Method not allowed"));
        break;
}