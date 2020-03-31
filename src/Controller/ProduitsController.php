<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Service\Cart\CartService;
use App\Repository\ProduitsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ProduitsController extends AbstractController
{
    /**
     * @Route("/", name="produits")
     */
    public function index( Request $request, ProduitsRepository $repo )
    {
        $session= $request->getSession();

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
    public function presentation($id, Request $request, ProduitsRepository $repo, CartService $cartService)
    {
        $session= $request->getSession();
        
        $produit = $repo->find($id);

        $form = $this->createFormBuilder()
                ->add('quantity', NumberType::class, [
                    'data' => '1'
                ])
                ->add('ajoutPanier', SubmitType::class)
                ->getForm(); 
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $quantity = intval($_POST['form']['quantity']);
            $cartService->modifQuantity($id, $quantity);
            return $this->redirectToRoute("produits"); 
        }


        if(!$produit) throw $this->createNotFoundException("La page n'exite pas ");
        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;

        return $this->render('show/index.html.twig', [
            'controller_name' => 'ShowController',
            'produit' => $produit,
            'panier' => $panier, 
            'form' => $form->createView()
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
