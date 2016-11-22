<?php

namespace EllipseSynergie\LocaleToYaml\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Yaml\Yaml;
use EllipseSynergie\LocaleToYaml\Exceptions\FileNotFoundException;
use EllipseSynergie\LocaleToYaml\Exceptions\YamlException;
use Symfony\Component\Yaml\Exception\ParseException;

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
        $this->setName('lang:import-from-yaml')
            ->setDescription('Import locale file to PHP.')
            ->setHelp("This command allows you to import a lang file from comma-separated values to PHP...")
            ->addArgument('in', InputArgument::REQUIRED, 'The locale input filename.')
            ->addArgument('out', InputArgument::REQUIRED, 'The locale output filename.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Which file need to be converted back?
        $in = $input->getArgument('in');
        // To...
        $out = $input->getArgument('out');

        $output->writeln('Importing ' . $in . ' to ' . $out);

        if (!file_exists($in)) {
            throw new FileNotFoundException("Cannot find file " . $in);
        }

        try {

            // Get content from input file
            $strings = Yaml::parse(file_get_contents($in));
            // Output it to PHP file...
            file_put_contents($out, "<?php\n\nreturn " . var_export($strings, true) . ";");

        } catch (ParseException $e) {

            throw new YamlException("Not able to convert input file to Yaml.");
        }
    }
}