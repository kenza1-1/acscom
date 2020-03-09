<?php

namespace App\Twig;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TvaExtension extends AbstractExtension { // etendre une autre classe que twig nous donne 

    public function getFilters()
    {
        return [new TwigFilter('tva', [$this,'calculTva'])];// nom de filtre (prixttc) ! le nom de la fonction prixFilter 
    }

    Public function calculTva($prixHt,$multiplicateur){
        return round($prixHt / $multiplicateur,2);

    }

    // public function getName(){
    //     return 'tva_extension';
    // }
  

}
