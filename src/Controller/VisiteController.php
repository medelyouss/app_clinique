<?php

namespace App\Controller;

use App\Entity\Visite;
use App\Form\VisiteType;
use App\Repository\CasRepository;
use App\Repository\PatientRepository;
use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/visite")
 */
class VisiteController extends AbstractController
{
    /**
     * @Route("/", name="app_visite_index", methods={"GET"})
     */
    public function index(VisiteRepository $visiteRepository): Response
    {
        return $this->render('visite/index.html.twig', [
            'visites' => $visiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_visite_new", methods={"GET", "POST"})
     */
    public function new(Request $request, VisiteRepository $visiteRepository, CasRepository $casRepository): Response
    {
        $visite = new Visite();
        $cas = null;
        if ($request->get('id_cas')){
            $cas = $casRepository->find($request->get('id_cas'));
            $visite->setCas($cas);
        }
        $visite->setDateVisiteAt(new \DateTime('now'));

        $form = $this->createForm(VisiteType::class, $visite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $visiteRepository->add($visite, true);

            $this->addFlash('success', "Ajout réussi");

            return $this->redirectToRoute('app_patient_show', [
                'id' => $visite->getCas()->getPatient()->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('visite/new.html.twig', [
            'visite'        => $visite,
            'form'          => $form,
            'cas'           => $cas,
        ]);
    }

    /**
     * @Route("/{id}", name="app_visite_show", methods={"GET"})
     */
    public function show(Visite $visite): Response
    {
        return $this->render('visite/show.html.twig', [
            'visite' => $visite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_visite_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Visite $visite, VisiteRepository $visiteRepository): Response
    {
        $form = $this->createForm(VisiteType::class, $visite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $visiteRepository->add($visite, true);

            $this->addFlash('success', 'Modifications effectuées avec succès!');

            if ($request->get('id_cas')){
                return $this->redirectToRoute('app_cas_show', [
                    'id' => $visite->getCas()->getId()
                ], Response::HTTP_SEE_OTHER);
            }
            return $this->redirectToRoute('app_patient_show', [
                'id' => $visite->getCas()->getPatient()->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('visite/edit.html.twig', [
            'visite' => $visite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_visite_delete", methods={"POST"})
     */
    public function delete(Request $request, Visite $visite, VisiteRepository $visiteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$visite->getId(), $request->request->get('_token'))) {
            $visiteRepository->remove($visite, true);
        }

        return $this->redirectToRoute('app_visite_index', [], Response::HTTP_SEE_OTHER);
    }
}
