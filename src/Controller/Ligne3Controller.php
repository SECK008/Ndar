<?php

namespace App\Controller;

use App\Entity\Ligne3;
use App\Form\Ligne3Type;
use App\Repository\Ligne3Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ligne3')]
class Ligne3Controller extends AbstractController
{
    #[Route('/', name: 'app_ligne3_index', methods: ['GET'])]
    public function index(Ligne3Repository $ligne3Repository): Response
    {
        return $this->render('ligne3/index.html.twig', [
            'ligne3s' => $ligne3Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ligne3_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Ligne3Repository $ligne3Repository): Response
    {
        $ligne3 = new Ligne3();
        $form = $this->createForm(Ligne3Type::class, $ligne3);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligne3Repository->save($ligne3, true);

            return $this->redirectToRoute('app_ligne3_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne3/new.html.twig', [
            'ligne3' => $ligne3,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne3_show', methods: ['GET'])]
    public function show(Ligne3 $ligne3): Response
    {
        return $this->render('ligne3/show.html.twig', [
            'ligne3' => $ligne3,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ligne3_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ligne3 $ligne3, Ligne3Repository $ligne3Repository): Response
    {
        $form = $this->createForm(Ligne3Type::class, $ligne3);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligne3Repository->save($ligne3, true);

            return $this->redirectToRoute('app_ligne3_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne3/edit.html.twig', [
            'ligne3' => $ligne3,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne3_delete', methods: ['POST'])]
    public function delete(Request $request, Ligne3 $ligne3, Ligne3Repository $ligne3Repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ligne3->getId(), $request->request->get('_token'))) {
            $ligne3Repository->remove($ligne3, true);
        }

        return $this->redirectToRoute('app_ligne3_index', [], Response::HTTP_SEE_OTHER);
    }
}
