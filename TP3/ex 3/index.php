<!doctype html>
<html>
<head>

    <?php
        if( isset($_GET["css"])){
            $style=$_GET["css"];
        }
        else {
            $style="style1";
        }
        setcookie("css",$style);
        $style=$_COOKIE["css"];
        echo '<link rel="stylesheet" href="'.$style.'.css" type="text/css"
        media="screen" title="default" charset="utf-8" />';
    ?>
</head>
<body>
    <form id="style_form" action="index.php" method="GET">
    <select name="css">
        <option value="style1">style1</option>
        <option value="style2">style2</option>
    </select>
    <input type="submit" value="Appliquer" />
    </form>
</body>


