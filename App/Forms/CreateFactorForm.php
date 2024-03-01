<?php

use App\Interfaces\DataFormInterface;
use App\Models\BaseModel;
use App\Models\FactorModel;
use MongoDB\BSON\ObjectId;

class CreateFactorForm extends BaseModel implements DataFormInterface
{

    public FactorModel $factorModel;
    public function __construct()
    {
        $this->factorModel = new FactorModel(
            _id: new ObjectId(),
        );
    }
    public function withName(string $name)
    {
        $this->factorModel->name = $name;
        return $this;
    }
    public function withDescription(string $description)
    {
        $this->factorModel->description = $description;
        return $this;
    }
}
