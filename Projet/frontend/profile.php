<?php require_once('header.html')?>
<script>
    window.onload= function(){dispUser(1);
    };
</script>


    <div class="user-profile">
        <h2>Profil</h2>
        <div class="profile-info">
            <form id="activate_edit_user" onsubmit="return activate_edit();">
                <p id="name"><strong>Name:</strong></p>
                <p id="taille"><strong>Height:</strong> 180 cm</p>
                <p id="poids"><strong>Weight:</strong> 75 kg</p>
                <p id="age"><strong>Age:</strong> 30 years</p>
                <p id="sexe"><strong>Gender:</strong> Male</p>
                <p id="activité"><strong>Activité:</strong> Rarely</p>
                <br>
                <div id="buttonWrapper">
                    <input type="submit" value="Modifier">
                </div>
            </form>
        </div>
    </div>
</body>
</html> 
