<?php


namespace App\Controller\user;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalerieController extends AbstractController
{
    /**
     * @Route(name="user.galerie",path="/galerie")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('user/galerie/galerie.html.twig');
    }
}