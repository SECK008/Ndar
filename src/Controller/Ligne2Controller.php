<?php

namespace App\Controller;

use App\Entity\Ligne2;
use App\Form\Ligne2Type;
use App\Repository\Ligne2Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ligne2')]
class Ligne2Controller extends AbstractController
{
    #[Route('/', name: 'app_ligne2_index', methods: ['GET'])]
    public function index(Ligne2Repository $ligne2Repository): Response
    {
        return $this->render('ligne2/index.html.twig', [
            'ligne2s' => $ligne2Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ligne2_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Ligne2Repository $ligne2Repository): Response
    {
        $ligne2 = new Ligne2();
        $form = $this->createForm(Ligne2Type::class, $ligne2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligne2Repository->save($ligne2, true);

            return $this->redirectToRoute('app_ligne2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne2/new.html.twig', [
            'ligne2' => $ligne2,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne2_show', methods: ['GET'])]
    public function show(Ligne2 $ligne2): Response
    {
        return $this->render('ligne2/show.html.twig', [
            'ligne2' => $ligne2,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ligne2_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ligne2 $ligne2, Ligne2Repository $ligne2Repository): Response
    {
        $form = $this->createForm(Ligne2Type::class, $ligne2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligne2Repository->save($ligne2, true);

            return $this->redirectToRoute('app_ligne2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne2/edit.html.twig', [
            'ligne2' => $ligne2,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne2_delete', methods: ['POST'])]
    public function delete(Request $request, Ligne2 $ligne2, Ligne2Repository $ligne2Repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ligne2->getId(), $request->request->get('_token'))) {
            $ligne2Repository->remove($ligne2, true);
        }

        return $this->redirectToRoute('app_ligne2_index', [], Response::HTTP_SEE_OTHER);
    }
}
