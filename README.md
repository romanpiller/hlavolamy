# Puzzle Console Application

A CLI console application built on Symfony/Console with a DI container.

## Features
- **Static Analysis**: PHPStan
- **Unit Testing**: Nette Tester
- **Coding Standards**: PHP CodeSniffer

## Usage

The application provides commands to solve various puzzles.

### Sudoku Solver

To solve a Sudoku puzzle, use the `sudoku:solve` command.

Example usage:
```bash
/bin/console sudoku:solve sudoku.txt temp/ -o true sudoku.html temp/
```

**Parameters:**
- `puzzleFile`: Name of the file containing the Sudoku puzzle (e.g., `sudoku.txt`).
- `puzzlePath`: Directory path where the puzzle file is located (e.g., `temp/`).
- `--displayOutput` or `-o true`: (Optional) Output the result to standard output.
- `solutionFile`: (Optional) Name of the HTML file to save the solution.
- `solutionPath`: (Optional) Directory path where the solution file will be saved.
