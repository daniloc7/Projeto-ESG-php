<?php

namespace App\Models;

use MongoDB\BSON\ObjectId;

class ScoreModel extends BaseModel
{

    public function __construct(
        public ?ObjectId $_id,
        public ?ObjectId $fkIdProject = null,
        public ?string $name = null,
        public ?float $weight = null,
        public ?int $score = null,
        public ?bool $isAccepted = false,
    ) {
    }
}
