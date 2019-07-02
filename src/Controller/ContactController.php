<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Notification\ContactNotification;



class ContactController extends  AbstractController {


    /**
     * @Route("/contact", name="contact.index")
     * @param Request $request
     * @param ContactNotification $notification
     * @return Response
     */
    public function index(Request $request, ContactNotification $notification): Response
    {
        $contact = new Contact();
        $contact->setProperty(null);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);



        if($form->isSubmitted() && $form->isValid()){
            $notification->notify($contact);
            $this->addFlash('success', 'votre email a bien été envoyé');
            return $this->redirectToRoute('home');

        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
}