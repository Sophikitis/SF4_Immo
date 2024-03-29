<?php
namespace App\Notification;

use App\Entity\Contact;
use Twig\Environment;

class ContactNotification{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $renderer;


    /**
     * ContactNotification constructor.
     */
    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact)
    {

        if($contact->getProperty()){
            $message = (new \Swift_Message('Agence : ' . $contact->getProperty()->getTitle()))
                ->setFrom('noreply@agence.fr')
                ->setTo('contact@agence.fr')
                ->setReplyTo($contact->getEmail())
                ->setBody($this->renderer->render('emails/contact.html.twig', [
                    'contact' => $contact
                ]), 'text/html'
                );
        }else {
            $message = (new \Swift_Message('Agence : Hello'))
                ->setFrom('noreply@agence.fr')
                ->setTo('contact@agence.fr')
                ->setReplyTo($contact->getEmail())
                ->setBody($this->renderer->render('emails/contactless.html.twig', [
                    'contact' => $contact
                ]), 'text/html'
                );
        }

            $this->mailer->send($message);
    }
}