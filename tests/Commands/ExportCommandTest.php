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
            'in' => 'tests/locale.php'
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('Exporting tests/locale.php to tests/locale.yaml', $output);

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
        $this->assertSame($content, file_get_contents('tests/locale.yaml'));

        // remove outputed file
        @unlink('tests/locale.yaml');
    }
}
