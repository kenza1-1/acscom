<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Cart\CartService;
use App\Entity\Categories;
use App\Entity\Produits;

class CategoriesController extends AbstractController
{
   
    public function index(CartService $cartService)
    {
        $repo = $this->getDoctrine()->getRepository(Categories::class);
        $categories = $repo->findAll();
        $cartWithData = $cartService->getFullCart();

        return $this->render('categories/index.html.twig', [ 
            'categories' => $categories,
            'cart' => $cartWithData
            //'controller_name' => 'CategoriesController',
        ]);
    }

}
