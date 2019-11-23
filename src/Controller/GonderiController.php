<?php

namespace App\Controller;

use App\Entity\Gonderi;
use App\Form\GonderiType;
use App\Repository\GonderiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class GonderiController extends AbstractController
{
    /**
     * @Route("/", name="gonderi_index", methods={"GET"})
     */
    public function index(GonderiRepository $gonderiRepository): Response
    {
        return $this->render('gonderi/index.html.twig', [
            'gonderis' => $gonderiRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gonderi_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {

        $gonderi = new Gonderi();
        $form = $this->createForm(GonderiType::class, $gonderi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gonderi);
            $entityManager->flush();

            return $this->redirectToRoute('gonderi_index');
        }

        return $this->render('gonderi/new.html.twig', [
            'gonderi' => $gonderi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gonderi_show", methods={"GET"})
     */
    public function show(Gonderi $gonderi): Response
    {
        return $this->render('gonderi/show.html.twig', [
            'gonderi' => $gonderi,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gonderi_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Gonderi $gonderi): Response
    {
        $form = $this->createForm(GonderiType::class, $gonderi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gonderi_index');
        }

        return $this->render('gonderi/edit.html.twig', [
            'gonderi' => $gonderi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gonderi_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Gonderi $gonderi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gonderi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gonderi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gonderi_index');
    }
}
