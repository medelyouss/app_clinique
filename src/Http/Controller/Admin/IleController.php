<?php

namespace App\Http\Controller\Admin;

use App\Principal\Entity\Ile;
use App\Http\Form\IleType;
use App\Principal\Repository\IleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mk_admin/ile")
 */
class IleController extends AbstractController
{
    /**
     * @Route("/", name="admin_ile_index", methods={"GET"})
     */
    public function index(IleRepository $ileRepository): Response
    {
        return $this->render('admin/ile/index.html.twig', [
            'iles' => $ileRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_ile_new", methods={"GET", "POST"})
     */
    public function new(Request $request, IleRepository $ileRepository): Response
    {
        $ile = new Ile();
        $form = $this->createForm(IleType::class, $ile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ileRepository->add($ile);

            $this->addFlash('success', "Opération effectuée avec succès!");

            return $this->redirectToRoute('admin_ile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/ile/new.html.twig', [
            'ile' => $ile,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_ile_show", methods={"GET"})
     */
    public function show(Ile $ile): Response
    {
        return $this->render('admin/ile/show.html.twig', [
            'ile' => $ile,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_ile_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Ile $ile, IleRepository $ileRepository): Response
    {
        $form = $this->createForm(IleType::class, $ile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ileRepository->add($ile);
            $this->addFlash('success', "Opération effectuée avec succès!");
            return $this->redirectToRoute('admin_ile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/ile/edit.html.twig', [
            'ile' => $ile,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_ile_delete", methods={"POST"})
     */
    public function delete(Request $request, Ile $ile, IleRepository $ileRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ile->getId(), $request->request->get('_token'))) {
            $ileRepository->remove($ile);
        }

        return $this->redirectToRoute('ile_index', [], Response::HTTP_SEE_OTHER);
    }
}
