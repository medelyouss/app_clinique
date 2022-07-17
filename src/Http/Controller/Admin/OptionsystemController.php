<?php

namespace App\Http\Controller\Admin;

use App\Principal\Entity\Optionsystem;
use App\Http\Form\OptionsystemType;
use App\Principal\Repository\OptionsystemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mk_admin/optionsystem")
 */
class OptionsystemController extends AbstractController
{
    /**
     * @Route("/", name="admin_optionsystem_index", methods={"GET"})
     */
    public function index(OptionsystemRepository $optionsystemRepository): Response
    {

        return $this->render('admin/optionsystem/index.html.twig', [
            'optionsystem' => $optionsystemRepository->getTheLastOne(),
        ]);
    }

    /**
     * @Route("/new", name="admin_optionsystem_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OptionsystemRepository $optionsystemRepository): Response
    {
        $optionsystem = new Optionsystem();

        $form = $this->createForm(OptionsystemType::class, $optionsystem, [
            'update' => $optionsystem->getId()==null?false:true,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $optionsystemRepository->add($optionsystem);
            return $this->redirectToRoute('admin_optionsystem_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/optionsystem/new.html.twig', [
            'optionsystem' => $optionsystem,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_optionsystem_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Optionsystem $optionsystem, OptionsystemRepository $optionsystemRepository): Response
    {
        $form = $this->createForm(OptionsystemType::class, $optionsystem, [
            'update' => $optionsystem->getId()==null?false:true,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $optionsystemRepository->add($optionsystem);
            return $this->redirectToRoute('admin_optionsystem_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/optionsystem/edit.html.twig', [
            'optionsystem' => $optionsystem,
            'form' => $form,
        ]);
    }
}
