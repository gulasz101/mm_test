<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Commands\DateFilterCommand;
use App\Commands\PriceFilterCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

$app = new Application();

$app->add(new DateFilterCommand());
$app->add(new PriceFilterCommand());

$app->run(
    new ArgvInput(),
    new ConsoleOutput()
);
