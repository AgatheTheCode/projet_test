<?php

namespace App\Controller;

use App\Entity\Castle;
use App\Form\CastleType;
use App\Repository\CastleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/castle')]
class CastleController extends AbstractController
{
    #[Route('/', name: 'app_castle_index', methods: ['GET'])]
    public function index(CastleRepository $castleRepository): Response
    {
        return $this->render('castle/index.html.twig', [
            'castles' => $castleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_castle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CastleRepository $castleRepository): Response
    {
        $castle = new Castle();
        $form = $this->createForm(CastleType::class, $castle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $castleRepository->save($castle, true);

            return $this->redirectToRoute('app_castle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('castle/new.html.twig', [
            'castle' => $castle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_castle_show', methods: ['GET'])]
    public function show(Castle $castle): Response
    {
        return $this->render('castle/show.html.twig', [
            'castle' => $castle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_castle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Castle $castle, CastleRepository $castleRepository): Response
    {
        $form = $this->createForm(CastleType::class, $castle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $castleRepository->save($castle, true);

            return $this->redirectToRoute('app_castle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('castle/edit.html.twig', [
            'castle' => $castle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_castle_delete', methods: ['POST'])]
    public function delete(Request $request, Castle $castle, CastleRepository $castleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$castle->getId(), $request->request->get('_token'))) {
            $castleRepository->remove($castle, true);
        }

        return $this->redirectToRoute('app_castle_index', [], Response::HTTP_SEE_OTHER);
    }
}
