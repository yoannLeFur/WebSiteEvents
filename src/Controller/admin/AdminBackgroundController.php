<?php


namespace App\Controller\admin;


use App\Entity\Background;
use App\Form\BackgroundType;
use App\Repository\BackgroundRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route(path="/admin/background/{slug}-{id}", name="admin.background.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Background $background, string $slug): Response
    {
        if($background->getSlug() !== $slug) {
            return $this->redirectToRoute('admin.background.show', [
                'id' => $background->getId(),
                'slug' => $background->getSlug(),
            ], 301);
        }
        return $this->render('admin/background/show.html.twig', [
            'background' => $background,
        ]);
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

    /**
     * @Route("/admin/background/{id}", name="admin.background.delete", methods="DELETE")
     * @param Background $background
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function delete(Background $background, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $background->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($background);
            $em->flush();
            $this->addFlash('success', 'La section background a bien été supprimer');
            return $this->redirectToRoute('admin.home');
        }

    }

}