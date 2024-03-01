<?php

namespace App\Controllers;

use App\Exceptions\DatabaseException;
use App\Interfaces\DatabaseInterface;
use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Database;
use MongoDB\Driver\Cursor;
use MongoDB\InsertOneResult;
use MongoDB\Model\BSONDocument;
use MongoDB\UpdateResult;

class DatabaseController implements DatabaseInterface
{
    protected ?Database $database = null;
    protected ?Collection $collection = null;

    public function __construct(protected Client $client)
    {
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function selectDatabase(string $database): self
    {
        $this->database = $this->client->selectDatabase($database);

        return $this;
    }

    /**
     * @throws DatabaseException
     */
    public function selectCollection(string $collection, ?string $database = null): self
    {
        if ($this->database === null && $database === null) {
            throw new DatabaseException('Failed to select collection, database not set.');
        }

        if ($database !== null) {
            $this->collection = $this->client->selectCollection(
                $database,
                $collection
            );
        } else {
            $this->collection = $this->database->selectCollection($collection);
        }

        return $this;
    }

    /**
     * @throws DatabaseException
     */
    public function insertOne(array $data, array $options = []): InsertOneResult
    {
        $this->requireCollection();

        return $this->collection->insertOne(
            $data,
            $options
        );
    }

    /**
     * @throws DatabaseException
     */
    protected function requireCollection(): void
    {
        if ($this->collection === null) {
            throw new DatabaseException('Failed to perform the operation, collection not set.');
        }
    }

    /**
     * @throws DatabaseException
     */
    public function find(array $filter, array $options = []): Cursor
    {
        $this->requireCollection();

        return $this->collection->find(
            $filter,
            $options
        );
    }

    /**
     * @throws DatabaseException
     */
    public function findOne(array $filter, array $options = []): ?BSONDocument
    {
        $this->requireCollection();

        return $this->collection->findOne(
            $filter,
            $options
        );
    }

    /**
     * @throws DatabaseException
     */
    public function count(array $filter, array $options = []): int
    {
        $this->requireCollection();

        return $this->collection->countDocuments(
            $filter,
            $options
        );
    }

    /**
     * @throws DatabaseException
     */
    public function updateOne(array $filter, array $update, array $options = []): UpdateResult
    {
        $this->requireCollection();

        return $this->collection->updateOne(
            $filter,
            $update,
            $options
        );
    }

    /**
     * @throws DatabaseException
     */
    public function findOneAndUpdate(array $filter, array $update, array $options = []): array|object|null
    {
        $this->requireCollection();

        return $this->collection->findOneAndUpdate(
            $filter,
            $update,
            $options
        );
    }
}
