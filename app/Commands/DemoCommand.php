<?php declare(strict_types=1);

namespace Console\Commands;

use Console\Exceptions\InvalidArgumentException;
use Console\Facades\DemoFacade;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException as SymfonyInvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Demo Command
 *
 * @package Console\Commands
 * @author  Roman Piller
 */
final class DemoCommand extends Command
{
    /**
     * Kostruktor.
     *
     * @param DemoFacade $demoFacade
     * @return void
     */
    public function __construct(private DemoFacade $demoFacade)
    {
        parent::__construct();
    }

    /**
     * Configures the current command.
     *
     * @return void
     * @throws SymfonyInvalidArgumentException
     */
    protected function configure(): void
    {
        parent::configure();
        try {
            $this->setName('demo:helloworld')
                ->setDescription('Demo balik - priklad mechanizmu konzoly a balika.')
                ->setHelp('Prikaz vypise pozdrav svetu od mena zadaneho v parametri.')
                ->addArgument(
                    'meno',
                    InputArgument::OPTIONAL,
                    'Zadaj meno ktore zdravi svet.',
                    null,
                );
        } catch (InvalidArgumentException $e) {
            echo sprintf('Error of program code: %s' . PHP_EOL, $e->getMessage());
            exit;
        }
    }

    /**
     * Executes the current command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws SymfonyInvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $logger = new ConsoleLogger($output);
        $logger->notice('Command Demo spusteny.');    // vypisuje sa pri -v
        $logger->info('Info -vv');                         // vypisuje sa pri -vv
        $logger->debug('Debug -vvv');                       // vypisuje sa pri -vvv

        $name = $input->getArgument('meno');

        if (!is_string($name) && !is_null($name)) {
            throw new SymfonyInvalidArgumentException('Argument "meno" must be string or null.');
        }

        try {
            $message = $this->demoFacade->doSomething($name);
        } catch (InvalidArgumentException $e) {
            $logger->error($e->getMessage());
            $logger->notice('Command Deno skoncil chybou.');
            return Command::FAILURE;
        }

        echo $message . PHP_EOL;

        $logger->notice('Command Demo uspesne skoncil.');    // vypisuje sa pri -v
        return Command::SUCCESS;
    }
}
