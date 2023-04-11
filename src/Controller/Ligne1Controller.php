<?php

namespace App\Controller;

use App\Entity\Ligne1;
use App\Form\Ligne1Type;
use App\Repository\Ligne1Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ligne1')]
class Ligne1Controller extends AbstractController
{
    #[Route('/', name: 'app_ligne1_index', methods: ['GET'])]
    public function index(Ligne1Repository $ligne1Repository): Response
    {
        return $this->render('ligne1/index.html.twig', [
            'ligne1s' => $ligne1Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ligne1_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Ligne1Repository $ligne1Repository): Response
    {
        $ligne1 = new Ligne1();
        $form = $this->createForm(Ligne1Type::class, $ligne1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligne1Repository->save($ligne1, true);

            return $this->redirectToRoute('app_ligne1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne1/new.html.twig', [
            'ligne1' => $ligne1,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne1_show', methods: ['GET'])]
    public function show(Ligne1 $ligne1): Response
    {
        return $this->render('ligne1/show.html.twig', [
            'ligne1' => $ligne1,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ligne1_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ligne1 $ligne1, Ligne1Repository $ligne1Repository): Response
    {
        $form = $this->createForm(Ligne1Type::class, $ligne1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligne1Repository->save($ligne1, true);

            return $this->redirectToRoute('app_ligne1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne1/edit.html.twig', [
            'ligne1' => $ligne1,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne1_delete', methods: ['POST'])]
    public function delete(Request $request, Ligne1 $ligne1, Ligne1Repository $ligne1Repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ligne1->getId(), $request->request->get('_token'))) {
            $ligne1Repository->remove($ligne1, true);
        }

        return $this->redirectToRoute('app_ligne1_index', [], Response::HTTP_SEE_OTHER);
    }
}
