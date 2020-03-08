<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;

class ProduitsController extends AbstractController
{
    /**
     * @Route("/", name="produits")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $repo->findAll();
        return $this->render('produits/index.html.twig', [
            'controller_name' => 'ProduitsController',
            'produits' => $produits
            
        ]);
    }

     /**
     * @Route("/categories/{id}", name="show")
     */
    public function presentation($id)
    {
        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produit = $repo->find($id);

        return $this->render('show/index.html.twig', [
            'controller_name' => 'ShowController',
            'produit' => $produit
        ]);
    }

     /**
     * @Route("/categorie/{categorie}", name="categorieproduits")
     */

    public function categorie($categorie)
    {
        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $repo->findByCategorie($categorie);

        return $this->render('produits/index.html.twig', [
            //'controller_name' => 'ShowController',
            'produits' => $produits
        ]);
    }
}
