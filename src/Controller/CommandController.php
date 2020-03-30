<?php

namespace App\Controller;

use App\Entity\Commandes;
use App\Service\Cart \CartService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandController extends AbstractController
{
    /**
     * @Route("/command", name="command")
     */
    public function index(CartService $cartService, Session $session)
    {   
        $manager = $this->getDoctrine()->getManager();
        $order = new Commandes();
        $order->setUtilisateur($this->getUser());
        $order->setProduits($cartService->getFullCart());
        $manager->persist($order);
        $manager->flush();
        return $this->render('command/index.html.twig', [
            'controller_name' => 'CommandController',
            'items' => $cartService->getFullCart(), 
            'total' => $cartService->getTotal()
        ]);
    }
}
