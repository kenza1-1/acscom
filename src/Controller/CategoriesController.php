<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categories;
use App\Entity\Produits;

class CategoriesController extends AbstractController
{
   
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Categories::class);
        $categories = $repo->findAll();

        return $this->render('categories/index.html.twig', [ 'categories' => $categories
            //'controller_name' => 'CategoriesController',
        ]);
    }

}
