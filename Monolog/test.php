<?php
require __DIR__.'/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Formatter\JsonFormatter;
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

// the default date format is "Y-m-d\TH:i:sP"
$dateFormat = "Y-m-d\TH:i:s";

// the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
// we now change the default output format according to our needs.
$output = "[%datetime%]  %channel%.%level_name%: %message% %context% %extra%\n";

// finally, create a formatter
$formatter = new LineFormatter($output, $dateFormat);

// Create a handler
$stream = new StreamHandler(__DIR__.'/app.log', Logger::WARNING);
$stream->setFormatter($formatter);

// bind it to a logger object
$securityLogger = new Logger('security');
$securityLogger->pushHandler($stream);
$securityLogger->info('Adding a new user', ['username' => 'Seldaek', 'password' => 'hidden']);


// Multiple handlers
$logger = new Logger('mult_logger');
//Second Handler (from the top of the stack)
$logger->pushHandler(new StreamHandler(__DIR__ . '/app.log', Logger::WARNING));
//First handler (from the top of the stack)
$logger->pushHandler(new StreamHandler(__DIR__ . '/app.log', Logger::DEBUG, $bubble = true));

$logger->info('This is DEBUG severity message');
$logger->warning('This is WARNING severity message');


// JSNON
$logger = new Logger('my_logger');
$formatter = new JsonFormatter();

//Set the formatter
$handler = new StreamHandler(__DIR__ . '/app.log', Logger::DEBUG. $bubble = false);
$handler->setFormatter($formatter);

//Set the handler
$logger->pushHandler($handler);
$logger->info('Information message', ['data' => 'value']);