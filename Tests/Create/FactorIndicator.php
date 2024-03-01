<?php

use App\Controllers\DatabaseController;
use App\Models\IndicatorModel;
use MongoDB\Client;

$mongoDbClient = new Client('mongodb://127.0.0.1:27017');
$database = new DatabaseController($mongoDbClient);

//criar indicator
$indicatorController = new IndicatorController($database);
$indicatorModel = new IndicatorModel();
$indicatorForm = new CreateIndicatorForm($indicatorModel);
$indicatorForm->withName('Nome')->withDescription('Descricao');

$indicatorController->addIndicator($indicatorForm);

//criar factor
$factorController = new FactorController($database);

//criar factorIndicator