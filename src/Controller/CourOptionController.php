<?php

namespace App\Controller;

use App\Entity\CourOption;
use App\Form\CourOptionType;
use App\Repository\CourOptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cour/option")
 */
class CourOptionController extends AbstractController
{
    /**
     * @Route("/", name="cour_option_index", methods={"GET"})
     */
    public function index(CourOptionRepository $courOptionRepository): Response
    {
        return $this->render('cour_option/index.html.twig', [
            'cour_options' => $courOptionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cour_option_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $courOption = new CourOption();
        $form = $this->createForm(CourOptionType::class, $courOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($courOption);
            $entityManager->flush();

            return $this->redirectToRoute('cour_option_index');
        }

        return $this->render('cour_option/new.html.twig', [
            'cour_option' => $courOption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cour_option_show", methods={"GET"})
     */
    public function show(CourOption $courOption): Response
    {
        return $this->render('cour_option/show.html.twig', [
            'cour_option' => $courOption,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cour_option_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CourOption $courOption): Response
    {
        $form = $this->createForm(CourOptionType::class, $courOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cour_option_index');
        }

        return $this->render('cour_option/edit.html.twig', [
            'cour_option' => $courOption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cour_option_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CourOption $courOption): Response
    {
        if ($this->isCsrfTokenValid('delete'.$courOption->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($courOption);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cour_option_index');
    }
}
