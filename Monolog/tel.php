<?php
require __DIR__.'/vendor/autoload.php';

// telegramBotMessage(TELEGRAM_BOT_ERROR_KEY, TELEGRAM_BOT_ERROR_CHAT, 'Test message');
use Monolog\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\TelegramBotHandler;


$dateFormat = "Y-m-d\TH:i:s";
$output = "[%datetime%]  %channel%.%level_name%: %message% %context% %extra%\n";
$formatter = new LineFormatter($output, $dateFormat);

$logger = new Logger('my_logger');
$logger->pushHandler(new TelegramBotHandler(TELEGRAM_BOT_ERROR_KEY, TELEGRAM_BOT_ERROR_CHAT));
$logger->alert("This is an debug message");
$logger->error("This is an error message");
$logger->notice("This is an notice message");
$logger->debug("This is an alert message");
$logger->info('Adding a new user', ['username' => 'Seldaek', 'password' => 'hidden']);

