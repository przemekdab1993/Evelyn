<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:random-true',
    description: 'Add a short description for your command',
)]
class RandomTrueCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setDescription("Losowanie orzeł czy reszka")
            ->addArgument('your-name', InputArgument::OPTIONAL, 'Your name')
            ->addOption('quiz', null, InputOption::VALUE_NONE, 'Zgadnij co')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $yourName = $input->getArgument('your-name');

        if ($yourName) {
            $io->note(sprintf('Witaj: %s', $yourName));
        }

        if ($input->getOption('quiz')) {
            // ...
        }
        $result = 'true';

        $io->success('To nie żadne losowanie baranie. Odpowiedź brzmi "true"');

        return Command::SUCCESS;
    }
}
