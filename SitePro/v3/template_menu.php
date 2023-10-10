<?php
    function renderMenuToHTML($currentPageId) {
        // un tableau qui d\'efinit la structure du site
        $mymenu = array(
            // idPage titre
            'index' => array( 'Accueil' ),
            'cv' => array( 'CV' ),
            'projets' => array('Mes Projets'),
            'hobbies' => array('Mes hobbies'),
            'infos-techniques' => array('Infos Techniques')
            );
        echo "<nav class=menu>";
        echo "<ul>";
        foreach($mymenu as $pageId => $pageParameters) {
            if($currentPageId==$pageId) {
                echo "<li><a id=currentpage href=".$pageId.".php>".$pageParameters[0]."</a></li>";
            }
            else {
                echo "<li><a href=".$pageId.".php>".$pageParameters[0]."</a></li>";
            }
        }
        echo "</ul>";
        echo "</nav";
    }
