<?php declare(strict_types=1);

namespace RomanPiller\Console;

use RomanPiller\Console\Commands\SudokuCommand;
use Symfony\Component\Console\Application as ConsoleApplication;

/**
 * Class Application
 *
 * @package App
 * @author  Roman Piller
 */
final class Application extends ConsoleApplication
{
    public function __construct(SudokuCommand $sudokuCommand)
    {
        parent::__construct();
        $this->addCommand($sudokuCommand);
    }
}
