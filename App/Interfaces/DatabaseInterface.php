<?php

namespace App\Interfaces;

use App\Exceptions\DatabaseException;
use MongoDB\Client;
use MongoDB\DeleteResult;
use MongoDB\Driver\Cursor;
use MongoDB\InsertOneResult;
use MongoDB\Model\BSONDocument;
use MongoDB\Operation\DeleteOne;
use MongoDB\UpdateResult;

interface DatabaseInterface
{
    public function getClient(): Client;

    public function selectDatabase(string $database): self;

    public function selectCollection(string $collection, ?string $database = null): self;

    public function insertOne(array $data, array $options = []): InsertOneResult;

    public function updateOne(array $filter, array $update, array $options = []): UpdateResult;

    public function find(array $filter, array $options = []): Cursor;

    public function findOne(array $filter, array $options = []): ?BSONDocument;

    public function count(array $filter, array $options = []): int;

    public function findOneAndUpdate(array $filter, array $update, array $options = []): array|object|null;
}
