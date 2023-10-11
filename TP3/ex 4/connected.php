<?php
    session_start();
    // on simule une base de données
    $users = array(
        // login => password
        'riri' => 'fifi',
        'yoda' => 'maitrejedi' );
    $login = "anonymous";
    $errorText = "";
    $successfullyLogged = false;
    if(isset($_POST['login']) && isset($_POST['password'])) {
        $tryLogin=$_POST['login'];
        $tryPwd=$_POST['password'];
    // si login existe et password correspond
        if( array_key_exists($tryLogin,$users) && $users[$tryLogin]==$tryPwd ) {
            $successfullyLogged = true;
            $login = $tryLogin;
            $_SESSION['login'] = $login;
        } else
            $errorText = "Erreur de login/password";
    } else
        $errorText = "Merci d'utiliser le formulaire de login";
    if(!$successfullyLogged && !isset($_SESSION["login"])) {
        echo $errorText;
    } 
    elseif(isset($_SESSION["login"])){
        echo "<h1>Bienvenu ".$_SESSION["login"]."</h1>";
        echo "login: ".$_SESSION["login"];
    }
    else {
        echo "<h1>Bienvenu ".$login."</h1>";
    }

?>
<!doctype html>
<html>
<head>
</head>
<body>
<p><a href= "logout.php"> Logout </a></p>
<p><a href= "index.php"> Index </a></p>
</body>