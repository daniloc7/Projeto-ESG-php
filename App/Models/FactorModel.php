<?php

namespace App\Models;

use MongoDB\BSON\ObjectId;

class FactorModel extends BaseModel
{
    public function __construct(
        public ?ObjectId $_id = null,
        public ?ObjectId $fkIdScore = null,
        public ?string $name = null,
        public ?string $description = null,
        public ?bool $isSelected = false,
        public ?float $weight = false,
    ) {
    }
}
