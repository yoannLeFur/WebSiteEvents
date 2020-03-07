<?php


namespace App\Controller\admin;

use App\Repository\AgenceRepository;
use App\Repository\BackgroundRepository;
use App\Repository\CreationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/admin/accueil", name="admin.home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AgenceRepository $agenceRepository, BackgroundRepository $backgroundRepository, CreationsRepository $creationsRepository)
    {
        $agences = $agenceRepository->findAll();
        $backgrounds = $backgroundRepository->findAll();
        $creations = $creationsRepository->findAll();
        return $this->render('admin/home.html.twig', [
            'agences' => $agences,
            'backgrounds' => $backgrounds,
            'creations' => $creations,
        ]);
    }
}