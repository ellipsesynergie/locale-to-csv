<?php

namespace EllipseSynergie\LocaleToYaml\Tests\Commands;

use EllipseSynergie\LocaleToYaml\Commands\ExportCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Application;

/**
 * Class ExportCommandTest
 *
 * @package EllipseSynergie\ApiResponse\Tests
 * @author Dominic Martineau <dominic.martineau@ellipse-synergie.com>
 */
class ExportCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExportSucceed()
    {
        $application = new Application();
        $application->add(new ExportCommand());

        $command = $application->find('lang:export-to-yaml');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'in' => 'tests/export.php'
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('Exporting tests/export.php to tests/export.yml', $output);

        // validate content
        $content = "foo: bar\n" .
            "hello:\n" .
            "    world: 'Hello world!'\n" .
            "    number: 666\n" .
            "    three:\n" .
            "        four: five\n" .
            "    multi: |\n" .
            "        This is a\n" .
            "        multi line\n" .
            "        sentence.\n";
        $this->assertSame($content, file_get_contents('tests/export.yml'));

        // remove outputed file
        @unlink('tests/export.yml');
    }

    /**
     * @expectedException \Symfony\Component\Console\Exception\RuntimeException
     */
    public function testExportWithWrongArguments()
    {
        $application = new Application();
        $application->add(new ExportCommand());

        $command = $application->find('lang:export-to-yaml');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
        ));
    }

    /**
     * @expectedException \EllipseSynergie\LocaleToYaml\Exceptions\FileNotFoundException
     */
    public function testExportWithInvalidFilename()
    {
        $application = new Application();
        $application->add(new ExportCommand());

        $command = $application->find('lang:export-to-yaml');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'in' => 'tests/foo.php'
        ));
    }
}
