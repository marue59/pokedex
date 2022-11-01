<?php

namespace App\Command;

use App\Service\UploadCsvService;
use App\Repository\PokemonRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'callCsv',
    description: 'For download csv',
)]
class CallCsvCommand extends Command
{
    private $uploadCsvService;
    private PokemonRepository $pokemonRepository;

    public function __construct(UploadCsvService $uploadCsvService, PokemonRepository $pokemonRepository) 
   
    { 
        $this->uploadCsvService = $uploadCsvService;
        $this->pokemonRepository = $pokemonRepository;
        parent::__construct(); 
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //$this->uploadCsvService->export($pokemonRepository);
     
        return Command::SUCCESS;
    }
}
