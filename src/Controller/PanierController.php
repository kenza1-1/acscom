<?php

namespace App\Controller;

use App\Entity\Produits;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    public function menuAction(Request $request){
        $session= $request->getSession();
        if(!$session->has('panier'))
        $produits=0;
        else
        $produits=count($session->get('panier'));
        return $this->render('moduleUtilisateur/index.html.twig', [
            'produits' =>$produits,
            
        ]);
        



    }
    /**
     * @Route("/panier", name="panier")
     */
    public function index(Request $request)

    {
        $session= $request->getSession();
        if (!$session->has('panier')) $session->set('panier',array());
        // var_dump($session->get('panier'));
        // die(); 
        $em= $this->getDoctrine()->getManager();
        $produits=$em->getRepository(Produits::class)->findArray(array_keys($session->get('panier')));


        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
            'produits' =>$produits,
            'panier'=> $session->get('panier')
            
        ]);
    }

    /**
     * @Route("/ajouter/{id}", name="ajouter")
     */

    public function ajouter($id, Request $request)
    {
        $session= $request->getSession();
        
        if(!$session->has('panier')) $session->set('panier',array()); 
        $panier = $session->get('panier');
    
        if(array_key_exists($id,$panier)){
            if($request->query->get('qte') != null) $panier[$id]=$request->query->get('qte');
        }else{
            if($request->query->get('qte') != null)
                $panier[$id] = $request->query->get('qte');
            else
            $panier[$id]=1;
        }
            $session->set('panier',$panier);

        // $session= $request->getSession();
        // if (!$session->has('panier')) $session->set('panier',array());
        //  $panier= $session->get('panier');

        //  if (array_key_exists($id, $panier)){
        //             if($this->$request->query->get('qte') != null) $panier['$id']= $this->$request()->query->get('qte');
        //             }else{
        //                     if($this->$request->query->get('qte') != null)
        //                     $panier[id] =$this->$request->query->get('qte');
        //                     else
        //                     $panier[$id] = 1; 
        //             }
        //             $session->set('panier',$panier);
         

        // variable $panier qui porte en key l id du produit a l'interieur y aira la quantité du produit
        // var_dump($session->get('panier'));
        // die();

        return $this->redirect($this->generateUrl('panier'));
        }

     /**
     * @Route("/supprimer/{id}", name="supprimer")
     */
    public function supprimer( $id , Request $request)
    {
        $session= $request->getSession();
        $panier = $session->get('panier');
        if(array_key_exists($id, $panier)){
            unset($panier[$id]);
            $session->set('panier',$panier);
           $this->get('session')->getFlashBag()->add('success','Article supprimer avec succes');

        }
        return $this->redirect($this->generateUrl('panier'));

       
    }
}
