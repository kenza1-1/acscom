<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
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


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'produits' => $produits
        ]);
    }
}
