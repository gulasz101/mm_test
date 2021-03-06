<?php

declare(strict_types=1);

namespace App\Commands;

use App\Support\OfferInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PriceFilterCommand
 * @package App\Commands
 */
class PriceFilterCommand extends OffersFilterCommand
{
    protected float $priceFrom;

    protected float $priceTo;

    /**
     * Configures the current command.
     */
    protected function configure(): void
    {
        $this->setName('price_filter')
            ->setDescription('Count by price range.')
            ->addArgument('price_from', InputArgument::REQUIRED)
            ->addArgument('price_to', InputArgument::REQUIRED);
    }

    /**
     * Initializes the command after the input has been bound and before the input
     * is validated.
     *
     * This is mainly useful when a lot of commands extends one main command
     * where some things need to be initialized based on the input arguments and options.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @see InputInterface::validate()
     * @see InputInterface::bind()
     */
    protected function _initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->priceFrom = (float) $this->getArgumentOrFail('price_from', $input);
        $this->priceTo = (float) $this->getArgumentOrFail('price_to', $input);
    }

    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @return int 0 if everything went fine, or an exit code
     *
     * @throws \LogicException When this abstract method is not implemented
     *
     * @see setCode()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $count = $this->offers->where(
            function (OfferInterface $offer) {
                if ($offer->hasPrice() && $offer->hasQuantity() && $offer->getQuantity() > 0) {
                    return $offer->getPrice() >= $this->priceFrom
                        && $offer->getPrice() <= $this->priceTo;
                }
                return false;
            }
        )->count();

        $output->writeln("${count} offers matching price criteria.");

        return 0;
    }
}
