<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
       $user = new Utilisateurs();
       $form = $this->createForm(RegistrationType::class, $user);
       $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('security_login');
        }


       return $this->render('security/index.html.twig', [
           'form' => $form ->createView() 


       ]);
    }
    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(){
        return $this-> render('security/login.html.twig');

    }
      /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout(){
      

    }
}
