<?php
    function renderMenuToHTML($currentPageId,$lang) {
        // un tableau qui d\'efinit la structure du site
        $i=0;
        if($lang=='en'){
            $i=1;
        }
        $url='http://localhost/IDAW/SitePro/v3/index.php?lang'.$lang.'page='
            // idPage titre
            'accueil' => array( 'Accueil','Welcome page' ),
            'cv' => array( 'CV','Resume' ),
            'projets' => array('Mes Projets','My projects'),
            'hobbies' => array('Mes hobbies','My hobbies'),
            'infos-techniques' => array('Infos Techniques','Technical information'),
            'contact' => array('Mes informations de contact','Contact information');
        echo "<nav class=menu>";
        echo "<ul>";
        foreach($mymenu as $pageId => $pageParameters) {
            if($currentPageId==$pageId) {
                echo '<li><a id=currentpage href="'.$url.$pageId.'">'.$pageParameters[$i] .'</a></li>';
            }
            else {
                echo '<li><a href=".url'.$pageId.'">'.$pageParameters[$i].' </a></li>';
            }
        }
        echo "</ul>";
        echo "</nav";
    }
