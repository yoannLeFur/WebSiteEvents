<?php


namespace App\Controller\user;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreationController extends AbstractController
{
    /**
     * @Route(name="creation",path="/creations")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('user/creation.html.twig');
    }
}