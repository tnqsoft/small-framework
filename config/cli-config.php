<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// Load bootstrap
require_once 'bootstrap.php';

return ConsoleRunner::createHelperSet($entityManager);
