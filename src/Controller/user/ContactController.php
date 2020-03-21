<?php


namespace App\Controller\user;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route(name="user.contact",path="/contact")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('user/contact/contact.html.twig');
    }
}