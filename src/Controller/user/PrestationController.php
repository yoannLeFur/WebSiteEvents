<?php


namespace App\Controller\user;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestationController extends AbstractController
{
    /**
     * @Route(name="prestation",path="/prestation")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('user/prestation.html.twig');
    }
}