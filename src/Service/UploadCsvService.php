<?php

namespace App\Service;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UploadCsvService {

    public function export(PokemonRepository $pokemonRepository): Response
        {

            // Récuperer les datas
            $pokemons = $pokemonRepository->findAll();
          
            $response = new StreamedResponse();
            
            //Nom des colonnes en première lignes
            // le \n à la fin permets de faire un saut de ligne, super important en CSV
            // le point virgule sépare les données en colonnes
            
            $handle = fopen('php://output', 'r');
            // Nom des colonnes du CSV 
            fputcsv($handle,[
                'Id',
                'Nom',
                'Type','\n'
            ,';']);


            //Pour les champs
            foreach ($pokemons as $pokemon)
            {
                fputcsv($handle,array(
                    $pokemon->getId('id'),
                    $pokemon->getName('name'),
                    $pokemon->getType('type')
                ),';');
            
            }

            fclose($handle); 

            //Code HTTP à 200
            //Définit le contenu de la requête en tant que fichier csv
            //On indique que le fichier sera en attachment donc ouverture de boite de téléchargement ainsi que le nom du fichier
    
            $response->setStatusCode(200);
            $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
            $response->headers->set('Content-Disposition','attachment; filename="export.csv"');
            
            return $response; 

        }
}