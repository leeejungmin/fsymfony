<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends AbstractController
{
    /**
     * @Route("/mainasdf", name="mainasdf")
     */
    public function getUsers()
    {
        $em = $this->getDoctrine();
        $usersFromDoctrine = $em->getRepository("FooBarBundle:User")->findAll();
        $users = array();

        foreach($usersFromDoctrine as $user){
            $users[$user->getId()] = array(
              "id" => $user->getId(),
            );
        }

        return new JsonResponse($user);

    }
}
