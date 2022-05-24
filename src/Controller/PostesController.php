<?php

namespace App\Controller;

use App\Entity\Postes;
use App\Form\PostesType;
use App\Repository\PostesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/postes')]
class PostesController extends AbstractController
{
    #[Route('/', name: 'app_postes_index', methods: ['GET'])]
    public function index(PostesRepository $postesRepository): Response
    {
        return $this->render('postes/index.html.twig', [
            'postes' => $postesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_postes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PostesRepository $postesRepository): Response
    {
        $poste = new Postes();
        $form = $this->createForm(PostesType::class, $poste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postesRepository->add($poste, true);

            return $this->redirectToRoute('app_postes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('postes/new.html.twig', [
            'poste' => $poste,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_postes_show', methods: ['GET'])]
    public function show(Postes $poste): Response
    {
        return $this->render('postes/show.html.twig', [
            'poste' => $poste,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_postes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Postes $poste, PostesRepository $postesRepository): Response
    {
        $form = $this->createForm(PostesType::class, $poste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postesRepository->add($poste, true);

            return $this->redirectToRoute('app_postes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('postes/edit.html.twig', [
            'poste' => $poste,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_postes_delete', methods: ['POST'])]
    public function delete(Request $request, Postes $poste, PostesRepository $postesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$poste->getId(), $request->request->get('_token'))) {
            $postesRepository->remove($poste, true);
        }

        return $this->redirectToRoute('app_postes_index', [], Response::HTTP_SEE_OTHER);
    }
}
