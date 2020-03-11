<?php


namespace App\Controller\admin;


use App\Entity\Agence;
use App\Form\AgenceType;
use App\Repository\AgenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminAgenceController extends AbstractController
{

    /**
     * @var AgenceRepository
     */
    private $agenceRepository;


    public function __construct(AgenceRepository $agenceRepository)
    {
        $this->agenceRepository = $agenceRepository;
    }

    /**
     * @Route(path="/admin/agence/{slug}-{id}", name="admin.agence.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Agence $agence, string $slug): Response
    {

        if($agence->getSlug() !== $slug) {
            return $this->redirectToRoute('admin.agence.show', [
                'id' => $agence->getId(),
                'slug' => $agence->getSlug(),
            ], 301);
        }
        return $this->render('admin/agence/show.html.twig', [
            'agence' => $agence,
        ]);
    }

    /**
     * @Route("/admin/agence/create", name="admin.agence.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $agence = new Agence();
        $form = $this->createForm(AgenceType::class, $agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agence);
            $em->flush();
            $this->addFlash('success', 'La section agence a été crée avec succès');
            return $this->redirectToRoute('admin.home');
        }

        return $this->render('admin/agence/new.html.twig', [
            "current_menu" => 'agence-admin',
            'agence' => $agence,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/agence/{id}", name="admin.agence.edit", methods="GET|POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Agence $agence, Request $request)
    {
        $form = $this->createForm(AgenceType::class, $agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agence);
            $em->flush();
            $this->addFlash('success', 'La section agence a été modifié avec succès');
            return $this->redirectToRoute('admin.home');
        }

        return $this->render('admin/agence/edit.html.twig', [
            'agence' => $agence,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/agence/{id}", name="admin.agence.delete", methods="DELETE")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function delete(Agence $agence, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $agence->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($agence);
            $em->flush();
            $this->addFlash('success', 'La section Agence a bien été supprimer');
            return $this->redirectToRoute('admin.home');
        }

    }

}