<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;


class ShowController extends AbstractController
{
    /**
     * @Route("/show/{id}", name="show")
     */
    public function index($id)
    {
        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produit = $repo->find($id);

        return $this->render('show/index.html.twig', [
            'controller_name' => 'ShowController',
            'produit' => $produit
        ]);
    }
}
