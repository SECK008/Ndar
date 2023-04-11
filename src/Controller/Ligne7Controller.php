<?php

namespace App\Controller;

use App\Entity\Ligne7;
use App\Form\Ligne7Type;
use App\Repository\Ligne7Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ligne7')]
class Ligne7Controller extends AbstractController
{
    #[Route('/', name: 'app_ligne7_index', methods: ['GET'])]
    public function index(Ligne7Repository $ligne7Repository): Response
    {
        return $this->render('ligne7/index.html.twig', [
            'ligne7s' => $ligne7Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ligne7_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Ligne7Repository $ligne7Repository): Response
    {
        $ligne7 = new Ligne7();
        $form = $this->createForm(Ligne7Type::class, $ligne7);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligne7Repository->save($ligne7, true);

            return $this->redirectToRoute('app_ligne7_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne7/new.html.twig', [
            'ligne7' => $ligne7,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne7_show', methods: ['GET'])]
    public function show(Ligne7 $ligne7): Response
    {
        return $this->render('ligne7/show.html.twig', [
            'ligne7' => $ligne7,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ligne7_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ligne7 $ligne7, Ligne7Repository $ligne7Repository): Response
    {
        $form = $this->createForm(Ligne7Type::class, $ligne7);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligne7Repository->save($ligne7, true);

            return $this->redirectToRoute('app_ligne7_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne7/edit.html.twig', [
            'ligne7' => $ligne7,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne7_delete', methods: ['POST'])]
    public function delete(Request $request, Ligne7 $ligne7, Ligne7Repository $ligne7Repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ligne7->getId(), $request->request->get('_token'))) {
            $ligne7Repository->remove($ligne7, true);
        }

        return $this->redirectToRoute('app_ligne7_index', [], Response::HTTP_SEE_OTHER);
    }
}
