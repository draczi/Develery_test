<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactType;
use App\Entity\Contact;

class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact")
     */
    public function createNewMessage(Request $request)
    {
        $newCsontact = new Contact();
        $contact = $this->createForm(ContactType::class, $newContact);

        $contact->handleRequest($request);

        if($contact->isSubmitted()) {
            if($contact->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($newContact);
                $em->flush();
                $this->addFlash('success', "Köszönjük szépen a kérdésedet. Válaszunkkal hamarosan keresünk a megadott e-mail címen.");
                return $this->redirect($this->generateUrl('contact'));
            } else {
                $this->addFlash('error', 'Hiba! Kérjük töltsd ki az összes mezőt!');
                return $this->redirect($this->generateUrl('contact'));
            }
        }

        return $this->render('contact/index.html.twig', [
            'contact' => $contact->createView()
        ]);
    }
}
