<?php

namespace App\Controller;

use App\Entity\Ligne5;
use App\Form\Ligne5Type;
use App\Repository\Ligne5Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ligne5')]
class Ligne5Controller extends AbstractController
{
    #[Route('/', name: 'app_ligne5_index', methods: ['GET'])]
    public function index(Ligne5Repository $ligne5Repository): Response
    {
        return $this->render('ligne5/index.html.twig', [
            'ligne5s' => $ligne5Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ligne5_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Ligne5Repository $ligne5Repository): Response
    {
        $ligne5 = new Ligne5();
        $form = $this->createForm(Ligne5Type::class, $ligne5);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligne5Repository->save($ligne5, true);

            return $this->redirectToRoute('app_ligne5_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne5/new.html.twig', [
            'ligne5' => $ligne5,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne5_show', methods: ['GET'])]
    public function show(Ligne5 $ligne5): Response
    {
        return $this->render('ligne5/show.html.twig', [
            'ligne5' => $ligne5,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ligne5_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ligne5 $ligne5, Ligne5Repository $ligne5Repository): Response
    {
        $form = $this->createForm(Ligne5Type::class, $ligne5);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligne5Repository->save($ligne5, true);

            return $this->redirectToRoute('app_ligne5_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne5/edit.html.twig', [
            'ligne5' => $ligne5,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne5_delete', methods: ['POST'])]
    public function delete(Request $request, Ligne5 $ligne5, Ligne5Repository $ligne5Repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ligne5->getId(), $request->request->get('_token'))) {
            $ligne5Repository->remove($ligne5, true);
        }

        return $this->redirectToRoute('app_ligne5_index', [], Response::HTTP_SEE_OTHER);
    }
}
