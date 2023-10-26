<?php
    require_once('config.php');
    function renderMenuToHTML($currentPageId) {
            // idPage titre
        $mymenu = array('profile','page_aliments');
        echo "<nav class=menu id=barre_top>";
        echo "<ul>";
        foreach($mymenu as $pageId) {
            if($currentPageId==$pageId) {
                echo '<li><a id=currentpage href="'._prefix.$pageId.'">'.$pageId.'</a></li>';
            }
            else {
                echo '<li><a href="'._prefix.$pageId.'">'.$pageId.'</a></li>';
            }
        }
        //echo "<li><img src=en_flag.png href='http://localhost/IDAW/SitePro/v3/'.$chgt.'/index.php?lang='.$chgt.'&page='.$currentPageId></li>"
        echo "</ul>";
        echo "</nav";
    }
?>