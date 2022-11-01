<?php

namespace App\Controller;


use App\Service\UploadCsvService;
use App\Repository\PokemonRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {
    
    #[Route('/', name:"home")]
    public function home(PokemonRepository $pokemonRepository) : Response
    {
        
        // Récupération d'un tableau d'objet
        $pokemon = $pokemonRepository->findAll();

        foreach ($pokemon as $entity) {
            $resultType = $entity->getType();
            $resultGeneration = $entity->getGeneration();
            $resultNumero = $entity->getNumero();
        }


        return $this->render('base.html.twig', [
            'pokemon'=> $pokemon,
            'type' => $resultType,
            'generation' => $resultGeneration,
            'numero' => $resultNumero
        ]);
    }

    
    #[Route('/export', name:"export")]
    public function exportCsv(UploadCsvService $uploadCsvService, PokemonRepository $pokemonRepository) : Response
    {

        
        return $this->render('home/csv.html.twig', [
            'export'=> $uploadCsvService->export($pokemonRepository),
        ]);
    }
}