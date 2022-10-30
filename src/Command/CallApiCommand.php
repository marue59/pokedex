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
    description: 'Commande pour mettre à jour les pokemons ainsi que leur type, leur génération.'
)]
class CallApiCommand extends Command
{
    private $callApiService;
    private $em;

    public function __construct(CallApiService $callApiService, EntityManagerInterface $em) 
    {
        $this->api = $callApiService->getAllPokemon(); 
        $this->generation = $callApiService->getAllGeneration(); 
        $this->type = $callApiService->getType();
        $this->em = $em;
        parent::__construct();
    }
    
    protected function configure(): void
    {
        $this
            ->addOption('pokemon', null, InputOption::VALUE_NONE, "Appel a l'Api Pokedex")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $pokemon = $input->getOption('pokemon'); 

        $pokemon = $this->api["results"];
        $generation = $this->generation["results"];
        $type = $this->type["results"];
//dd($pokemon);  
//dd($type); 
//dd($generation);  
        // Boucler sur chaque pokemon 
        foreach ($pokemon as $pokemons) { 
            $pokemon = new Pokemon();
      
            $pokemon->setName($pokemons['name']);    
            $pokemon->setUrl($pokemons['url']);

            $pokemon->setGeneration($pokemons['name']);
            $pokemon->setGenerationUrl($pokemons['url']);
           
            $pokemon->setType($pokemons['name']);
                
        
            $this->em->persist($pokemon);

        }
      
        $this->em->flush();

        $output->write('La récuperation des pokemons est un succés ');
        return Command::SUCCESS;

    }

    
}
