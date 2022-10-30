<?php

namespace App\Controller;


use App\Service\CallApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {
    
    #[Route('/', name:"home")]
    public function home(CallApiService $callApiService) : Response
    {
        return $this->render('base.html.twig', [
            'data'=> $callApiService->getAllPokemon(), 
            'generation'=>$callApiService->getAllGeneration(),
            'type'=>$callApiService->getType(),
        ]);
    }
}