<?php 
    session_start();
    if(isset($_SESSION['id_user'])){
        $id_user =$_SESSION['id_user'];
    }
    else{
        header('Location: ./login.php');
    }

    require_once('header.html');

    require_once("template_menu.php");
    $currentPageId = 'profile';
    renderMenuToHTML($currentPageId);
?>
<script>
    var id_user='<?php echo $id_user;?>';
    window.onload= function(){dispUser(id_user);
    };
</script>


    <div class="user-profile">
        <h2>Profil</h2>
        <div class="profile-info">
            <form id="activate_edit_user">
                <p id="name"><strong>Name:</strong></p>
                <p id="taille"><strong>Height:</strong> 180 cm</p>
                <p id="poids"><strong>Weight:</strong> 75 kg</p>
                <p id="age"><strong>Age:</strong> 30 years</p>
                <p id="sexe"><strong>Gender:</strong> Male</p>
                <p id="activité"><strong>Activité:</strong> Rarely</p>
                <br>
                <div id="buttonWrapper">
                    <input type="submit" value="Modifier" onclick="activateEditUser(id_user)";>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 
