<?php

class Prispevek
{
    private $autor;
    private $nadpis;
    private $obsah;

    public function __construct($autor, $nadpis, $obsah)
    {
        $this->autor = $autor;
        $this->nadpis = $nadpis;
        $this->obsah = $obsah;
    }

    public function vytvor_se()
    {
        $spojeni = DB::pripojit();
        $dotaz = "INSERT INTO 4ep_sk2_mvc_prispevky (autor, nadpis, obsah) VALUES ('$this->autor', '$this->nadpis', '$this->obsah')";

        mysqli_query($spojeni, $dotaz);

        return mysqli_affected_rows($spojeni) == 1;
    }

    static public function zobrazeni($autor)
    {
        $spojeni = DB::pripojit();

        $dotaz = "SELECT * FROM 4ep_sk2_mvc_prispevky WHERE autor='$autor'";
        $vysledek = mysqli_query($spojeni, $dotaz);

        if(mysqli_num_rows($vysledek) == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
