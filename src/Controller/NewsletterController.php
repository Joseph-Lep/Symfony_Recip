<?php

namespace App\Controller;

use App\Entity\Email;
use App\Form\NewsletterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter/subscribe', name: 'app_newsletter_sub')]
    public function subscribe(Request $request, EntityManagerInterface $em): Response
    // £ Je typehint Request (J'ai besoin de la requete entrante) puis j'injecte dans subscribe un EntityManager qui me permet de presist ma donnée pour pouvoir la push dans la bdd
    {
        $newsletterEmail = new Email();
        // Je veux que tu crée une nvl objet de Email
        $form = $this->createForm(NewsletterType::class, $newsletterEmail);
        // Je veux que tu crée un form de type NewsletterType qui attends un objet Email
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($newsletterEmail);
            $em->flush();
            // Enregistrement (persistance de la variable Request) de l'email si c'est soumis et validé
            // Les données POST sont dans Request (qui s'en charge)
            return $this->redirectToRoute('app_newsletter_thx');
            // redirige vers la page twig thx si le if est réussi
        }

        return $this->render('newsletter/subscribe.html.twig', [
            'newsletterform' => $form,
        ]);
    }
    #[Route('/newsletter/thanks', name: 'app_newsletter_thx')]
    public function thanks(Request $request, EntityManagerInterface $em): Response
    {
        return $this->render('newsletter/thanks.html.twig', [
        ]);
    }
}