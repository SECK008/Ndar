<?php

namespace App\Controller;

use App\Entity\Ligne4;
use App\Form\Ligne4Type;
use App\Repository\Ligne4Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ligne4')]
class Ligne4Controller extends AbstractController
{
    #[Route('/', name: 'app_ligne4_index', methods: ['GET'])]
    public function index(Ligne4Repository $ligne4Repository): Response
    {
        return $this->render('ligne4/index.html.twig', [
            'ligne4s' => $ligne4Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ligne4_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Ligne4Repository $ligne4Repository): Response
    {
        $ligne4 = new Ligne4();
        $form = $this->createForm(Ligne4Type::class, $ligne4);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligne4Repository->save($ligne4, true);

            return $this->redirectToRoute('app_ligne4_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne4/new.html.twig', [
            'ligne4' => $ligne4,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne4_show', methods: ['GET'])]
    public function show(Ligne4 $ligne4): Response
    {
        return $this->render('ligne4/show.html.twig', [
            'ligne4' => $ligne4,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ligne4_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ligne4 $ligne4, Ligne4Repository $ligne4Repository): Response
    {
        $form = $this->createForm(Ligne4Type::class, $ligne4);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligne4Repository->save($ligne4, true);

            return $this->redirectToRoute('app_ligne4_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne4/edit.html.twig', [
            'ligne4' => $ligne4,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne4_delete', methods: ['POST'])]
    public function delete(Request $request, Ligne4 $ligne4, Ligne4Repository $ligne4Repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ligne4->getId(), $request->request->get('_token'))) {
            $ligne4Repository->remove($ligne4, true);
        }

        return $this->redirectToRoute('app_ligne4_index', [], Response::HTTP_SEE_OTHER);
    }
}
