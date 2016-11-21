<?php

namespace EllipseSynergie\LocaleToCsv\Tests\Commands;

use EllipseSynergie\LocaleToCsv\Commands\ExportCommand;
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

        $command = $application->find('lang:export-to-csv');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'in' => 'tests/locale.php',
            'out' => 'tests/locale.csv',
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('Exporting tests/locale.php to tests/locale.csv', $output);
        $this->assertSame("foo;bar\n", file_get_contents('tests/locale.csv'));

        @unlink('tests/locale.csv');
    }
}
