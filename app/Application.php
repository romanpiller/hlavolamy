<?php declare(strict_types=1);

namespace Console;

use Console\Commands\DemoCommand;
use Symfony\Component\Console\Application as ConsoleApplication;

/**
 * Class Application
 *
 * @package App
 * @author  Roman Piller
 */
final class Application extends ConsoleApplication
{
    /**
     * Konstruktor registruje command
     *
     * @param DemoCommand $helloWorldCommand
     */
    public function __construct(private readonly DemoCommand $helloWorldCommand)
    {
        parent::__construct();
        $this->addCommand($this->helloWorldCommand);
    }
}
