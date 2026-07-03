<?php declare(strict_types=1);

namespace Console\Facades;

use Console\Exceptions\InvalidArgumentException;
use Demo\Exceptions\InvalidArgumentException as PackageInvalidArgumentException;
use Demo\Facades\HelloWorldFacade;

/**
 * Demo Facade
 *
 * @author Roman Piller
 */
final class DemoFacade
{
    /**
     * Konstruktor
     *
     * @param HelloWorldFacade $helloWorldFacade
     * @return void
     */
    public function __construct(private HelloWorldFacade $helloWorldFacade)
    {
    }

    /**
     * Vyvola fasadu balika.
     *
     * @param string|null $name
     * @return string
     * @throws InvalidArgumentException
     */
    public function doSomething(?string $name): string
    {
        try {
            return $this->helloWorldFacade->doSomething($name);
        } catch (PackageInvalidArgumentException $e) {
            throw new InvalidArgumentException('Nespravne zadany argument. ' . $e->getMessage(), 0, $e);
        }
    }
}
