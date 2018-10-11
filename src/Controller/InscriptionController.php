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
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\ AmisRegisterType;
use App\Repository;

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
      // prends information d'user la
        $user = $this->getUser();



         dump($user);
         //prends les informations d'user de lier a user la
       $amis = $user->getUsers();

        return $this->render('inscription/amis.html.twig', [
            'controller_name' => $user->getusername(),
            'amis' => $amis,
            'id' => $user->getId(),
        ]);
    }



    /**
     * @Route("/amis/add/", name="addamis")
     */
    public function addamis(){


          $user = $this->getUser();




          return $this->render('inscription/amisadd.html.twig', [
          'controller_name' => $user->getusername(),

          'id' => $user->getId(),
          ]);
    }

    /**
     * @Route("/amis/add/treat", name="addamiss")
     */
    public function Addamistreat( Request $request )
    {


        $amis = new User();


//avoir les donne de user

    $user = $this->getUser();
    $userid = $user->getId();


// recevoir le donne d'email
    $email = $_POST["email"];



// apporter les donnes de user
     $entityManager = $this->getDoctrine()->getManager();
     $repo = $entityManager->getRepository(User::class);

// trouver les donne qui est meme que 'email'
     $amis = $repo->findOneBy(['email' => $email]);



// ajouter l'information de user en liant amis user

     $amis ->addUser($user);

    $entityManager->persist($amis);
    $entityManager->flush();

                      return $this->redirectToRoute('amis',['id' => $user->getId()]);





    }






    /**
     * @Route("/amisedelete/{id}", name="amisdelete")
     */
    public function amisdelete($id){


          $user = $this->getUser();
          // delete de object avec user id
          $entityManager = $this->getDoctrine()->getManager();
          $repo = $entityManager->getRepository(User::class);
          $amis =$repo->find($id);

          //couper le liaison user la dans user avec id
          $amis->removeUser($user);

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

        // getuser la
        $user = $this->getUser();
        //utilise query builder
        // $repo = $this->getDoctrine()->getRepository(User::class)->findAllnotadd($user);
        $repo = $this->getDoctrine()->getRepository(User::class)->findAll();

        $amisrecommand = $repo;

       return $this->render('inscription/amisrecommand.html.twig', [
       'amisrecommand' => $amisrecommand,
       'user' => $user,
       ]);
    }

    /**
     * @Route("/amis/{id}/treat", name="treat")
     */
    public function treatRecommand($id)
    {
        // prend les information de user la
        $user = $this->getUser();

        $entityManager = $this->getDoctrine()->getManager();
        $repo = $entityManager->getRepository(User::class);

        // aporter les donnes d'user avec id
        $amis = $repo->find($id);

        //ajouter user la en liant avec user id
        $amis->addUser($user);

         $entityManager->persist($amis);
         $entityManager->flush();

      return $this->redirectToRoute('amis');
    }

}
