<?php

namespace EllipseSynergie\LocaleToCsv\Tests\Commands;

use EllipseSynergie\LocaleToCsv\Commands\ImportCommand;
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
    public function testExportSucceed()
    {
        $application = new Application();
        $application->add(new ImportCommand());

        $command = $application->find('lang:import-from-csv');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'in' => 'tests/locale.csv',
            'out' => 'tests/locale.php',
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('Not yet implemented.', $output);
    }
}
