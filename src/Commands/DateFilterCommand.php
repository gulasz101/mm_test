<?php

declare(strict_types=1);

namespace App\Commands;

use App\Offer;
use App\OfferCollection;
use App\Reader;
use Illuminate\Support\Carbon;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DateFilterCommand
 * @package App\Commands
 */
class DateFilterCommand extends Command
{
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
        /** @var OfferCollection $collection */
        $collection = (new Reader())->read('https://5f973c4142706e0016956de4.mockapi.io/api/json/offers');

        $dateStart = Carbon::make($input->getArgument('start_date'));
        $dateEnd = Carbon::make($input->getArgument('end_date'));

        if ($dateStart->greaterThan($dateEnd)) {
            throw new \InvalidArgumentException('date_start has to be lower than date_end');
        }

        $count = $collection->where(
            function (Offer $offer) use ($dateStart, $dateEnd) {
                if ($offer->hasQuantity() && $offer->getQuantity() > 0) {
                    return $offer->hasStartDate() && $offer->getStartDate()->betweenIncluded($dateStart, $dateEnd)
                        && $offer->hasEndDate() && $offer->getEndDate()->betweenIncluded($dateStart, $dateEnd);
                }

                return false;
            }
        )->count();

        $output->writeln("$count offers matching criteria.");

        return 0;
    }
}
