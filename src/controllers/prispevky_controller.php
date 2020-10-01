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
            session_start();
            $autor = $_SESSION["prihlaseny_uzivatel"];
            $nadpis = trim($_POST["nadpis"]);
            $obsah = trim($_POST["obsah"]);

            if($this->data_jsou_v_poradku($nadpis, $obsah))
            {
                $prispevek = new Prispevek($autor, $nadpis, $obsah);

                if($prispevek->vytvor_se())
                {
                    // uzivatel je uspesne registrovan
                    // presmeruju ho na prihlaseni
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
        if($this->mam_dostatek_dat_k_prihlaseni())
        {
            $jmeno = trim($_POST["jmeno"]);
            $heslo = trim($_POST["heslo"]);

            if(Uzivatel::existuje($jmeno, $heslo))
            {
                session_destroy();
                session_start();

                $_SESSION["prihlaseny_uzivatel"] = $jmeno;

                global $zakladni_url;

                header("location:".$zakladni_url."index.php/stranky/profil/");
            }
            else
            {
                require_once "views/uzivatele/prihlasit.php";
            }
        }
        else
        {
            require_once "views/uzivatele/prihlasit.php";
        }
    }

    public function odhlasit()
    {
        session_destroy();
        unset($_SESSION["prihlaseny_uzivatel"]);
        session_start();

        global $zakladni_url;

        header("location:".$zakladni_url."index.php/stranky/domu/");
    }
}
