<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService {

private $client;

    // Injection de la dépendance dans le construct
    public function __construct(HttpClientInterface $client) 
    {
        $this->client = $client;
    }
    
    // Récuperer le detail d'un pokemon par nom
    public function getPokemonData($name): array
    {
        return $this->getApi('pokemon' .$name);
    }

    // Récuperer tous les pokemons
    public function getAllPokemon(): array
    {
        return $this->getApi('pokemon');
    }

    // Récuperer par type
    public function getType(): array
    {
        return $this->getApi('type');
    }

    // Récuperer toutes les générations
    public function getAllGeneration(): array
    {
        return $this->getApi('generation');
    }

    
    // Utilisable que dans le service
    // Cabler l'api
    private function getApi(string $var)
    {
        // création d'une variable pour stocker la réponse de l'Api
        // utilisation de client pour faire une réquete GET sur le endpoint
        $response = $this->client->request(
            'GET',
            'https://pokeapi.co/api/v2/' . $var
        );

        return $response->toArray();
    }
}
?>