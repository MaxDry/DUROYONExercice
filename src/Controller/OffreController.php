<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Offre;
use App\Form\OffreType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/offre")
 */

class OffreController extends AbstractController
{
    /**
     * @Route("/", name="offre_index", methods={"GET"})
     */
    public function index(): Response
    {
        $offre = $this->getDoctrine()
            ->getRepository(Offre::class)
            ->findAll();

        return $this->render('offre/index.html.twig', [
            'offres' => $offre,
        ]);
    }

    /**
     * @Route("/new", name="offre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $offre = new Can();
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offre);
            $entityManager->flush();

            return $this->redirectToRoute('offre_index');
        }

        return $this->render('offre/new.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

        /**
     * @Route("/{name}/edit", name="offre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Offre $offre): Response
    {
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offre_index', [
                'name' => $offre->getName(),
            ]);
        }

        return $this->render('offre/edit.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{name}", name="offre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Offre $offre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offre->getName(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($offre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('offre_index');
    }
}
