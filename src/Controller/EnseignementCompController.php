<?php

namespace App\Controller;

use App\Entity\EnseignementComp;
use App\Form\EnseignementCompType;
use App\Repository\EnseignementCompRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/enseignement/comp")
 */
class EnseignementCompController extends AbstractController
{
    /**
     * @Route("/", name="enseignement_comp_index", methods={"GET"})
     */
    public function index(EnseignementCompRepository $enseignementCompRepository): Response
    {
        return $this->render('enseignement_comp/index.html.twig', [
            'enseignement_comps' => $enseignementCompRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="enseignement_comp_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $enseignementComp = new EnseignementComp();
        $form = $this->createForm(EnseignementCompType::class, $enseignementComp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($enseignementComp);
            $entityManager->flush();

            return $this->redirectToRoute('enseignement_comp_index');
        }

        return $this->render('enseignement_comp/new.html.twig', [
            'enseignement_comp' => $enseignementComp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="enseignement_comp_show", methods={"GET"})
     */
    public function show(EnseignementComp $enseignementComp): Response
    {
        return $this->render('enseignement_comp/show.html.twig', [
            'enseignement_comp' => $enseignementComp,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="enseignement_comp_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EnseignementComp $enseignementComp): Response
    {
        $form = $this->createForm(EnseignementCompType::class, $enseignementComp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enseignement_comp_index');
        }

        return $this->render('enseignement_comp/edit.html.twig', [
            'enseignement_comp' => $enseignementComp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="enseignement_comp_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EnseignementComp $enseignementComp): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enseignementComp->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($enseignementComp);
            $entityManager->flush();
        }

        return $this->redirectToRoute('enseignement_comp_index');
    }
}
