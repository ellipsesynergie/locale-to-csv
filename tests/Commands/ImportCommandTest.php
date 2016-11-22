<?php

namespace EllipseSynergie\LocaleToYaml\Tests\Commands;

use EllipseSynergie\LocaleToYaml\Commands\ImportCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Application;

/**
 * Class ImportCommandTest
 *
 * @package EllipseSynergie\ApiResponse\Tests
 * @author Dominic Martineau <dominic.martineau@ellipse-synergie.com>
 */
class ImportCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testImportSucceed()
    {
        $application = new Application();
        $application->add(new ImportCommand());

        $command = $application->find('lang:import-from-yaml');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'in' => 'tests/import.yml',
            'out' => 'tests/import.php',
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('Importing tests/import.yml to tests/import.php', $output);

        // validate content
        $content = "<?php\n\n" .
            "return array (\n" .
            "  'foo' => 'bar',\n" .
            "  'hello' => \n" .
            "  array (\n" .
            "    'world' => 'Hello world!',\n" .
            "    'number' => 666,\n" .
            "    'three' => \n" .
            "    array (\n" .
            "      'four' => 'five',\n" .
            "    ),\n" .
            "    'multi' => 'This is a\n" .
            "multi line\n" .
            "sentence.\n" .
            "',\n" .
            "  ),\n" .
            ");";
        $this->assertSame($content, file_get_contents('tests/import.php'));

        // remove outputed file
        unlink('tests/import.php');
    }

    /**
     * @expectedException \Symfony\Component\Console\Exception\RuntimeException
     */
    public function testImportWithWrongArguments()
    {
        $application = new Application();
        $application->add(new ImportCommand());

        $command = $application->find('lang:import-from-yaml');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
        ));
    }

    /**
     * @expectedException \EllipseSynergie\LocaleToYaml\Exceptions\FileNotFoundException
     */
    public function testImportWithInvalidFilename()
    {
        $application = new Application();
        $application->add(new ImportCommand());

        $command = $application->find('lang:import-from-yaml');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'in' => 'tests/foo.yml',
            'out' => 'tests/foo.php'
        ));
    }
}
