<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Candidature;
use App\Form\CandidatureType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/candidature")
 */
class CandidatureController extends AbstractController
{
    /**
     * @Route("/", name="candidature_index", methods={"GET"})
     */
    public function index(): Response
    {
        $candidature = $this->getDoctrine()
            ->getRepository(Candidature::class)
            ->findAll();

        return $this->render('candidature/index.html.twig', [
            'candidatures' => $candidature,
        ]);
    }

    /**
     * @Route("/new", name="candidature_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $candidature = new Can();
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($candidature);
            $entityManager->flush();

            return $this->redirectToRoute('candidature_index');
        }

        return $this->render('candidature/new.html.twig', [
            'candidature' => $candidature,
            'form' => $form->createView(),
        ]);
    }

        /**
     * @Route("/{name}/edit", name="candidature_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Candidature $candidature): Response
    {
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('candidature_index', [
                'name' => $candidature->getName(),
            ]);
        }

        return $this->render('candidature/edit.html.twig', [
            'candidature' => $candidature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{name}", name="candidature_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Candidature $candidature): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidature->getName(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($candidature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('candidature_index');
    }
}
