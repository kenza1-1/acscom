<?php

namespace App\Service\Cart ;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ProduitsRepository;



class CartService {

    protected $session;
    protected $produitsRepository;

    public function __construct(SessionInterface $session, ProduitsRepository $produitsRepository)
    {
        $this->session = $session;
        $this->produitsRepository = $produitsRepository;
    }

    public function add(int $id) {
        $cart = $this->session->get('cart', []);

        if(!empty($cart[$id])){
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }


        $this->session->set('cart', $cart);

    }

    public function remove(int $id) {
        $cart = $this->session->get('cart', []);

        if(!empty($cart[$id])) {
            unset($cart[$id]);
        }

        $this->session->set('cart', $cart);
    }

    public function getFullCart() : array {
        // $this->session->clear();
        $cart = $this->session->get('cart', []);

        $cartWithData = [];

        foreach($cart as $id => $quantity) {
            $cartWithData[] = [
                'product' => $this->produitsRepository->find($id), 
                'quantity' => $quantity
            ];
        }
        return $cartWithData;
    }

    public function getTotal() : float {
        
        $total = 0;

        foreach($this->getFullCart() as $item){
            $total += $item['product']->getPrix() * $item['quantity'];
        }

        return $total;
    }

    public function modifQuantity(int $id, int $quantity){
        $cart = $this->session->get('cart',[]); 
        
        $cart[$id] = $quantity;
        $this->session->set('cart', $cart);
    }
}