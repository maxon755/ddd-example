<?php

use MRF\Infrastructure\EntryPoint\Http\Kernel;

require_once dirname(__DIR__, 5) . '/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
