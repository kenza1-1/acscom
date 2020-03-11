<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateursRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder/* \Swift_Mailer $mailer*/)
    {
       $user = new Utilisateurs();
       $form = $this->createForm(RegistrationType::class, $user);
       $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $user->setActivationToken(md5(uniqid()));

            $manager->persist($user);
            $manager->flush();
            // on crée le message
            // $message= (new \Swift_Message('Activation de votre compte'))
            //     // On attribue l'expediteur
            //     ->setForm('iderkenza11@gmail.com')
            //     // On attribue le destinataire
            //     ->setTo($user->getEmail())
            //     // On crée le contenu
            //     ->setBody(
            //         $this->renderView(
            //             'emails/activation.html.twig',['token'=> $user->getActivationToken()]
            //         ),
            //         'text/html'
            //     )
            // ;
            // // On envoie l'email
            // $mailer->send($message);



            return $this->redirectToRoute('security_login');
        }


       return $this->render('security/index.html.twig', [
           'form' => $form ->createView() 


       ]);
    }
     /**
     * @Route("/inscription", name="security_register")
     */
    public function register(){
        return $this-> render('security/index.html.twig');

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

     /**
     * @Route("/activation/{token}", name="activation")
     */
    public function activation($token , UtilisateursRepository $usersRepo){
        // On verifie si un utilisateur a ce token 
        $user =$usersRepo->findOneBy(['activation_token'=>$token ]);
        //  Si aucun utilisateur n'existe avec ce token 
        if(!$user){
            //erreur 404
            throw $this->createNotFoundException('Cet utilisateur n\'existe pas');
        }
        // On supprime le token
        $user->setActivationToken(null);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // on envoi un messag eflash 
        $this->addFlash('message','vous avez bien activer votre compte');
        // on retourne a l'acceuil 
        return $this-> redirectToRoute('produits');

        
    }
}
