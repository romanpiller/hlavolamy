<?php declare(strict_types=1);

namespace RomanPiller\Console\Facades;

use RomanPiller\Sudoku\Exceptions\InvalidArgumentException;
use RomanPiller\Sudoku\Facades\SudokuFacade as SudokuPackageFacade;

/**
 * Class SudokuFacade
 *
 * @author Roman Piller
 */
final readonly class SudokuFacade
{
    public function __construct(private SudokuPackageFacade $sudokuFacade)
    {
    }

    /**
     * Solves the Sudoku.
     *
     * @param string      $puzzleFile
     * @param string      $puzzlePath
     * @param bool        $displayOutput
     * @param string|null $solutionFile
     * @param string|null $solutionPath
     * @return bool
     * @throws InvalidArgumentException
     */
    public function solve(
        string $puzzleFile,
        string $puzzlePath,
        bool $displayOutput = false,
        ?string $solutionFile = null,
        ?string $solutionPath = null
    ): bool {
        return $this->sudokuFacade->solve(
            $puzzleFile,
            $puzzlePath,
            $displayOutput,
            $solutionFile,
            $solutionPath
        );
    }
}
