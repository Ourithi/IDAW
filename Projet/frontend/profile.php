<?php require_once('header.html');
    require_once("template_menu.php");
    $currentPageId = 'profile';
    renderMenuToHTML($currentPageId);
?>
<script>
    window.onload= function(){dispUser(1);
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
                    <input type="submit" value="Modifier" onclick="activateEditUser(1)";>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 
