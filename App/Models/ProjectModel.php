<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use DateTime;
use MongoDB\BSON\ObjectId;

class ProjectModel
{
    public function __construct(
        public ?ObjectId $_id = null,
        public ?string $name = null,
        public ?string $description = null,
        public ?DateTime $initDate = null,
        public ?ProjectStatus $projectStatus = ProjectStatus::EM_PROGRESSO,
        public ?float $score = null,
    ) {
    }
}
