<?php

namespace EllipseSynergie\LocaleToYaml\Commands;

use EllipseSynergie\LocaleToYaml\Exceptions\YamlException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Yaml\Yaml;
use EllipseSynergie\LocaleToYaml\Exceptions\FileNotFoundException;
use Symfony\Component\Yaml\Exception\DumpException;

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
            ->addArgument('in', InputArgument::REQUIRED, 'The locale input filename.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Which file need to be converted?
        $in = $input->getArgument('in');
        // Define output file from input one...
        $out = str_replace('.php', '.yml', $in);

        $output->writeln('Exporting ' . $in . ' to ' . $out);

        if (!file_exists($in)) {
            throw new FileNotFoundException("Cannot find file " . $in);
        }

        try {

            // Get content from input file
            $strings = include($in);
            // Output it to Yaml file...
            file_put_contents($out, Yaml::dump($strings, 100, 4, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK));

        } catch (DumpException $e) {

            throw new YamlException("Not able to convert input file to Yaml.");
        }
    }
}
