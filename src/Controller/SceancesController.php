<?php

namespace App\Controller;

use App\Entity\Sceances;
use App\Form\SceancesType;
use App\Repository\SceancesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sceances')]
class SceancesController extends AbstractController
{
    #[Route('/', name: 'app_sceances_index', methods: ['GET'])]
    public function index(SceancesRepository $sceancesRepository): Response
    {
        return $this->render('sceances/index.html.twig', [
            'sceances' => $sceancesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sceances_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SceancesRepository $sceancesRepository): Response
    {
        $sceance = new Sceances();
        $form = $this->createForm(SceancesType::class, $sceance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sceancesRepository->add($sceance, true);

            return $this->redirectToRoute('app_sceances_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sceances/new.html.twig', [
            'sceance' => $sceance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sceances_show', methods: ['GET'])]
    public function show(Sceances $sceance): Response
    {
        return $this->render('sceances/show.html.twig', [
            'sceance' => $sceance,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sceances_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sceances $sceance, SceancesRepository $sceancesRepository): Response
    {
        $form = $this->createForm(SceancesType::class, $sceance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sceancesRepository->add($sceance, true);

            return $this->redirectToRoute('app_sceances_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sceances/edit.html.twig', [
            'sceance' => $sceance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sceances_delete', methods: ['POST'])]
    public function delete(Request $request, Sceances $sceance, SceancesRepository $sceancesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sceance->getId(), $request->request->get('_token'))) {
            $sceancesRepository->remove($sceance, true);
        }

        return $this->redirectToRoute('app_sceances_index', [], Response::HTTP_SEE_OTHER);
    }
}
