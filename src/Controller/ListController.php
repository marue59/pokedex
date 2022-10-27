<?php

namespace App\Controller;


use App\Service\CallApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListController extends AbstractController {
    
    #[Route('/list', name:"list")]
    public function list(CallApiService $callApiService) : Response
    {
       //dd($callApiService->getType());
        return $this->render('list/index.html.twig', [
            'data'=> $callApiService->getAllPokemon(),
            //'generation'=>$callApiService->getAllGeneration(),
            'type'=>$callApiService->getType(),
        ]);
    }


    // a finir 
    #[Route('/list/type', name:"list-type")]
    public function listType(CallApiService $callApiService) : Response
    {
       //dd($callApiService->getType());
        return $this->render('list/index.html.twig', [
            'data'=> $callApiService->getAllPokemon(),
            //'generation'=>$callApiService->getAllGeneration(),
            'type'=>$callApiService->getType(),
        ]);
    }
}