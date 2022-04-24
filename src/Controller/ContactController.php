<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\EmailModel;
use App\Entity\User;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use App\Services\EmailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact")
 */
class ContactController extends AbstractController
{
  

    /**
     * @Route("/new", name="contact_new", methods={"GET","POST"})
     */
    public function new(Request $request, EmailService $emailService): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('contact_success', 'Votre message a bien été envoyer.');
            $contact = new Contact();
            $form = $this->createForm(ContactType::class, $contact);
            // envoi d'email
            $user = (new User)
                ->setEmail('sebastien.jacquot97@gmail.com')
                ->setLastname('kguk')
                ->setFirstname('ljbkhvg')
                ;
                // dd($user);
            $email = (new EmailModel)
                ->setTitle('bonjour Mr'.$user->getFullName().' un nouveau messa du sur le sit mYboutique')
                ->setSubject('sujet: '.$contact->getSubject())
                ->setMessage('df'.$contact->getMessage());


                $emailService->sendEmailByMailJet($user, $email);
        }
        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('contact_erreur', 'Votre message n\'a pas été envoyer.');
            
        }

        return $this->renderForm('contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }

    
}
