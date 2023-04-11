<?php

namespace App\Controller;

use App\Entity\Ligne6;
use App\Form\Ligne6Type;
use App\Repository\Ligne6Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ligne6')]
class Ligne6Controller extends AbstractController
{
    #[Route('/', name: 'app_ligne6_index', methods: ['GET'])]
    public function index(Ligne6Repository $ligne6Repository): Response
    {
        return $this->render('ligne6/index.html.twig', [
            'ligne6s' => $ligne6Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ligne6_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Ligne6Repository $ligne6Repository): Response
    {
        $ligne6 = new Ligne6();
        $form = $this->createForm(Ligne6Type::class, $ligne6);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligne6Repository->save($ligne6, true);

            return $this->redirectToRoute('app_ligne6_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne6/new.html.twig', [
            'ligne6' => $ligne6,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne6_show', methods: ['GET'])]
    public function show(Ligne6 $ligne6): Response
    {
        return $this->render('ligne6/show.html.twig', [
            'ligne6' => $ligne6,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ligne6_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ligne6 $ligne6, Ligne6Repository $ligne6Repository): Response
    {
        $form = $this->createForm(Ligne6Type::class, $ligne6);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligne6Repository->save($ligne6, true);

            return $this->redirectToRoute('app_ligne6_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne6/edit.html.twig', [
            'ligne6' => $ligne6,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne6_delete', methods: ['POST'])]
    public function delete(Request $request, Ligne6 $ligne6, Ligne6Repository $ligne6Repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ligne6->getId(), $request->request->get('_token'))) {
            $ligne6Repository->remove($ligne6, true);
        }

        return $this->redirectToRoute('app_ligne6_index', [], Response::HTTP_SEE_OTHER);
    }
}
