<?php
    require_once('template_header.php');
?>


<?php
    require_once('template_menu.php');
    renderMenuToHTML('cv');
?>
    <div class="contenu">
        <div class="section-CV">
        <h2>Formation</h2>

            <p>&Eacute;cole d'ing&eacute;nieur IMT Nord-Europe (Mines de Douai)</p>
            <p>Semestre acad&eacute;mique au Centre Franco-Vietnamien de Gestion de Ho Chi Min</p>
            <p>Classe pr&eacute;paratoire &eacute;toil&eacute;e aux grandes &eacute;coles, fili&egrave;re physique et science de l'ing&eacute;nieur</p>
            <p>Baccalaur&eacute;at scientifique mention tr&egrave;s bien</p>
        </div>
        
        <br>

        <div class="section-CV">
            <h2>Comp&eacute;tences</h2>

            <h3>Langues</h3>
            <p>Anglais, allemand, espagnol</p>
            <h3>Programmation</h3>
            <p>Java, Python, HTML, CSS, Javascript</p>
        </div>

        <div clas="section-CV">
            <br>
           <p> Pour t&eacute;l&eacute;charger mon CV complet, cliquez <a href="CV.pdf" attributes-list download>ici</a></div>
        </div>
    </div>

<?php
    require_once('template_footer.php');
?>