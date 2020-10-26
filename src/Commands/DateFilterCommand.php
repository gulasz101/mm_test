<?php

declare(strict_types=1);

namespace App\Commands;

use App\Offer;
use Illuminate\Support\Carbon;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DateFilterCommand
 * @package App\Commands
 */
class DateFilterCommand extends OffersFilterCommand
{
    /**
     * @var Carbon
     */
    protected $dateStart;

    /**
     * @var Carbon
     */
    protected $dateEnd;
    
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('date_filter')
            ->setDescription('Count by date range.')
            ->addArgument('start_date', InputArgument::REQUIRED, 'Pass the start date.')
            ->addArgument('end_date', InputArgument::REQUIRED, 'Pass the end date.');
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
    protected function _initialize(InputInterface $input, OutputInterface $output)
    {
        $this->dateStart = Carbon::make($input->getArgument('start_date'));
        $this->dateEnd = Carbon::make($input->getArgument('end_date'));

        if ($this->dateStart->greaterThan($this->dateEnd)) {
            throw new \InvalidArgumentException('date_start has to be lower than date_end');
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
     * @return int 0 if everything went fine, or an exit code
     *
     * @throws LogicException When this abstract method is not implemented
     *
     * @see setCode()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $count = $this->offers->where(
            function (Offer $offer) {
                if ($offer->hasQuantity() && $offer->getQuantity() > 0) {
                    return $offer->hasStartDate() && $offer->getStartDate()->betweenIncluded($this->dateStart, $this->dateEnd)
                        && $offer->hasEndDate() && $offer->getEndDate()->betweenIncluded($this->dateStart, $this->dateEnd);
                }

                return false;
            }
        )->count();

        $output->writeln("$count offers matching criteria.");

        return 0;
    }
}
