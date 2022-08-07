<?php

namespace App\Controller;

use App\Entity\Cas;
use App\Form\CasType;
use App\Repository\CasRepository;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cas")
 */
class CasController extends AbstractController
{
    /**
     * @Route("/", name="app_cas_index", methods={"GET"})
     */
    public function index(CasRepository $casRepository): Response
    {
        return $this->render('cas/index.html.twig', [
            'cas' => $casRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_cas_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CasRepository $casRepository, PatientRepository $patientRepository): Response
    {
        $ca = new Cas();
        $form = $this->createForm(CasType::class, $ca);
        $ca->setCreatedAt(new \DateTime('now'));
        if ($request->get('id_patient')){
            $ca->setPatient($patientRepository->find($request->get('id_patient')));
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $casRepository->add($ca, true);

            $this->addFlash('success', 'Ajout effectué avec succès');
            return $this->redirectToRoute('app_patient_show', [
                'id' => $ca->getPatient()->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cas/new.html.twig', [
            'ca' => $ca,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_cas_show", methods={"GET"})
     */
    public function show(Cas $ca): Response
    {
        return $this->render('cas/show.html.twig', [
            'ca' => $ca,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_cas_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Cas $ca, CasRepository $casRepository): Response
    {
        $form = $this->createForm(CasType::class, $ca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $casRepository->add($ca, true);

            $this->addFlash('success', 'Modification effectuée avec succès');

            return $this->redirectToRoute('app_patient_show', [
                'id' => $ca->getPatient()->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cas/edit.html.twig', [
            'ca' => $ca,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_cas_delete", methods={"POST"})
     */
    public function delete(Request $request, Cas $ca, CasRepository $casRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ca->getId(), $request->request->get('_token'))) {
            $casRepository->remove($ca, true);
        }

        return $this->redirectToRoute('app_cas_index', [], Response::HTTP_SEE_OTHER);
    }
}
