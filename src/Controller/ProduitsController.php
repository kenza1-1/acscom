<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use App\Service\Cart\CartService;


class ProduitsController extends AbstractController
{
    /**
     * @Route("/", name="produits")
     */
    public function index(CartService $cartService)
    {
        $cartWithData = $cartService->getFullCart();
        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $repo->findByDisponibilite('1');
        return $this->render('produits/index.html.twig', [
            'controller_name' => 'ProduitsController',
            'produits' => $produits, 
            'cart' => $cartWithData
            
        ]);
    }

     /**
     * @Route("/categories/{id}", name="show")
     */
    public function presentation($id)
    {
        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produit = $repo->find($id);

        //if(!$produit) throw $this->createNotFoundException("La page n'exite pas ");

        return $this->render('show/index.html.twig', [
            'controller_name' => 'ShowController',
            'produit' => $produit
        ]);
    }

     /**
     * @Route("/categorie/{categorie}", name="categorieproduits")
     */

    public function categorie($categorie, CartService $cartService)
    {
        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $repo->findByCategorie($categorie);

        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $categorie = $repo->find($categorie);
        // if(!$categorie) throw $this->createNotFoundException("La page n'exite pas ");
        $cartWithData = $cartService->getFullCart();
        return $this->render('produits/index.html.twig', [
            //'controller_name' => 'ShowController',
            'produits' => $produits,
            'cart' => $cartWithData
        ]);
    }
}
