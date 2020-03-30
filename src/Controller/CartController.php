<?php

namespace App\Controller;

use App\Service\Cart\CartService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController {

    /**
     * @Route("/cart", name="cart_index")
     */
    public function index(CartService $cartService) {
        // dd($cartService->getFullCart());
        return $this->render('cart/index.html.twig', [
            'items' => $cartService->getFullCart(), 
            'total' => $cartService->getTotal()
        ]);

    }

    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add($id, CartService $cartService){

        $cartService->add($id);

        return $this->redirectToRoute("cart_index");

    }

    /**
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function remove($id, CartService $cartService){
       
        $cartService->remove($id);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/panier/modifQuantity/{id}", name="cart_modif")
     */
    public function modifQuantity($id, CartService $cartService, Session $session){


        $cartService->modifQuantity($id,intval($_GET['quantity']));
        
        return $this->redirectToRoute("cart_index");
    }

}