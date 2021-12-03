<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Form\FactureType;
use App\Repository\FactureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

/**
 * @Route("/facture")
 */
class FactureController extends AbstractController
{

    /**
     * @Route("/", name="facture_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {

        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();
        
        // Get some repository of data, in our case we have an Appointments entity
        $factureRepository = $em->getRepository(Facture::class);
                        
        // Find all the data on the Appointments table, filter your query as you need
        $query = $factureRepository->createQueryBuilder('p')
        ->getQuery();

        $pagination = $paginator->paginate(
            $query, 
            $request->query->getInt('page', 1), 
            3 
        );
    
        // parameters to template
        return $this->render('facture/index.html.twig', ['factures' => $pagination]);
    }

    /**
     * @Route("/new", name="facture_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $facture = new Facture();
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($facture);
            $entityManager->flush();

            return $this->redirectToRoute('facture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('facture/new.html.twig', [
            'facture' => $facture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="facture_show", methods={"GET"})
     */
    public function show(Facture $facture): Response
    {
        return $this->render('facture/show.html.twig', [
            'facture' => $facture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="facture_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Facture $facture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('facture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('facture/edit.html.twig', [
            'facture' => $facture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="facture_delete", methods={"POST"})
     */
    public function delete(Request $request, Facture $facture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$facture->getId(), $request->request->get('_token'))) {
            $entityManager->remove($facture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('facture_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("", name="facture_pdf", methods={"POST"})
     */
    public function pdfAction()
    {
        $knpSnappyPdf->generateFromHtml(
        $this->render('facture/index.html.twig', [
            'factures' => $factureRepository->findAll(),
        ]),
        'D:\xampp\htdocs\azizpi\var\cache\dev\snappy\file.pdf'
         );
         
        $html = $this->render('facture/index.html.twig', [
            'factures' => $factureRepository->findAll(),
        ]);

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            'file.pdf'
        );
    }


    
    /**
     * @Route("search", name="ajax_search", methods={"GET"})
     */
        public function searchAction(Request $request)
        {
            $em = $this->getDoctrine()->getManager();
      
            $requestString = $request->get('q');
      
            $entities =  $em->getRepository('App:Facture')->findEntitiesByString($requestString);
      
            if(!$entities) {
                $result['entities']['error'] = "search not found";
            } else {
                $result['entities'] = $this->getRealEntities($entities);
            }
      
            return new Response(json_encode($result));
        }
      
        public function getRealEntities($entities){
      
            foreach ($entities as $entity){
                $realEntities[$entity->getId()] = $entity->getNomUser();
            }
      
            return $realEntities;
        }

}
