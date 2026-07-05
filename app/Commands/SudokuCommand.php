<?php declare(strict_types=1);

namespace RomanPiller\Console\Commands;

use RomanPiller\Console\Facades\SudokuFacade;

use Symfony\Component\Console\Command\Command;
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
     * Konstructor.
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
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure(): void
    {
        $this->setName('sudoku:solve')
            ->setDescription('Solve a Sudoku puzzle.')
            ->setHelp('This command solves a Sudoku puzzle.')
            ->addArgument('inputFileName', InputArgument::REQUIRED, 'File name of the input file.', null)
            ->addArgument('inputDirectory', InputArgument::REQUIRED, 'Directory of the input file.', null)
            ->addOption('stdOut', '-o', InputOption::VALUE_OPTIONAL, 'Output to standard output.', false)
            ->addArgument('outputFileName', InputArgument::OPTIONAL, 'File name of the output file.', null)
            ->addArgument('outputDirectory', InputArgument::OPTIONAL, 'Directory of the output file.', null)
        ;
    }

    /**
     * Solves the Sudoku puzzle.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int
     * @throws \RomanPiller\Sudoku\Exceptions\InvalidArgumentException
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inputFileName = $input->getArgument('inputFileName');
        if (!is_string($inputFileName)) {
            throw new \Symfony\Component\Console\Exception\InvalidArgumentException('Argument inputFileName must be string.');
        }

        $inputDirectory = $input->getArgument('inputDirectory');
        if (!is_string($inputDirectory)) {
            throw new \Symfony\Component\Console\Exception\InvalidArgumentException('Argument inputDirectory must be string.');
        }

        $outputFileName = $input->getArgument('outputFileName');
        if ($outputFileName !== null && !is_string($outputFileName)) {
            throw new \Symfony\Component\Console\Exception\InvalidArgumentException('Argument outputFileName must be string or null.');
        }

        $outputDirectory = $input->getArgument('outputDirectory');
        if ($outputDirectory !== null && !is_string($outputDirectory)) {
            throw new \Symfony\Component\Console\Exception\InvalidArgumentException('Argument outputDirectory must be string or null.');
        }

        $this->sudokuFacade->solve(
            $inputFileName,
            $inputDirectory,
            (bool) $input->getOption('stdOut'),
            $outputFileName,
            $outputDirectory
        );
        return Command::SUCCESS;
    }
}
