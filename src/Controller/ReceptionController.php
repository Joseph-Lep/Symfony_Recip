<?php

namespace App\Controller;

use App\Entity\Recip;
use App\Repository\RecipingredientRepository;
use App\Repository\RecipRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReceptionController extends AbstractController
{
    #[Route('/', name: 'app_reception')]
    // Une route suivie d'une fonction caractérise un controller
    public function index(RecipRepository $recipRepository): Response
    {
        $allrecip = $recipRepository->findAll();
        return $this->render('reception/index.html.twig', [
            'allrecips' => $allrecip,
        ]);
    }
    #[Route('/{id}', name: 'app_onerecip')]
    public function recip(Recip $recips): Response
    {
        return $this->render('reception/recip.html.twig', [
            'recip' => $recips,
        ]);
    }
}