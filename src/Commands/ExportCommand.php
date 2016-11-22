<?php

namespace EllipseSynergie\LocaleToYaml\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ExportCommand
 * @package EllipseSynergie\LocaleToYaml\Commands
 */
class ExportCommand extends Command
{
    /**
     */
    protected function configure()
    {
        $this->setName('lang:export-to-yaml')
            ->setDescription('Export locale file to Yaml.')
            ->setHelp("This command allows you to export a locale file from PHP to Yaml...")
            ->addArgument('in', InputArgument::REQUIRED, 'The input filename.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $in = $input->getArgument('in');
        $out = str_replace('.php', '.yaml', $in);

        $output->writeln('Exporting ' . $in . ' to ' . $out);

        $strings = include($in);
        $yaml = Yaml::dump($strings);
        file_put_contents($out, $yaml);
    }
}
