<?php


namespace App\Controller\admin;

use App\Repository\AgenceRepository;
use App\Repository\BackgroundRepository;
use App\Repository\CreationsRepository;
use App\Repository\ImagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var AgenceRepository
     */
    private $agenceRepository;

    /**
     * @var CreationsRepository
     */
    private $creationsRepository;

    /**
     * @var BackgroundRepository
     */
    private $backgroundRepository;

    /**
     * @var ImagesRepository
     */
    private $imagesRepository;


    public function __construct(AgenceRepository $agenceRepository, BackgroundRepository $backgroundRepository, CreationsRepository $creationsRepository, ImagesRepository $imagesRepository )
    {
        $this->agenceRepository = $agenceRepository;
        $this->backgroundRepository = $backgroundRepository;
        $this->creationsRepository = $creationsRepository;
        $this->imagesRepository = $imagesRepository;

    }


    /**
     * @Route("/admin/accueil", name="admin.home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $agences = $this->agenceRepository->findAll();
        $galeries = $this->imagesRepository->findAll();
        $backgrounds = $this->backgroundRepository->findAll();
        $creations = $this->creationsRepository->findAll();
        return $this->render('admin/home.html.twig', [
            'agences' => $agences,
            'galeries' => $galeries,
            'backgrounds' => $backgrounds,
            'creations' => $creations,
        ]);
    }
}