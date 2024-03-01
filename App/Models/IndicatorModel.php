<?php

namespace App\Models;

use MongoDB\BSON\ObjectId;

class IndicatorModel extends BaseModel
{
    public function __construct(
        public ?ObjectId $_id = null,
        public ?ObjectId $fkIdFactor = null,
        public ?string $name = null,
        public ?string $description = null,
        public ?float $weight = null,
        public ?bool $essential = false,
        public ?bool $isSelected = false,
    ) {
    }
}
