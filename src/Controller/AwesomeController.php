<?php
// namespace ENGEL\AwesomeBundle\Controller;
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;


use App\Entity\User;

class AwesomeController extends AbstractController
{
    /**
     * @Route("/amischerche", name="amischerche")
     */
    public function index()
    {




        // $repo = $this->getDoctrine()->getRepository(User::class);
        //
        // $user = $repo->findAll();
        // $data = DashboardController::getData();
        return $this->render('awesome/index.html.twig', [
            'controller_name' => 'AwesomeController',
            // 'amis'=>$user,
            // 'amis' => $data,
        ]);
    }

    /**
    * @Route("/user.php", name="ttdata")
    */
    public function ttdata()
    {

      return $this->render('awesome/user.php', [
        'controller_name' => 'AwesomeController',

      ]);
    }

    public function routt()
    {
      $package = new Package(new EmptyVersionStrategy());
      $package->getUrl('/user.php');

        return $this->render('base.html.twig', [
            'name' => 'congcongking',
            'package'=>$package,

        ]);
    }




}
