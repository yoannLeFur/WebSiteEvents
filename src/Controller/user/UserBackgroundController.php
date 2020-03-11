<?php


namespace App\Controller\user;


use App\Entity\Background;
use App\Repository\BackgroundRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserBackgroundController extends AbstractController
{

    /**
     * @var BackgroundRepository
     */
    private $backgroundRepository;


    public function __construct(BackgroundRepository $backgroundRepository)
    {
        $this->backgroundRepository = $backgroundRepository;
    }

    /**
     * @Route(path="/background/{slug}-{id}", name="user.background.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Background $background, string $slug): Response
    {
        if($background->getSlug() !== $slug) {
            return $this->redirectToRoute('user.background.show', [
                'id' => $background->getId(),
                'slug' => $background->getSlug(),
            ], 301);
        }
        return $this->render('user/home.html.twig', [
            'background' => $background,
        ]);
    }

}