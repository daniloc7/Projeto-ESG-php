<?php

namespace App\Models;

use App\Interfaces\ModelInterface;
use MongoDB\Model\BSONDocument;
use ReflectionClass;
use ReflectionException;

class BaseModel implements ModelInterface
{
    public function toArray(): array
    {
        $out = [];

        try {
            $reflectionClass = new ReflectionClass($this::class);
        } catch (ReflectionException) {
            return [];
        }

        $properties = $reflectionClass->getProperties();
        foreach ($properties as $property) {
            $value = $property->getValue($this);
            if ($value instanceof BaseModel) {
                $value = $value->toArray();
            }

            $out[$property->getName()] = $value;
        }
        return $out;
    }


    public static function withFromDataArray(array|BSONDocument $data): static
    {
        $obj = new static();

        try {
            $reflectionClass = new ReflectionClass($obj::class);
        } catch (ReflectionException) {
            return [];
        }

        $properties = $reflectionClass->getProperties();
        foreach ($properties as $property) {
            $type = $property->getType();

            if ($type->isBuiltin()) {
                $obj->{$property->getName()} = match ($type->getName()) {
                    'array' => (array)$data[$property->getName()],
                    default => $data[$property->getName()]
                };
            } else {
                $reflectionClass = new ReflectionClass($type->getName());
                if ($reflectionClass->isEnum()) {
                    $obj->{$property->getName()} = $reflectionClass->getName()::tryFrom($data[$property->getName()]);
                } else if ($reflectionClass->hasMethod('withFromDataArray')) {
                    $obj->{$property->getName()} = $reflectionClass->newInstance()->withFromDataArray((array) $data[$property->getName()]);
                } else {
                    $obj->{$property->getName()} = $reflectionClass->newInstance($data[$property->getName()]);
                }
            }
        }

        return $obj;
    }

    public static function fromInstance(...$params): static
    {
        return new static(...$params);
    }
}
