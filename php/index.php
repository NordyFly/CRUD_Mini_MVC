<?php

require('vendor/autoload.php');

use Nordy\Php\Kernel\Dispatcher;
use Nordy\Php\Entity\User;

$dispatcher = new Dispatcher();
$dispatcher->dispatch();
