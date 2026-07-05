<?php declare(strict_types=1);

namespace RomanPiller\Console\Facades;

use \RomanPiller\Sudoku\Facades\SudokuFacade as SudokuPackageFacade;

/**
 * Class SudokuFacade
 *
 * @author Roman Piller
 */
final class SudokuFacade
{
    public function __construct(private SudokuPackageFacade $sudokuFacade)
    {

    }


    /**
     * Solves the Sudoku.
     *
     * @param string      $inputFileName
     * @param string      $inputDirectory
     * @param bool        $stdOut
     * @param string|null $outputFileName
     * @param string|null $outputDirectory
     * @return bool
     * @throws \RomanPiller\Sudoku\Exceptions\InvalidArgumentException
     */
    public function solve(
        string $inputFileName,
        string $inputDirectory,
        bool $stdOut = false,
        ?string $outputFileName = null,
        ?string $outputDirectory = null
    ): bool {
        return $this->sudokuFacade->solve(
            $inputFileName,
            $inputDirectory,
            $stdOut,
            $outputFileName,
            $outputDirectory
        );
    }
}
