<?php

namespace App\Command;

use App\Entity\Pokemon;
use App\Service\CallApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'callApi',
    description: 'call Api',
)]
class CallApiCommand extends Command
{
    private $callApiService;
    private $em;

    public function __construct(CallApiService $callApiService, EntityManagerInterface $em) 
    {
        $this->callApiService = $callApiService;
        $this->em = $em;
        parent::__construct();
    }
    
    protected function configure(): void
    {
       
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $pokemons = $this->callApiService->getAllPokemon();
        
        // Boucler sur chaque pokemon 
        foreach ($pokemons["results"] as $pokemon) { 
            $entity = new Pokemon();
            
            $data = $this->callApiService->getPokemonData($pokemon['name']);
            
            $entity->setNumero($data['id']);
            $entity->setName($pokemon['name']);      
            $entity->setUrl($pokemon['url']);
            $entity->setType($data['types'][0]['type']['name']);

          
           
                //$dataGeneration = $this->callApiService->getAllGeneration(["name"]);
                //$dataGenerationUrl = $this->callApiService->getAllGeneration(['url']);
           /*
           if(empty ($data['past_types'])) {
                $entity->setGeneration('past_types');
                $entity->setGenerationUrl('past_types_url'); 
               
           }else {
                $entity->setGeneration($data['past_types'][0]['generation']['name']);
                $entity->setGenerationUrl($data['past_types'][0]['generation']['url']);
           }
            */ 
            
             $this->em->persist($entity);
      
        }
      
        $this->em->flush();

        $output->write('La récuperation des pokemons est un succés ');
        return Command::SUCCESS;

    }

    
}
