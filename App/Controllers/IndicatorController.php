<?php

use App\Interfaces\DatabaseInterface;

class IndicatorController
{

    public function __construct(protected DatabaseInterface $database)
    {
        $this->database->selectDatabase('projeto-esg')->selectCollection('indicators');
    }

    public function addIndicator(CreateIndicatorForm $indicatorForm)
    {
        try {
            $this->database->insertOne($indicatorForm->toArray());
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
