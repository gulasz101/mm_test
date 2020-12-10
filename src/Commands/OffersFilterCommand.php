<?php

declare(strict_types=1);

namespace App\Commands;

use App\OfferCollection;
use App\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class OffersFilterCommand
 * @package App\Commands
 */
abstract class OffersFilterCommand extends Command
{
    /**
     * @var OfferCollection
     */
    protected $offers;

    /**
     * Initializes the command after the input has been bound and before the input
     * is validated.
     *
     * This is mainly useful when a lot of commands extends one main command
     * where some things need to be initialized based on the input arguments and options.
     *
     * @see InputInterface::bind()
     * @see InputInterface::validate()
     */
    final protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->_initialize($input, $output);

        $this->offers = (new Reader())->read('https://5f973c4142706e0016956de4.mockapi.io/api/json/offers');
    }

    /**
     * Initializes the command after the input has been bound and before the input
     * is validated.
     *
     * This is mainly useful when a lot of commands extends one main command
     * where some things need to be initialized based on the input arguments and options.
     *
     * @see InputInterface::bind()
     * @see InputInterface::validate()
     */
    protected function _initialize(InputInterface $input, OutputInterface $output): void
    {
        //...
    }
}
