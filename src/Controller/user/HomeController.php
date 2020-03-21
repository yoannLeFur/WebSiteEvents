<?php


namespace App\Controller\user;

use App\Repository\AgenceRepository;
use App\Repository\BackgroundRepository;
use App\Repository\CreationsRepository;
use App\Repository\GalerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route(name="user.home.index",path="/")
     * @param AgenceRepository $agenceRepository
     * @return Response
     */
    public function index(AgenceRepository $agenceRepository, BackgroundRepository $backgroundRepository, GalerieRepository $galerieRepository, CreationsRepository $creationsRepository)
    {
        $agences = $agenceRepository->findAll();
        $creations = $creationsRepository->findAll();
        $galeries = $galerieRepository->findAll();
        $backgrounds = $backgroundRepository->findAll();
        return $this->render('user/home.html.twig', [
            'agences' => $agences,
            'creations' => $creations,
            'galeries' => $galeries,
            'backgrounds' => $backgrounds
        ]);
    }
}