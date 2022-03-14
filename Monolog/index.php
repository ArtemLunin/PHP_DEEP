<?php
require __DIR__.'/vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\FirePHPHandler;

$logger = new Logger('my_logger');

$logger->pushProcessor(function ($record) {
    $record['extra']['dummy'] = 'Hello world!';

    return $record;
});

$logger->pushHandler(new FirePHPHandler());
$logger->alert("This is an alert message");
// $logger->debug("Notice");
// $logger->info('Adding a new user', ['username' => 'Seldaek', 'password' => 'hidden']);
// $logger->warning('Warning');

echo "123";