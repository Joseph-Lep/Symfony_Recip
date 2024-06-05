<?php

namespace App\Controller;

use App\Entity\Recip;
use App\Form\AddRecipType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddRecipController extends AbstractController
{
    #[Route('/add/recip', name: 'app_add_recip')]
    public function add_recip(Request $request, EntityManagerInterface $em): Response
    {
        $add_recip = new Recip();
        $form = $this->createForm(AddRecipType::class, $add_recip);
        // * $this correspond à une instance de AddRecipController
        $form->handleRequest($request);
        // £ J'appelle la méthode handerequest ($request attrappe les données _POST) pour gèrer $form 
        if ($form->isSubmitted()) {
            $em->persist($add_recip);
            $em->flush();
            return $this->redirectToRoute('submitok');
        }
        return $this->render('add_recip/add_recip.html.twig', [
            'addarticle' => $form
            // Le formulaire est envoyé vers la vue correspondante / Ou 'addarticle' permet à la vue de récuperer les données de $form (qui est un objet qui contient tte les infos pour faire le formulaire)
        ]);
    }
    #[Route('/add/recip/ok', name: 'submitok')]
    public function ok(Request $request, EntityManagerInterface $em): Response
    {
        return $this->render('add_recip/submitok.html.twig', [
        ]);
    }
}