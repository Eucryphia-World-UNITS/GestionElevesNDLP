<?php

namespace App\Controller;

use App\Entity\TypeFormation;
use App\Form\TypeFormationType;
use App\Repository\TypeFormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/formation")
 */
class TypeFormationController extends AbstractController
{
    /**
     * @Route("/", name="type_formation_index", methods={"GET"})
     */
    public function index(TypeFormationRepository $typeFormationRepository): Response
    {
        return $this->render('type_formation/index.html.twig', [
            'type_formations' => $typeFormationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_formation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeFormation = new TypeFormation();
        $form = $this->createForm(TypeFormationType::class, $typeFormation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeFormation);
            $entityManager->flush();

            return $this->redirectToRoute('type_formation_index');
        }

        return $this->render('type_formation/new.html.twig', [
            'type_formation' => $typeFormation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_formation_show", methods={"GET"})
     */
    public function show(TypeFormation $typeFormation): Response
    {
        return $this->render('type_formation/show.html.twig', [
            'type_formation' => $typeFormation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_formation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeFormation $typeFormation): Response
    {
        $form = $this->createForm(TypeFormationType::class, $typeFormation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_formation_index');
        }

        return $this->render('type_formation/edit.html.twig', [
            'type_formation' => $typeFormation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_formation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeFormation $typeFormation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeFormation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeFormation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_formation_index');
    }
}
