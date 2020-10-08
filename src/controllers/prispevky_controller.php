<?php

class Prispevky
{
    private function mam_dostatek_dat_k_vytvoreni()
    {
        if(!isset($_POST["nadpis"]))
            return false;
        if(!isset($_POST["obsah"]))
            return false;
        
        return true;
    }

    private function data_jsou_v_poradku($nadpis, $obsah)
    {
        if(strlen($nadpis) < 1)
            return false;
        if(strlen($obsah) < 1)
            return false;
        
        return true;
    }

    public function vytvorit()
    {
        if($this->mam_dostatek_dat_k_vytvoreni())
        {
            $autor = $_SESSION["prihlaseny_uzivatel"];
            $nadpis = trim($_POST["nadpis"]);
            $obsah = trim($_POST["obsah"]);

            if($this->data_jsou_v_poradku($nadpis, $obsah))
            {
                $prispevek = new Prispevek($autor, $nadpis, $obsah);

                if($prispevek->vytvor_se())
                {
                    return spustit("prispevky", "zobrazit");
                }
                else
                {
                    return spustit("stranky", "chyba");
                }
            }
            else
            {
                require_once "views/prispevky/vytvorit.php";
            }
        }
        else
        {
            require_once "views/prispevky/vytvorit.php";
        }
    }

    public function zobrazit()
    {
        $autor = $_SESSION["prihlaseny_uzivatel"];

        if(Prispevek::muzu_zobrazit($autor))
        {
            require_once "views/prispevky/zobrazit.php";
        }
        else
        {
            require_once "views/prispevky/nezobrazit.php";
        }
    }
}
