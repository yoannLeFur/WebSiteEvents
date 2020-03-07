<?php


namespace App\Controller\admin;


use App\Entity\Agence;
use App\Entity\Background;
use App\Form\AgenceType;
use App\Form\BackgroundType;
use App\Repository\AgenceRepository;
use App\Repository\BackgroundRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminBackgroundController extends AbstractController
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
     * @Route("/admin/backgound/create", name="admin.background.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $background = new Background();
        $form = $this->createForm(BackgroundType::class, $background);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($background);
            $em->flush();
            $this->addFlash('success', 'La section background a été crée avec succès');
            return $this->redirectToRoute('admin.home');
        }

        return $this->render('admin/background/new.html.twig', [
            'background' => $background,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/background/{id}", name="admin.background.edit", methods="GET|POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Background $background, Request $request)
    {
        $form = $this->createForm(BackgroundType::class, $background);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($background);
            $em->flush();
            $this->addFlash('success', 'La section background a été modifié avec succès');
            return $this->redirectToRoute('admin.home');
        }

        return $this->render('admin/background/edit.html.twig', [
            'background' => $background,
            'form' => $form->createView()
        ]);
    }

}