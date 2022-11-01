<?php

namespace App\Controller;


use App\Service\CallApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GenerationController extends AbstractController {
    
    //function permettant de chercher les générations de pokemon dans l'api.
    #[Route('/generation', name:"generation")]
    public function index(CallApiService $callApiService) : Response
    {
        return $this->render('generation/index.html.twig', [
            'generation'=>$callApiService->getAllGeneration(),
        ]);
    }
    
}