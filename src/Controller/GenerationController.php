<?php

namespace App\Controller;


use App\Service\CallApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GenerationController extends AbstractController {
    
    #[Route('/generation', name:"generation")]
    public function index(CallApiService $callApiService) : Response
    {
       //dd($callApiService->getAllGeneration());
        return $this->render('generation/index.html.twig', [
            'generation'=>$callApiService->getAllGeneration(),
        ]);
    }
    
}