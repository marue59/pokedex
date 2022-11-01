<?php

namespace App\Controller;


use App\Entity\Pokemon;
use App\Service\CallApiService;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListController extends AbstractController {

    #[Route('/list/{name}', name:"name")]
    public function personnage(PokemonRepository $pokemonRepository, string $name) : Response
    {
         // Récupération d'un tableau d'objet
        $pokemon = $pokemonRepository->findAll();
      
        foreach ($pokemon as $entity) {
            $resultName = $pokemonRepository->findBy(['name'=> $name]);
            $resultType = $entity->getType();
            $resultGeneration = $entity->getGeneration();
            $resultNumero = $entity->getNumero(); 
        }

        return $this->render('list/personnage.html.twig', [
            'pokemon'=> $pokemon,
            'name' => $name,
            'type' => $resultType,
            'generation' => $resultGeneration,
            'numero' => $resultNumero
        ]);
    }

    #[Route('/list/type/{type}', name:"type")]
    public function listType(EntityManagerInterface $em,
    string $type, PokemonRepository $pokemonRepository,
    Pokemon $pokemon) : Response
    {   
        $pokemon = $pokemonRepository->findBy(['type' => $type]);

        return $this->render('list/type.html.twig', [
            'type'=>$type,
            'pokemon'=> $pokemon,
        ]);
    }
}