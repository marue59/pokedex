<?php

namespace App\Controller;


use App\Service\CallApiService;
use App\Repository\PokemonRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListController extends AbstractController {

    #[Route('/list/{name}', name:"name")]
    public function personnage(string $name, CallApiService $callApiService) : Response
    {
        return $this->render('list/personnage.html.twig', [
            'nom'=> $callApiService->getPokemonData($name)
        ]);
    }

    #[Route('/list/type/{name}', name:"type")]
    public function listType(CallApiService $callApiService) : Response
    {
        return $this->render('list/type.html.twig', [
            'name'=>$callApiService->getType(),
        ]);
    }
}