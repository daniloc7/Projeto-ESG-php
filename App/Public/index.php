<?php

use App\Models\IndicatorModel;

require_once __DIR__ . '/../../vendor/autoload.php';


$indicator = new IndicatorModel();
// $indicator = new Indicator(_id: new ObjectId());
// $indicator->_id = new ObjectId();
$indicator->name = 'Test cchhat';
$indicator->description = 'This is a test indicator.';



try {
    $indicatorService->createOne($indicator);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
