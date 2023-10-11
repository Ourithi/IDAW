<?php 
    session_start();
    session_unset();
    session_destroy();
    echo "Vous avez été déconnecté"
?>
<!doctype html>
<html>
<head>
</head>
<body>
    <p><a href= "login.php"> Page de connexion </a></p>
</body>
