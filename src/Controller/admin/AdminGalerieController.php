<?php


namespace App\Controller\admin;


use App\Entity\Images;
use App\Form\GalerieType;
use App\Form\ImagesType;
use App\Repository\ImagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminGalerieController extends AbstractController
{

    /**
     * @var ImagesRepository
     */
    private $imagesRepository;


    public function __construct(ImagesRepository $imagesRepository)
    {
        $this->imagesRepository = $imagesRepository;
    }

    /**
     * @Route(path="/admin/galerie/{slug}-{id}", name="admin.galerie.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Images $galerie, string $slug): Response
    {

        if($galerie->getSlug() !== $slug) {
            return $this->redirectToRoute('admin.galerie.show', [
                'id' => $galerie->getId(),
                'slug' => $galerie->getSlug(),
            ], 301);
        }
        return $this->render('admin/galerie/show.html.twig', [
            'galerie' => $galerie,
        ]);
    }

    /**
     * @Route("/admin/galerie/create", name="admin.galerie.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $galerie = new Images();
        $form = $this->createForm(GalerieType::class, $galerie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($galerie);
            $em->flush();
            $this->addFlash('success', 'La section galerie a été crée avec succès');
            return $this->redirectToRoute('admin.home');
        }

        return $this->render('admin/galerie/new.html.twig', [
            'galerie' => $galerie,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/galerie/{id}", name="admin.galerie.edit", methods="GET|POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Images $galerie, Request $request)
    {
        $form = $this->createForm(GalerieType::class, $galerie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($galerie);
            $em->flush();
            $this->addFlash('success', 'La section galerie a été modifié avec succès');
            return $this->redirectToRoute('admin.home');
        }

        return $this->render('admin/galerie/edit.html.twig', [
            'galerie' => $galerie,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/galerie/{id}", name="admin.galerie.delete", methods="DELETE")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function delete(Images $galerie, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $galerie->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($galerie);
            $em->flush();
            $this->addFlash('success', 'La section Galerie a bien été supprimer');
            return $this->redirectToRoute('admin.home');
        }

    }
}