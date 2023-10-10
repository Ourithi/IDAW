<?php
    function renderMenuToHTML($currentPageId) {
        // un tableau qui d\'efinit la structure du site
        $mymenu = array(
            // idPage titre
            'accueil' => array( 'Accueil' ),
            'cv' => array( 'CV' ),
            'projets' => array('Mes Projets'),
            'hobbies' => array('Mes hobbies'),
            'infos-techniques' => array('Infos Techniques')
            );
        echo "<nav class=menu>";
        echo "<ul>";
        foreach($mymenu as $pageId => $pageParameters) {
            if($currentPageId==$pageId) {
                echo '<li><a id=currentpage href="http://localhost/IDAW/SitePro/v3/index.php?page="'.$pageId.'">'.$pageParameters[0] .'</a></li>';
            }
            else {
                echo '<li><a href="http://localhost/IDAW/SitePro/v3/index.php?page='.$pageId.'">'.$pageParameters[0].' </a></li>';
            }
        }
        echo "</ul>";
        echo "</nav";
    }
