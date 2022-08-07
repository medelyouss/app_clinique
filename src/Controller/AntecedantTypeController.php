<?php

namespace App\Controller;

use App\Entity\AntecedantType;
use App\Form\AntecedantTypeType;
use App\Repository\AntecedantTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/antecedant/type")
 */
class AntecedantTypeController extends AbstractController
{
    /**
     * @Route("/", name="app_antecedanttype_index", methods={"GET"})
     */
    public function index(AntecedantTypeRepository $antecedantTypeRepository): Response
    {
        return $this->render('antecedant_type/index.html.twig', [
            'antecedant_types' => $antecedantTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_antecedanttype_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AntecedantTypeRepository $antecedantTypeRepository): Response
    {
        $antecedantType = new AntecedantType();
        $form = $this->createForm(AntecedantTypeType::class, $antecedantType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $antecedantTypeRepository->add($antecedantType, true);

            $this->addFlash('success', 'Ajout effectué avec succès');

            return $this->redirectToRoute('app_antecedanttype_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('antecedant_type/new.html.twig', [
            'antecedant_type' => $antecedantType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_antecedanttype_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, AntecedantType $antecedantType, AntecedantTypeRepository $antecedantTypeRepository): Response
    {
        $form = $this->createForm(AntecedantTypeType::class, $antecedantType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $antecedantTypeRepository->add($antecedantType, true);

            $this->addFlash('success', 'Modification effectuée avec succès');

            return $this->redirectToRoute('app_antecedanttype_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('antecedant_type/edit.html.twig', [
            'antecedant_type' => $antecedantType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_antecedanttype_delete", methods={"POST"})
     */
    public function delete(Request $request, AntecedantType $antecedantType, AntecedantTypeRepository $antecedantTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$antecedantType->getId(), $request->request->get('_token'))) {
            $antecedantTypeRepository->remove($antecedantType, true);
        }

        return $this->redirectToRoute('app_antecedant_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
