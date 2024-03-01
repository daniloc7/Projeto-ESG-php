<?php

use App\Interfaces\DataFormInterface;
use App\Models\BaseModel;
use App\Models\IndicatorModel;
use MongoDB\BSON\ObjectId;

class CreateIndicatorForm extends BaseModel implements DataFormInterface
{
    public IndicatorModel $indicatorModel;

    public function __construct(IndicatorModel $indicatorModel)
    {
    }
    public function withName(string $name)
    {
        $this->indicatorModel->name = $name;
        return $this;
    }
    public function withDescription(string $description)
    {
        $this->indicatorModel->description = $description;
        return $this;
    }
}
