<?php
require_once __DIR__ . '/../vendor/autoload.php';

use GSoares\RAP\Document\Documentor;

Documentor::addClass('Sample\RestService');
echo Documentor::document();
