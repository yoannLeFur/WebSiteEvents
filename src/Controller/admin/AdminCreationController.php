<?php


namespace App\Controller\admin;


use App\Entity\Agence;
use App\Entity\Creations;
use App\Form\AgenceType;
use App\Form\CreationType;
use App\Repository\AgenceRepository;
use App\Repository\CreationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminCreationController extends AbstractController
{

    /**
     * @var CreationsRepository
     */
    private $creationsRepository;


    public function __construct(CreationsRepository $creationsRepository)
    {
        $this->creationsRepository = $creationsRepository;
    }

    /**
     * @Route("/admin/creation/create", name="admin.creation.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $creation = new Creations();
        $form = $this->createForm(CreationType::class, $creation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($creation);
            $em->flush();
            $this->addFlash('success', 'La section Creation a été crée avec succès');
            return $this->redirectToRoute('admin.home');
        }

        return $this->render('admin/creations/new.html.twig', [
            'creation' => $creation,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/creation/{id}", name="admin.creation.edit", methods="GET|POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Creations $creation, Request $request)
    {
        $form = $this->createForm(CreationType::class, $creation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($creation);
            $em->flush();
            $this->addFlash('success', 'La section Creation a été modifié avec succès');
            return $this->redirectToRoute('admin.home');
        }

        return $this->render('admin/creations/edit.html.twig', [
            'creation' => $creation,
            'form' => $form->createView()
        ]);
    }

}