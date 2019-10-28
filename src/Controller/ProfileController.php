<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profile()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        return $this->render('security/profile.html.twig',[
            'user' => $user

        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/Amis", name="amis")
     */
    public function amis(){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user=$this->getUser();
        $amis = $user->getAmis();
        return $this->render('security/amis.html.twig',[
            'amis' => $amis
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/Accueil" , name="accueil")
     */
    public function Accueil(){
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();


        return $this->render('security/accueil.html.twig',[
            'users' => $users
        ]);
    }
    /**
     * @Route("addFriend/{id}" , name="addami")
     */
    public function AddFriend(ObjectManager $manager,$id){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user=$this->getUser();
        $user1= $manager->getRepository(User::class)->find($id);
        $user->addAmi($user1);
        $user1->addUser($user);
        $manager->persist($user);
        $manager->persist($user1);
        $manager->flush();
        return $this->redirectToRoute('profile');


    }
}
