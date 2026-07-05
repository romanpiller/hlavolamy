<?php declare(strict_types=1);

namespace RomanPiller\Console\Commands;

use RomanPiller\Console\Facades\SudokuFacade;

use RomanPiller\Sudoku\Exceptions\InvalidArgumentException as SudokuInvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException as ConsoleInvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for solving Sudoku puzzles.
 *
 * @author Roman Piller
 */
final class SudokuCommand extends Command
{
    /**
     * Constructor.
     *
     * @param SudokuFacade $sudokuFacade
     * @return void
     */
    public function __construct(private readonly SudokuFacade $sudokuFacade)
    {
        parent::__construct();
    }

    /**
     * Configures the command.
     *
     * @return void
     * @throws ConsoleInvalidArgumentException
     */
    protected function configure(): void
    {
        $this->setName('sudoku:solve')
            ->setDescription('Solve a Sudoku puzzle.')
            ->setHelp('This command solves a Sudoku puzzle.')
            ->addArgument('puzzleFile', InputArgument::REQUIRED, 'File name of the puzzle file.', null)
            ->addArgument('puzzlePath', InputArgument::REQUIRED, 'Directory path of the puzzle file.', null)
            ->addOption('displayOutput', '-o', InputOption::VALUE_OPTIONAL, 'Output to standard output.', false)
            ->addArgument('solutionFile', InputArgument::OPTIONAL, 'File name of the solution file.', null)
            ->addArgument('solutionPath', InputArgument::OPTIONAL, 'Directory path of the solution file.', null)
        ;
    }

    /**
     * Solves the Sudoku puzzle.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int
     * @throws SudokuInvalidArgumentException
     * @throws ConsoleInvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $puzzleFile = $input->getArgument('puzzleFile');
        if (!is_string($puzzleFile)) {
            throw new ConsoleInvalidArgumentException('Argument puzzleFile must be string.');
        }

        $puzzlePath = $input->getArgument('puzzlePath');
        if (!is_string($puzzlePath)) {
            throw new ConsoleInvalidArgumentException('Argument puzzlePath must be string.');
        }

        $solutionFile = $input->getArgument('solutionFile');
        if ($solutionFile !== null && !is_string($solutionFile)) {
            throw new ConsoleInvalidArgumentException('Argument solutionFile must be string or null.');
        }

        $solutionPath = $input->getArgument('solutionPath');
        if ($solutionPath !== null && !is_string($solutionPath)) {
            throw new ConsoleInvalidArgumentException('Argument solutionPath must be string or null.');
        }

        $this->sudokuFacade->solve(
            $puzzleFile,
            $puzzlePath,
            (bool) $input->getOption('displayOutput'),
            $solutionFile,
            $solutionPath
        );
        return Command::SUCCESS;
    }
}
