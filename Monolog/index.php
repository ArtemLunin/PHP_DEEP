<?php
use Monolog\Logger;
use Monolog\Handler\FirePHPHandler;
$logger = new Logger('my_logger');
$logger->pushHandler(new FirePHPHandler());
$logger->alert("This is an alert message");