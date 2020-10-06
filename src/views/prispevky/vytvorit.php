<?php
    $nadpis = (isset($_POST["nadpis"])) ? $_POST["nadpis"] : "";
    $obsah = (isset($_POST["obsah"])) ? $_POST["obsah"] : "";

    global $zakladni_url;

    if(!isset($_SESSION["prihlaseny_uzivatel"]))
    {
        header("location:".$zakladni_url."index.php/stranky/chyba/");
        die();
    }
?>

<form action="?" method="post">
    <input type="text" name="nadpis" placeholder="Nadpis..." value="<?php echo $nadpis; ?>"/><br />
    <input type="text" name="obsah" placeholder="Zde napište obsah..." value="<?php echo $obsah; ?>"/><br />
    <input type="submit" value="Přidat příspěvek"/><br />
</form>
