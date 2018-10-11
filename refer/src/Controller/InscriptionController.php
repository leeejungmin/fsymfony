<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Amis;
use App\Repository\PersonRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ RegistrationType;
use App\Form\ AmisRegisterType;

class InscriptionController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {



        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'Welcome'

        ]);
    }


    /**
     * @Route("/amis", name="amis")
     */
    public function Amis()
    {
      $user = $this->getUser();
        // $amis = new Amis();

        // $entityManager = $this->getDoctrine()->getManager();
        // $repo = $entityManager->getRepository(Amis::class);

        $amis=$user->getAmi();


         dump($user);


        return $this->render('inscription/amis.html.twig', [
            'controller_name' => 'Jungmin',
            'amis' => $amis,
            'user' -> $user,
            'id' => $user->getId(),
        ]);
    }





    /**
     * @Route("/amis/add", name="addami")
     */
    public function Addami(  Request $request, objectManager $manager)
    {


        $user = new User();

        $amis = new Amis();

        $entityManager = $this->getDoctrine()->getManager();
        $repo = $entityManager->getRepository(Amis::class);


    // avoir id d'user
        $user = $this->getUser();
        $userid = $user->getId();


        $form = $this->createForm(RegistrationType::class, $amis);

        $form->handleRequest($request);

        $amis=$repo->addAmi($user);


        if($form->isSubmitted() && $form->isValid()){

          $entitymanager->persist($amis);
          $entitymanager->flush();

          return $this->redirectToRoute('amis');
        }




     // $entityManager = $this->getDoctrine()->getManager();
     // $repo = $entityManager->getRepository(User::class);





          return $this->render('inscription/amisadd.html.twig', [
          'amisrecommand' => $amisrecommand,
          'form' => $form,
          ]);


    }






    /**
     * @Route("/amisedelete/{id}", name="amisdelete")
     */
    public function amisdelete($id){


          // delete de object
          $entityManager = $this->getDoctrine()->getManager();
          $repo = $entityManager->getRepository(Amis::class);
          $amis =$repo->find($id);

          $user = $this->getUser();

          $amis->removeAmi($user);

          $entityManager->persist($amis);
          $entityManager->flush();

          // if($entityManager->flush()){
          //
          //
          //
          //   return $this->redirectToRoute('security_login');
          // }

           return $this->redirectToRoute('amis');

    }

    /**
     * @Route("/amis/recommand", name="amisrecommand")
     */
    public function Amisrecommand()
    {
        $repo = $this->getDoctrine()->getRepository(Amis::class);

        $amisrecommand = $repo->findAll();

       return $this->render('inscription/amisrecommand.html.twig', [
       'amisrecommand' => $amisrecommand,
       ]);
    }

    /**
     * @Route("/amis/{id}/treat", name="treat")
     */
    public function treatRecommand($id)
    {


        $entityManager = $this->getDoctrine()->getManager();
        $repo = $entityManager->getRepository(Amis::class);

        $amis = $repo->find($id);

        $user = $this->getUser();

        $amis->addUser($user);

         $entityManager->persist($amis);
         $entityManager->flush();

      return $this->redirectToRoute('main');
    }

}
