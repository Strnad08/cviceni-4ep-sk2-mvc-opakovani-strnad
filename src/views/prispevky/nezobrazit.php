<?php
    global $zakladni_url;

    if(!isset($_SESSION["prihlaseny_uzivatel"]))
    {
        header("location:".$zakladni_url."index.php/stranky/chyba/");
        die();
    }
?>

<p>Nemáte zatím žádné příspěvky.</p>