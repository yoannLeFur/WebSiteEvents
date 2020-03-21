<?php


namespace App\Controller\user;


use App\Entity\Creations;
use App\Entity\Product;
use App\Service\Basket\BasketService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreationController extends AbstractController
{
    /**
     * @Route(name="user.creation",path="/creations")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('user/creation/creation.html.twig');
    }

    /**
     * @Route(name="user.creation.show", path="/{slug}-{id}", requirements={"slug": "[a-z0-9\-]*"})
     * @param Creations $creation
     * @return Response
     */
    public function show(Creations $creation, string $slug): Response
    {

        if($creation->getSlug() !== $slug) {
            return $this->redirectToRoute('user.creation.show', [
                'id' => $creation->getId(),
                'slug' => $creation->getSlug(),
            ], 301);
        }
        return $this->render('user/creation/show.html.twig', [
            'creation' => $creation,
        ]);
    }
}