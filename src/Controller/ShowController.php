<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use App\Entity\Categories;


class ShowController extends AbstractController
{


    // /**
    //  * @Route("/categorie", name="categorie")
    //  */
    // public function categorie()
    // {
         

    //      $repo = $this->getDoctrine()->getRepository(Categories::class);
    //      $categories = $repo->findAll();



    //     return $this->render('show/index.html.twig', [
    //         // 'controller_name' => 'HomeController',
    //         'controller_name' => 'ShowController',

            
    //         'categories' => $categories
    //     ]);
    // }


    // /**
    //  * @Route("/categorie/{id}", name="show")
    //  */
    // public function index($id)
    // {
    //     $repo = $this->getDoctrine()->getRepository(Produits::class);
    //     $produit = $repo->find($id);

    //     return $this->render('show/index.html.twig', [
    //         'controller_name' => 'ShowController',
    //         'produit' => $produit
    //     ]);
    // }




}
