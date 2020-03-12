<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Service\Cart\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ProduitsController extends AbstractController
{
    /**
     * @Route("/", name="produits")
     */
    public function index( Request $request )
    {
        $session= $request->getSession();
        $repo = $this->getDoctrine()->getRepository(Produits::class);

        // $panier = $session->get('panier');
        $produits = $repo->findByDisponibilite('1');
        if ($session->has('panier'))
            $panier = $session->get('panier');
            else
            $panier = false;

        return $this->render('produits/index.html.twig', [
            'controller_name' => 'ProduitsController',
            'produits' => $produits, 
            'panier' => $panier
           // 'cart' => $cartWithData
            
        ]);
    }

     /**
     * @Route("/categories/{id}", name="show")
     */
    public function presentation($id, Request $request )
    {
        $session= $request->getSession();
        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produit = $repo->find($id);

        if(!$produit) throw $this->createNotFoundException("La page n'exite pas ");
        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;

        return $this->render('show/index.html.twig', [
            'controller_name' => 'ShowController',
            'produit' => $produit,
            'panier' => $panier
        ]);
    }

     /**
     * @Route("/categorie/{categorie}", name="categorieproduits")
     */

    public function categorie($categorie)
    {
        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $repo->findByCategorie($categorie);

        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $categorie = $repo->find($categorie);
        // if(!$categorie) throw $this->createNotFoundException("La page n'exite pas ");

        return $this->render('produits/index.html.twig', [
            //'controller_name' => 'ShowController',
            'produits' => $produits
        ]);
    }
}
