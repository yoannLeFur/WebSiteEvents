<?php


namespace App\Controller\user;


use App\Repository\AgenceRepository;
use App\Repository\BackgroundRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route(name="home.index",path="/")
     * @param AgenceRepository $agenceRepository
     * @return Response
     */
    public function index(AgenceRepository $agenceRepository, BackgroundRepository $backgroundRepository)
    {
        $agences = $agenceRepository->findAll();
        $backgrounds = $backgroundRepository->findAll();
        return $this->render('user/home.html.twig', [
            'agences' => $agences,
            'backgrounds' => $backgrounds
        ]);
    }
}