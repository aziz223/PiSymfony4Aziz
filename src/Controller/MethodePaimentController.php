<?php

namespace App\Controller;

use App\Entity\MethodePaiment;
use App\Form\MethodePaimentType;
use App\Repository\MethodePaimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/methode/paiment")
 */
class MethodePaimentController extends AbstractController
{
    /**
     * @Route("/", name="methode_paiment_index", methods={"GET"})
     */
    public function index(MethodePaimentRepository $methodePaimentRepository): Response
    {
        return $this->render('methode_paiment/index.html.twig', [
            'methode_paiments' => $methodePaimentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="methode_paiment_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $methodePaiment = new MethodePaiment();
        $form = $this->createForm(MethodePaimentType::class, $methodePaiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($methodePaiment);
            $entityManager->flush();

            return $this->redirectToRoute('methode_paiment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('methode_paiment/new.html.twig', [
            'methode_paiment' => $methodePaiment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="methode_paiment_show", methods={"GET"})
     */
    public function show(MethodePaiment $methodePaiment): Response
    {
        return $this->render('methode_paiment/show.html.twig', [
            'methode_paiment' => $methodePaiment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="methode_paiment_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, MethodePaiment $methodePaiment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MethodePaimentType::class, $methodePaiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('methode_paiment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('methode_paiment/edit.html.twig', [
            'methode_paiment' => $methodePaiment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="methode_paiment_delete", methods={"POST"})
     */
    public function delete(Request $request, MethodePaiment $methodePaiment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$methodePaiment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($methodePaiment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('methode_paiment_index', [], Response::HTTP_SEE_OTHER);
    }
}
