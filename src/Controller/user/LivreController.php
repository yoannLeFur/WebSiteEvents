<?php


namespace App\Controller\user;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{

    /**
     * @Route(name="user.livre",path="/livre-d-Or")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('user/livre/livre.html.twig');
    }
}