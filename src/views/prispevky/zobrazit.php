<?php
    global $zakladni_url;

    if(!isset($_SESSION["prihlaseny_uzivatel"]))
    {
        header("location:".$zakladni_url."index.php/stranky/chyba/");
        die();
    }

    $autor = $_SESSION["prihlaseny_uzivatel"];

    $spojeni = DB::pripojit();
    $dotaz1 = "SELECT * FROM 4ep_sk2_mvc_prispevky";
    $vysledek1 = mysqli_query($spojeni, $dotaz1);

    $id = mysqli_num_rows($vysledek1);
    for ($id; $id > 0; $id--)
    {
        $dotaz2 = "SELECT * FROM 4ep_sk2_mvc_prispevky WHERE id='$id' AND autor='$autor'";
        $vysledek2 = mysqli_query($spojeni, $dotaz2);
        
        if (mysqli_num_rows($vysledek2) == 1) 
        {
            $prispevek = mysqli_fetch_assoc($vysledek2);?>
            <p><b><?php echo $prispevek["nadpis"] ?></b></p>
            <blockquote><?php echo $prispevek["obsah"] ?></blockquote>
            <hr><?php
        }

    }
?>