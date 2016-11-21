<?php

namespace EllipseSynergie\LocaleToCsv\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Arr;

/**
 * Class ExportCommand
 * @package EllipseSynergie\LocaleToCsv\Commands
 */
class ExportCommand extends Command
{
    /**
     */
    protected function configure()
    {
        $this->setName('lang:export-to-csv')
            ->setDescription('Export locale file to CSV.')
            ->setHelp("This command allows you to export a lang file to comma-separated values...")
            ->addArgument('in', InputArgument::REQUIRED, 'The input filename.')
            ->addArgument('out', InputArgument::REQUIRED, 'The output filename.')
            ->addArgument('delimiter', InputArgument::OPTIONAL, 'The CSV delimiter (default is ;)', ';')
            ->addArgument('enclosure', InputArgument::OPTIONAL, 'The CSV enclosure (default is ")', '"');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $in = $input->getArgument('in');
        $out = $input->getArgument('out');
        $delimiter = $input->getArgument('delimiter');
        $enclosure = $input->getArgument('enclosure');

        $output->writeln('Exporting ' . $in . ' to ' . $out);

        $outputFile = fopen($out, 'w');
        $strings = Arr::dot(include($in));

        foreach ($strings as $key => $string) {
            fputcsv($outputFile, [$key, $string], $delimiter, $enclosure);
        }

        fclose($outputFile);
    }
}
