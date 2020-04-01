<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Entity\Categories;
use App\Service\Cart\CartService;
use App\Repository\CategoriesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoriesController extends AbstractController
{
   
    public function index(CartService $cartService, CategoriesRepository $repo)
    {
        $categories = $repo->findAll();
        $cartWithData = $cartService->getFullCart();

        return $this->render('categories/index.html.twig', [ 
            'categories' => $categories,
            'cart' => $cartWithData,
            //'controller_name' => 'CategoriesController',
        ]);
    }

}
