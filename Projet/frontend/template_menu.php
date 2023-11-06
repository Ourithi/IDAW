<?php
    require_once('config.php');
    function renderMenuToHTML($currentPageId) {
            // idPage titre
        $login_text = "login";
        $login_href = "login";
        if(isset($_SESSION['id_user'])){
            $login_text = "logout";
            $login_href = "session";
        }    
        $mymenu = array('index','profile','page_aliments','journal');
        echo "<nav class=menu id=barre_top>";
        echo "<ul>";
        foreach($mymenu as $pageId) {
            if($currentPageId==$pageId) {
                echo '<li><a id=currentpage href="'._prefixFront.$pageId.'.php">'.$pageId.'</a></li>';
            }
            else {
                echo '<li><a href="'._prefixFront.$pageId.'.php">'.$pageId.'</a></li>';
            }
            
        }
        echo '<li><a href="'._prefixFront.$login_href.'.php">'.$login_text.'</a></li>';
        //echo "<li><img src=en_flag.png href='http://localhost/IDAW/SitePro/v3/'.$chgt.'/index.php?lang='.$chgt.'&page='.$currentPageId></li>"
        echo "</ul>";
        echo "</nav>";
    }
?>