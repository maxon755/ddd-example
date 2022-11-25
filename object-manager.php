<?php

use Symfony\Component\Dotenv\Dotenv;
use MRF\Infrastructure\EntryPoint\Http\Kernel;

require __DIR__ . '/vendor/autoload.php';

(new Dotenv())->bootEnv(__DIR__ . '/.env');

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$kernel->boot();

/** @var Doctrine\Bundle\DoctrineBundle\Registry $doctrine */
$doctrine = $kernel->getContainer()->get('doctrine');

return $doctrine->getManager();
