<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use App\Entity\Categories;

class HomeController extends AbstractController
{
    /**
     * @Route("/home1", name="home")
     */
    public function index()
    {
        // $produits= new Produits();

        // $produits->setTitre('Mon 2eme produit')
        //          ->SetDescription('La description de mon 2 eme produits')
        //          ->SetPrix(200000)
        //          ->SetQuantite(55)
        //          ->SetImage('http://placehold.it/900x350');
        //          $em = $this->getDoctrine()->getManager();
        //          $em->persist($produits);
        //          $em->flush();

         $repo = $this->getDoctrine()->getRepository(Produits::class);
         $produits = $repo->findAll();

         $repo1 = $this->getDoctrine()->getRepository(Categories::class);
         $categories = $repo1->findAll();


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'produits' => $produits,
            'categories' => $categories
        ]);


    }

    
    // /**
    //  * @Route("/home", name="categories")
    //  */
    
    // public function categorie()
    // {
    //     // $produits= new Produits();

    //     // $produits->setTitre('Mon 2eme produit')
    //     //          ->SetDescription('La description de mon 2 eme produits')
    //     //          ->SetPrix(200000)
    //     //          ->SetQuantite(55)
    //     //          ->SetImage('http://placehold.it/900x350');
    //     //          $em = $this->getDoctrine()->getManager();
    //     //          $em->persist($produits);
    //     //          $em->flush();

    //      $repo = $this->getDoctrine()->getRepository(Categories::class);
    //      $categories = $repo->findAll();


    //     return $this->render('base.html.twig', [
    //         'controller_name' => 'HomeController',
    //         'categories' => $categories
    //     ]);


    // }


    
}

