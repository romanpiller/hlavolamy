<?php declare(strict_types=1);

namespace Console\Commands;

use LogicException;
use Psr\Log\LogLevel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Completion\CompletionInput;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Example Command
 *
 * @package Console\Commands
 * @author Roman Piller
 */
final class ExampleCommand extends Command
{
    /**
     * Kostruktor.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Configures the current command.
     *
     * @return void
     */
    protected function configure(): void
    {
        parent::configure();
        try {
            $this->setName('demo:helloworld')
                ->setDescription('Demo balik - priklad mechanizmu konzoly a balika.')
                ->setHelp('Prikaz vypise pozdrav svetu od mena zadaneho v parametri.')
                ->addArgument(
                    'mena',
                    InputArgument::REQUIRED | InputArgument::IS_ARRAY,
                    'Zadaj meno ktore zdravi svet.',
                    null,
                    function (CompletionInput $input): array {
                        $currentValue = $input->getCompletionValue();
                        $availableNames = [
                            'Peter Meter',
                            'Pavol',
                            'Patrícia',
                            'Paula',
                            'Patrik',
                            'Petra',
                            'Pavla',
                            'Pavol',
                        ];
                        // filtrovanie s uz zadaným menom
                        return array_filter($availableNames, static function ($meno) use ($currentValue) {
                            return str_starts_with($meno, $currentValue);
                        });
                    },
                )
                ->addOption(
                    'mojOption',
                    'm',
                    InputOption::VALUE_REQUIRED,
                    'Zadaj option ako zdravi svet',
                );
        } catch (InvalidArgumentException $e) {
            echo sprintf('Error of program code: %s' . PHP_EOL, $e->getMessage());
            exit;
        }
    }

    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int 0 if everything went fine, or an exit code
     *
     * @throws LogicException When this abstract method is not implemented
     * @throws InvalidArgumentException
     *
     * @see setCode()
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $logger = new ConsoleLogger($output);
        $logger->log(LogLevel::INFO, 'Info Level');
        $logger->info('Info Level');


        $steps = 10;
        if (!$output instanceof ConsoleOutputInterface) {
            throw new LogicException('Output must be an instance of ConsoleOutputInterface');
        }

        $io = new SymfonyStyle($input, $output);
        $io->title('Moj Program');
        /*
                $output->writeln('<info>zeleny text</info>');
                $output->writeln('<comment>zlty text</comment>');
                $output->writeln('<question>cyan backgound</question>');
                $output->writeln('<error>red text</error>');
        */
        $section1 = $output->section();
        $section2 = $output->section();
        $section3 = $output->section();

        $progressBarSection = $output->section();
        $progressBar = new ProgressBar($progressBarSection, $steps);
        $progressBar->start();

        /*
        $io->note('Lorem ipsum dolor sit amet');
        $io->caution('Lorem ipsum dolor sit amet');
        $io->askHidden('What is your password?');
        $io->ask('Where are you from?', 'United States');
        $io->confirm('Restart the web server?');
        $io->choice('Select the queue to analyze', ['queue1', 'queue2', 'queue3'], 'queue1');
        $io->success('Lorem ipsum dolor sit amet');
        $io->info('Lorem ipsum dolor sit amet');
        $io->warning('Lorem ipsum dolor sit amet');
        $io->error('Lorem ipsum dolor sit amet');
        */

        if (!is_array($input->getArgument('mena'))) {
            throw new InvalidArgumentException('Parameter nie je pole.');
        }
        $section1->writeln([
            'Zaciatok prikazu',
            'Startujeme s ' . implode(',', $input->getArgument('mena')),
        ]);

        $steps = range(1, 10, 1);
        foreach ($steps as $i) {
//            $section2->overwrite((string)$i);
//            $section3->overwrite(str_repeat('=', $i + 1));
            $progressBar->advance();
            usleep(250_000);
        }
        $progressBar->finish();

        return Command::SUCCESS;
    }
}
