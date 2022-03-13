<?php
require __DIR__.'/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('app.log', Logger::WARNING));

// add records to the log
$log->warning('Foo');
$log->error('Bar');

$logger = new Logger('my_logger');
// Now add some handlers
$logger->pushHandler(new StreamHandler('app.log', Logger::DEBUG));
$logger->pushHandler(new FirePHPHandler());

// You can now use your logger

$logger->pushProcessor(function ($record) {
    $record['extra']['dummy'] = 'Hello world!';

    return $record;
});
$logger->info('My logger is now ready');
$logger->info('Adding a new user', ['username' => 'Seldaek', 'password' => 'hidden']);