<?php
    require_once("template_header.php");
    require_once("template_menu.php");
    $currentPageId = 'accueil';
    if(isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
    }
    $lang = 'fr';
    if(isset($_GET['lang'])) {
        $lang = $_GET['lang'];
    }
?>

<header class="bandeau_haut">
    <h1 class="titre">Thibault Ouriachi</h1>
</header>

<?php
    renderMenuToHTML($currentPageId,$lang);
?>

<section class="corps">
    <?php
        $pageToInclude = $currentPageId . ".php";
        if(is_readable($pageToInclude))
        require_once($pageToInclude);
        else
        require_once("error.php");
    ?>
</section>
<?php
    require_once("template_footer.php");
?>