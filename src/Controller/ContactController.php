<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use App\Entity\Contact;
use Doctrine\Persistence\ManagerRegistry;

class ContactController extends AbstractController
{
    private $mr;

    public function __construct(ManagerRegistry $mr){
        $this -> mr = $mr;
    }

    #[Route('/contact', name: 'app_contact')]
    public function ajout_contact(Request $request): Response
    {
        $contact = new Contact();
        
        $entityManager = $this->mr->getManager();
         
        $form = $this->createForm(ContactType::class, $contact);
        $form -> handleRequest($request);

        if($form ->isSubmitted() && $form ->isValid()){

            $contact = $form ->getData();
            $entityManager -> persist($contact);

            $entityManager -> flush();
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form ->createView(),
        ]);
    }
}
