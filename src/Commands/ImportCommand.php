<?php

namespace EllipseSynergie\LocaleToYaml\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class ImportCommand
 * @package EllipseSynergie\LocaleToYaml\Commands
 */
class ImportCommand extends Command
{
    /**
     */
    protected function configure()
    {
        $this->setName('lang:import-from-csv')
            ->setDescription('Import locale file to PHP.')
            ->setHelp("This command allows you to import a lang file from comma-separated values to PHP...")
            ->addArgument('in', InputArgument::REQUIRED, 'The input filename.')
            ->addArgument('out', InputArgument::REQUIRED, 'The output filename.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Not yet implemented.');
    }
}