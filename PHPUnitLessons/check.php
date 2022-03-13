<?php
require_once 'vendor/autoload.php';

$user = new \App\User\User('petr');

echo $user->getName();