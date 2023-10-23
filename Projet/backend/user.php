<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
header("Cache-Control: no-cache");

require_once('config.php');
require_once('init_pdo.php');
$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case 'GET':
        //on initialise une liste d'user vide
        $get=json_decode(file_get_contents('php://input'),true);
        //check params pour login
        if(isset($get['name']) && isset($get['pwd'])){
            $name=$get['name'];
            $pwd=$get['pwd'];
            $query=$pdo->prepare('SELECT `id` from `users` where `name`="'.$name.'"and `pwd`="'.$pwd.'"');
            $success=$query->execute();
            //check succès query
            if ($success){
                $id=$query->fetch(PDO::FETCH_OBJ);
                //check match user/pwd
                if ($id){
                    http_response_code(200);
                    echo json_encode(array("message"=> "Success"));
                }
                else{
                    http_response_code(200);
                    echo json_encode(array("message"=> "Mauvais nom d'utilisateur/mot de passe"));
                }
            }
            else{
                http_response_code(500);
                echo json_encode(array("message"=> "Internal server error"));
            }
        }
        elseif (isset($get['id'])){
            $id=$get['id'];
            $query=$pdo->prepare('SELECT * from `users` where `id`="'.$id.'"');
            $success=$query->execute();
            if ($success){
                $user=$query->fetch(PDO::FETCH_OBJ);
                if ($user){
                    echo json_encode($user);
                    http_response_code(200);
                }
                else{
                    http_response_code(400);
                    echo json_encode(array("message"=> "Bad request"));
                }

            }
            else{
                http_response_code(500);
                echo json_encode(array("message"=> "Internal server error"));
            }
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=> "Bad request"));
        }
        
        break;


    case 'POST':

        $post=json_decode(file_get_contents('php://input'),true);
        if(isset($post['name']) && isset($post['pwd']) && isset($post['taille']) && isset($post['poids']) && isset($post['age']) && isset($post['sexe'])){
            $name=$post['name'];
            $pwd=$post['pwd'];
            $taille=$post['taille'];
            $poids=$post['poids'];
            $age=$post['age'];
            $sexe=$post['sexe'];
            $query=$pdo->prepare('INSERT INTO `users`( `name`, `pwd`, `taille`, `poids`, `age`, `sexe`) VALUES ("'.$name.'","'.$pwd.'","'.$taille.'","'.$poids.'","'.$age.'","'.$sexe.'")');
            $success=$query->execute();
            if($success){
                $query=$pdo->prepare('SELECT max(id) AS id FROM `users`');
                $success=$query->execute();
                if($success){
                    $id=$query->fetch(PDO::FETCH_OBJ);
                    echo json_encode($id);
                    http_response_code(201);
                }
                else{
                    http_response_code(500);
                    echo json_encode(array("message"=> "Internal server error"));
                }
            }
            else{
                http_response_code(500);
                echo json_encode(array("message"=> "Internal server error"));
            }
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=> "Bad request"));
        }
        break;


    case 'PUT':

        $put=json_decode(file_get_contents('php://input'),true);

        if(isset($put['id']) && isset($put['name']) && isset($put['email'])){
            $id=$put['id'];
            $name=$put['name'];
            $email=$put['email'];
            $query=$pdo->prepare('UPDATE `users` SET `name`="'.$name.'",`email`="'.$email.'" WHERE `id`="'.$id.'"');
            $success=$query->execute();
            if($success){
                $query=$pdo->prepare('SELECT * FROM `users`WHERE `id`="'.$id.'"');
                $success=$query->execute();
                if($success){
                    $user=$query->fetch(PDO::FETCH_OBJ);
                    $user=array(
                        "id"=> $user->id,
                        "name"=> $user->name,
                        "email"=>$user->email
                    );
                    echo json_encode($user);
                    http_response_code(200);

                }
                else{
                    http_response_code(500);
                    echo json_encode(array("message"=> "Internal server error"));
                }

            }
            else{
                http_response_code(500);
                echo json_encode(array("message"=> "Internal server error"));
            }
        
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=> "Bad request"));
        }
        break;

    case 'DELETE':
        $del=json_decode(file_get_contents('php://input'), true);
        if(isset($del['id'])){
            $id=$del['id'];
            $query=$pdo->prepare("DELETE FROM `users` WHERE `id`=".$id);
            $success=$query->execute();
            if($success){
                http_response_code(200);
                echo json_encode(array(
                    'message'=> "L'utilisateur a bien été supprimé")
                );
            }
            else{
                http_response_code(500);
                echo json_encode(array("message"=> "Internal server error"));
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