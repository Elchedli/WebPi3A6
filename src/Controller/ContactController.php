<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contactus", name="contact_index")
     * @param Request $request
     *
     */
    public function index(Request $request,\Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $message = (new \Swift_Message('Hello !'))
                ->setFrom('send@gmail.com')
                ->setTo('spirity.esprit@gmail.com')
                ->setBody(
                    $this->renderView(
                        'Front/emails/contact.html.twig', compact('contact')
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);

            $this->addFlash('info', 'Votre message a été bien transmis, nous vous répondrons dans les meilleurs délais.');
        }
        return $this->render('Front/contact/index.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }
}
